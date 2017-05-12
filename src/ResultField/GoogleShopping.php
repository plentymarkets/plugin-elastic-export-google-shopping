<?php

namespace ElasticExportGoogleShopping\ResultField;

use Plenty\Modules\DataExchange\Contracts\ResultFields;
use Plenty\Modules\DataExchange\Models\FormatSetting;
use Plenty\Modules\Helper\Services\ArrayHelper;
use Plenty\Modules\Item\Search\Mutators\ImageMutator;
use Plenty\Modules\Cloud\ElasticSearch\Lib\Source\Mutator\BuiltIn\LanguageMutator;
use Plenty\Modules\Item\Search\Mutators\KeyMutator;
use Plenty\Modules\Item\Search\Mutators\SkuMutator;
use Plenty\Modules\Item\Search\Mutators\DefaultCategoryMutator;

class GoogleShopping extends ResultFields
{
    const GOOGLE_SHOPPING = 7.00;

    /*
     * @var ArrayHelper
     */
    private $arrayHelper;

    /**
     * GoogleShopping constructor.
	 *
     * @param ArrayHelper $arrayHelper
     */
    public function __construct(ArrayHelper $arrayHelper)
    {
        $this->arrayHelper = $arrayHelper;
    }

    /**
     * Generate result fields.
	 *
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

        $list[] = 'texts.lang';

        //Mutator

		/**
		 * @var KeyMutator
		 */
		$keyMutator = pluginApp(KeyMutator::class);

		if($keyMutator instanceof KeyMutator)
		{
			$keyMutator->setKeyList($this->getKeyList());
			$keyMutator->setNestedKeyList($this->getNestedKeyList());
		}

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
                'item.conditionApi',
                'texts.urlPath',

                // Variation
                'id',
                'variation.availability.id',
                'variation.model',
                'variation.stockLimitation',
                'variation.weightG',

                // Images
                'images.all.urlMiddle',
                'images.all.urlPreview',
                'images.all.urlSecondPreview',
                'images.all.url',
                'images.all.path',
                'images.all.position',

                'images.item.urlMiddle',
                'images.item.urlPreview',
                'images.item.urlSecondPreview',
                'images.item.url',
                'images.item.path',
                'images.item.position',

                'images.variation.urlMiddle',
                'images.variation.urlPreview',
                'images.variation.urlSecondPreview',
                'images.variation.url',
                'images.variation.path',
                'images.variation.position',

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

                //properties
                'properties.property.id',
                'properties.property.valueType',
                'properties.selection.name',
                'properties.texts.value'
            ],
            [
                $languageMutator,
                $skuMutator,
                $defaultCategoryMutator,
				$keyMutator
            ],
        ];

        if($reference != -1)
        {
            $fields[1][] = $imageMutator;
        }

        if (is_array($list) && count($list) > 0)
        {
            foreach($list as $element)
            {
                $fields[0][] = $element;
            }
        }

        return $fields;
    }

	/**
	 * @return array
	 */
    private function getKeyList()
	{
		return [
			// Item
			'item.id',
			'item.manufacturer.id',
			'item.conditionApi',

			// Variation
			'id',
			'variation.availability.id',
			'variation.model',
			'variation.stockLimitation',
			'variation.weightG',

			// Unit
			'unit.content',
			'unit.id',
		];
	}

	/**
	 * @return array
	 */
	private function getNestedKeyList()
	{
		return [
			'keys' => [
				// Attributes
				'attributes',

				// Barcodes
				'barcodes',

				// Default categories
				'defaultCategories',

				// Images
				'images.all',
				'images.item',
				'images.variation',

				//sku
				'skus',
			],

			'nestedKeys' => [
				// Attributes
				'attributes' => [
					'attributeValueSetId',
					'attributeId',
					'valueId'
				],

				// Barcodes
				'barcodes' => [
					'code',
					'type'
				],

				// Default categories
				'defaultCategories' => [
					'id'
				],

				// Images
				'images.all' => [
					'urlMiddle',
					'urlPreview',
					'urlSecondPreview',
					'url',
					'path',
					'position',
				],
				'images.item' => [
					'urlMiddle',
					'urlPreview',
					'urlSecondPreview',
					'url',
					'path',
					'position',
				],
				'images.variation' => [
					'urlMiddle',
					'urlPreview',
					'urlSecondPreview',
					'url',
					'path',
					'position',
				],

				//sku
				'skus' => [
					'sku',
				],

				// texts
				'texts' => [
					'urlPath',
					'name1',
					'name2',
					'name3',
					'shortDescription',
					'description',
					'technicalData',
				],
			]
		];
	}
}