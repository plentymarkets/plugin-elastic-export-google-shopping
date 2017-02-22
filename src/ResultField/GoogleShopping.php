<?php

namespace ElasticExportGoogleShopping\ResultField;

use Plenty\Modules\DataExchange\Contracts\ResultFields;
use Plenty\Modules\DataExchange\Models\FormatSetting;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\Item\Search\Mutators\ImageMutator;
use Plenty\Modules\Cloud\ElasticSearch\Lib\Source\Mutator\BuiltIn\LanguageMutator;
use Plenty\Modules\Item\Search\Mutators\SkuMutator;
use Plenty\Modules\Item\Search\Mutators\DefaultCategoryMutator;

class GoogleShopping extends ResultFields
{
    const GOOGLE_SHOPPING = 7;
    /*
     * @var ArrayHelper
     */
    private $arrayHelper;

    /**
     * GoogleShopping constructor.
     * @param ArrayHelper $arrayHelper
     */
    public function __construct(ArrayHelper $arrayHelper)
    {
        $this->arrayHelper = $arrayHelper;
    }

    /**
     * Generate result fields.
     * @param  array $formatSettings = []
     * @return array
     */
    public function generateResultFields(array $formatSettings = []):array
    {
        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');
        $reference = $settings->get('referrerId') ? $settings->get('referrerId') : self::GOOGLE_SHOPPING;

        $list = [];

        if($settings->get('nameId'))
        {
            $list[] = 'texts.name'.$settings->get('nameId');
        }
        else
        {
            $list[] = 'texts.name1';
        }

        if ($settings->get('descriptionType') == 'itemShortDescription' ||
            $settings->get('previewTextType') == 'itemShortDescription')
        {
            $list[] = 'texts.shortDescription';
        }

        if ($settings->get('descriptionType') == 'itemDescription' ||
            $settings->get('descriptionType') == 'itemDescriptionAndTechnicalData' ||
            $settings->get('previewTextType') == 'itemDescription' ||
            $settings->get('previewTextType') == 'itemDescriptionAndTechnicalData')
        {
            $list[] = 'texts.description';
        }

        if ($settings->get('descriptionType') == 'technicalData' ||
            $settings->get('descriptionType') == 'itemDescriptionAndTechnicalData' ||
            $settings->get('previewTextType') == 'technicalData' ||
            $settings->get('previewTextType') == 'itemDescriptionAndTechnicalData')
        {
            $list[] = 'texts.technicalData';
        }

        //Mutator
        /**
         * @var ImageMutator $imageMutator
         */
        $imageMutator = pluginApp(ImageMutator::class);
        if($imageMutator instanceof ImageMutator)
        {
            $imageMutator->addMarket($reference);
        }
        /**
         * @var LanguageMutator $languageMutator
         */
        $languageMutator = pluginApp(LanguageMutator::class, [[$settings->get('lang')]]);
        /**
         * @var SkuMutator $skuMutator
         */
        $skuMutator = pluginApp(SkuMutator::class);
        if($skuMutator instanceof SkuMutator)
        {
            $skuMutator->setMarket($reference);
        }
        /**
         * @var DefaultCategoryMutator $defaultCategoryMutator
         */
        $defaultCategoryMutator = pluginApp(DefaultCategoryMutator::class);
        if($defaultCategoryMutator instanceof DefaultCategoryMutator)
        {
            $defaultCategoryMutator->setPlentyId($settings->get('plentyId'));
        }

        $fields = [
            [
                // Item
                'item.id',
                'item.manufacturer.id',
                'item.apiCondition',
                'texts.urlPath',

                // Variation
                'id',
                'variation.availability.id',
                'variation.model',
                'variation.stockLimitation',
                'variation.weightG',

                // Images
                'images.all.type',
                'images.all.path',
                'images.all.position',
                'images.variation.type',
                'images.variation.path',
                'images.variation.position',
                'images.item.type',
                'images.item.path',
                'images.item.position',

                // Unit
                'unit.content',
                'unit.id',

                //sku
                'skus.sku',

                // Default categories
                'defaultCategories.id',

                // Barcodes
                'barcodes.code',
                'barcodes.type',

                // Attributes
                'attributes.attributeValueSetId',
                'attributes.attributeId',
                'attributes.valueId',
            ],

            [
                $imageMutator,
                $languageMutator,
                $skuMutator,
                $defaultCategoryMutator
            ],
        ];

        if (is_array($list) && count($list) > 0)
        {
            foreach($list as $element)
            {
                $fields[0][] = $element;
            }
        }

        return $fields;
    }
}