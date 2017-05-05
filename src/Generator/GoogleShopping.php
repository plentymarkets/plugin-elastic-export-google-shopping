<?php

namespace ElasticExportGoogleShopping\Generator;

use ElasticExport\Helper\ElasticExportStockHelper;
use ElasticExportGoogleShopping\Helper\AttributeHelper;
use ElasticExportGoogleShopping\Helper\PriceHelper;
use ElasticExportGoogleShopping\Helper\PropertyHelper;
use Plenty\Modules\DataExchange\Contracts\CSVPluginGenerator;
use Plenty\Modules\Helper\Services\ArrayHelper;
use ElasticExport\Helper\ElasticExportCoreHelper;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Item\Search\Contracts\VariationElasticSearchScrollRepositoryContract;
use Plenty\Plugin\Log\Loggable;

class GoogleShopping extends CSVPluginGenerator
{
    use Loggable;

    const CHARACTER_TYPE_GENDER						= 'gender';
    const CHARACTER_TYPE_AGE_GROUP					= 'age_group';
    const CHARACTER_TYPE_SIZE_TYPE					= 'size_type';
    const CHARACTER_TYPE_SIZE_SYSTEM				= 'size_system';
    const CHARACTER_TYPE_ENERGY_EFFICIENCY_CLASS	= 'energy_efficiency_class';
    const CHARACTER_TYPE_EXCLUDED_DESTINATION		= 'excluded_destination';
    const CHARACTER_TYPE_ADWORDS_REDIRECT			= 'adwords_redirect';
    const CHARACTER_TYPE_MOBILE_LINK				= 'mobile_link';
    const CHARACTER_TYPE_SALE_PRICE_EFFECTIVE_DATE	= 'sale_price_effective_date';
    const CHARACTER_TYPE_CUSTOM_LABEL_0				= 'custom_label_0';
    const CHARACTER_TYPE_CUSTOM_LABEL_1				= 'custom_label_1';
    const CHARACTER_TYPE_CUSTOM_LABEL_2				= 'custom_label_2';
    const CHARACTER_TYPE_CUSTOM_LABEL_3				= 'custom_label_3';
    const CHARACTER_TYPE_CUSTOM_LABEL_4				= 'custom_label_4';
    const CHARACTER_TYPE_DESCRIPTION				= 'description';
    const CHARACTER_TYPE_COLOR						= 'color';
    const CHARACTER_TYPE_SIZE						= 'size';
    const CHARACTER_TYPE_PATTERN					= 'pattern';
    const CHARACTER_TYPE_MATERIAL					= 'material';

    const ISO_CODE_2								= 'isoCode2';
    const ISO_CODE_3								= 'isoCode3';

    const GOOGLE_SHOPPING                           = 7.00;

    /**
     * @var ElasticExportCoreHelper $elasticExportHelper
     */
    private $elasticExportHelper;

    /*
     * @var ArrayHelper
     */
    private $arrayHelper;

    /**
     * @var PropertyHelper
     */
    private $propertyHelper;
    /**
     * @var AttributeHelper
     */
    private $attributeHelper;
    /**
     * @var PriceHelper
     */
    private $priceHelper;
	/**
	 * @var ElasticExportStockHelper
	 */
	private $elasticExportStockHelper;

	/**
	 * GoogleShopping constructor.
	 * @param ArrayHelper $arrayHelper
	 * @param PropertyHelper $propertyHelper
	 * @param AttributeHelper $attributeHelper
	 * @param PriceHelper $priceHelper
	 */
    public function __construct(
        ArrayHelper $arrayHelper,
        PropertyHelper $propertyHelper,
        AttributeHelper $attributeHelper,
        PriceHelper $priceHelper
	)
    {
        $this->arrayHelper = $arrayHelper;
        $this->propertyHelper = $propertyHelper;
        $this->attributeHelper = $attributeHelper;
        $this->priceHelper = $priceHelper;
	}

    /**
     * @param VariationElasticSearchScrollRepositoryContract $elasticSearch
     * @param array $formatSettings
     * @param array $filter
     */
    protected function generatePluginContent($elasticSearch, array $formatSettings = [], array $filter = [])
    {
		$this->elasticExportStockHelper = pluginApp(ElasticExportStockHelper::class);
        $this->elasticExportHelper = pluginApp(ElasticExportCoreHelper::class);

        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');
        $this->setDelimiter("	"); // this is tab character!

        $this->attributeHelper->loadLinkedAttributeList($settings);

        $this->addCSVContent([
            'id',
            'title',
            'description',
            'google_product_category',
            'product_type',
            'link',
            'image_link',
            'condition',
            'availability',
            'price',
            'sale_price',
            'brand',
            'gtin',
            'isbn',
            'mpn',
            'color',
            'size',
            'material',
            'pattern',
            'item_group_id',
            'shipping',
            'shipping_weight',
            'gender',
            'age_group',
            'excluded_destination',
            'adwords_redirect',
            'identifier_exists',
            'unit_pricing_measure',
            'unit_pricing_base_measure',
            'energy_efficiency_class',
            'size_system',
            'size_type',
            'mobile_link',
            'sale_price_effective_date',
            'adult',
            'custom_label_0',
            'custom_label_1',
            'custom_label_2',
            'custom_label_3',
            'custom_label_4',
        ]);

        if($elasticSearch instanceof VariationElasticSearchScrollRepositoryContract)
        {
            $limitReached = false;
            $lines = 0;
            do
            {
                if($limitReached === true)
                {
                    break;
                }

                $resultList = $elasticSearch->execute();

                foreach($resultList['documents'] as $variation)
                {
                    if($lines == $filter['limit'])
                    {
                        $limitReached = true;
                        break;
                    }

                    if(is_array($resultList['documents']) && count($resultList['documents']) > 0)
                    {
                        if($this->elasticExportStockHelper->isFilteredByStock($variation, $filter) === true)
                        {
                            continue;
                        }

                        try
                        {
                            $this->buildRow($variation, $settings);
                        }
                        catch(\Throwable $throwable)
                        {
                            $this->getLogger(__METHOD__)->error('ElasticExportGoogleShopping::logs.fillRowError', [
                                'Error message ' => $throwable->getMessage(),
                                'Error line'    => $throwable->getLine(),
                                'VariationId'   => $variation['id']
                            ]);
                        }
                        $lines = $lines +1;
                    }
                }
            }while ($elasticSearch->hasNext());
        }
    }

    /**
     * @param array $variation
     * @param KeyValue $settings
     */
    private function buildRow($variation, $settings)
    {
        $priceList = $this->priceHelper->getPriceList($variation, $settings);
        $variationAttributes = $this->attributeHelper->getVariationAttributes($variation);
        $variationPrice = $priceList['variationRetailPrice.price'];
        $salePrice = $priceList['specialPrice'];

        $shippingCost = $this->elasticExportHelper->getShippingCost($variation['data']['item']['id'], $settings);

        if(!is_null($shippingCost))
        {
            $shippingCost = number_format((float)$shippingCost, 2, '.', '');
        }
        else
        {
            $shippingCost = '';
        }

        if(strlen($shippingCost) == 0)
        {
            $shipping = '';
        }
        else
        {
            $shipping = $this->elasticExportHelper->getCountry($settings, self::ISO_CODE_2).':::'.$shippingCost;
        }

        $basePriceComponents = $this->priceHelper->getBasePriceComponents($variation);

        $imageList = $this->elasticExportHelper->getImageListInOrder($variation, $settings, 1, 'variationImages');

        $data = [
            'id' 						=> $this->elasticExportHelper->generateSku($variation['id'], self::GOOGLE_SHOPPING, 0, $variation['data']['skus']['sku']),
            'title' 					=> $this->elasticExportHelper->getName($variation, $settings, 256),
            'description'				=> $this->getDescription($variation, $settings),
            'google_product_category'	=> $this->elasticExportHelper->getCategoryMarketplace((int)$variation['data']['defaultCategories'][0]['id'], (int)$settings->get('plentyId'), 129),
            'product_type'				=> $this->elasticExportHelper->getCategory((int)$variation['data']['defaultCategories'][0]['id'], (string)$settings->get('lang'), (int)$settings->get('plentyId')),
            'link'						=> $this->elasticExportHelper->getUrl($variation, $settings, true, false),
            'image_link'				=> count($imageList) > 0 && array_key_exists(0, $imageList) ? $imageList[0] : '',
            'condition'					=> $this->getCondition($variation['data']['item']['conditionApi']['id']),
            'availability'				=> $this->elasticExportHelper->getAvailability($variation, $settings, false),
            'price'						=> $variationPrice,
            'sale_price'				=> $salePrice,
            'brand'						=> $this->elasticExportHelper->getExternalManufacturerName((int)$variation['data']['item']['manufacturer']['id']),
            'gtin'						=> $this->elasticExportHelper->getBarcodeByType($variation, $settings->get('barcode')),
            'isbn'						=> $this->elasticExportHelper->getBarcodeByType($variation, ElasticExportCoreHelper::BARCODE_ISBN),
            'mpn'						=> $variation['data']['variation']['model'],
            'color'						=> $variationAttributes[self::CHARACTER_TYPE_COLOR],
            'size'						=> $variationAttributes[self::CHARACTER_TYPE_SIZE],
            'material'					=> $variationAttributes[self::CHARACTER_TYPE_MATERIAL],
            'pattern'					=> $variationAttributes[self::CHARACTER_TYPE_PATTERN],
            'item_group_id'				=> $variation['data']['item']['id'],
            'shipping'					=> $shipping,
            'shipping_weight'			=> $variation['data']['variation']['weightG'].' g',
            'gender'					=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_GENDER),
            'age_group'					=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_AGE_GROUP),
            'excluded_destination'		=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_EXCLUDED_DESTINATION),
            'adwords_redirect'			=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_ADWORDS_REDIRECT),
            'identifier_exists'			=> $this->getIdentifierExists($variation, $settings),
            'unit_pricing_measure'		=> $basePriceComponents['unit_pricing_measure'],
            'unit_pricing_base_measure'	=> $basePriceComponents['unit_pricing_base_measure'],
            'energy_efficiency_class'	=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_ENERGY_EFFICIENCY_CLASS),
            'size_system'				=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_SIZE_SYSTEM),
            'size_type'					=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_SIZE_TYPE),
            'mobile_link'				=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_MOBILE_LINK),
            'sale_price_effective_date'	=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_SALE_PRICE_EFFECTIVE_DATE),
            'adult'						=> '',
            'custom_label_0'			=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_CUSTOM_LABEL_0),
            'custom_label_1'			=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_CUSTOM_LABEL_1),
            'custom_label_2'			=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_CUSTOM_LABEL_2),
            'custom_label_3'			=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_CUSTOM_LABEL_3),
            'custom_label_4'			=> $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_CUSTOM_LABEL_4),
        ];

        $this->addCSVContent(array_values($data));
    }

    /**
     * Check if condition is valid.
	 *
     * @param int|null $conditionId
     * @return string
     */
    private function getCondition($conditionId):string
    {
        $conditionList = [
            0 => 'new',
            1 => 'used',
            2 => 'used',
            3 => 'used',
            4 => 'used',
            5 => 'refurbished'
        ];

        if (!is_null($conditionId) && array_key_exists($conditionId, $conditionList))
        {
            return $conditionList[$conditionId];
        }
        else
        {
            return '';
        }
    }

    /**
     * Calculate and get unit price.
	 *
     * @param array $variation
     * @return string
     */
    private function getIdentifierExists($variation, KeyValue $settings):string
    {
        $count = 0;

        if(strlen($variation['data']['variation']['model']) > 0)
        {
            $count++;
        }

        if(strlen($this->elasticExportHelper->getBarcodeByType($variation, $settings->get('barcode'))) > 0 ||
				strlen($this->elasticExportHelper->getBarcodeByType($variation, ElasticExportCoreHelper::BARCODE_ISBN)) > 0 )
        {
            $count++;
        }

        if (strlen($this->elasticExportHelper->getExternalManufacturerName((int)$variation['data']['item']['manufacturer']['id'])) > 0)
        {
            $count++;
        }

        if ($count >= 2)
        {
            return 'true';
        }
        else
        {
            return 'false';
        }
    }

    /**
     * Returns the description of a variation. Priority has a "description" property. Is
	 * no property linked, it will return the default description text.
	 *
     * @param array $variation
     * @param KeyValue $settings
     * @return string
     */
    private function getDescription($variation, KeyValue $settings):string
    {
    	$description = $this->propertyHelper->getProperty($variation, self::CHARACTER_TYPE_DESCRIPTION);

        if (strlen($description) <= 0)
        {
            $description = $this->elasticExportHelper->getDescription($variation, $settings, 5000);
        }

        return $description;
    }
}