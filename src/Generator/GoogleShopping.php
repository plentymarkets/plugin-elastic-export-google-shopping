<?php

namespace ElasticExportGoogleShopping\Generator;

use ElasticExport\Helper\ElasticExportItemHelper;
use ElasticExport\Helper\ElasticExportPriceHelper;
use ElasticExport\Helper\ElasticExportPropertyHelper;
use ElasticExport\Helper\ElasticExportStockHelper;
use ElasticExport\Services\FiltrationService;
use ElasticExportGoogleShopping\Helper\AttributeHelper;
use ElasticExportGoogleShopping\Helper\PriceHelper;
use Plenty\Modules\DataExchange\Contracts\CSVPluginGenerator;
use Plenty\Modules\Helper\Services\ArrayHelper;
use ElasticExport\Helper\ElasticExportCoreHelper;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Item\Search\Contracts\VariationElasticSearchScrollRepositoryContract;
use Plenty\Plugin\Log\Loggable;
use ElasticExportGoogleShopping\Helper\ImageHelper;

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

    /**
     * @var ArrayHelper $arrayHelper
     */
    private $arrayHelper;

    /**
     * @var AttributeHelper $attributeHelper
     */
    private $attributeHelper;

    /**
     * @var PriceHelper $priceHelper
     */
    private $priceHelper;

    /**
	 * @var ElasticExportStockHelper $elasticExportStockHelper
	 */
	private $elasticExportStockHelper;

	/**
	 * @var ElasticExportPriceHelper $elasticExportPriceHelper
	 */
	private $elasticExportPriceHelper;

	/**
	 * @var ElasticExportItemHelper $elasticExportItemHelper
	 */
	private $elasticExportItemHelper;

	/**
	 * @var ElasticExportPropertyHelper $elasticExportPropertyHelper
	 */
	private $elasticExportPropertyHelper;
	
	/**
	 * @var ImageHelper $imageHelper
	 */
	private $imageHelper;

	/**
	 * @var int
	 */
	private $errorIterator = 0;

	/**
	 * @var array
	 */
	private $errorBatch = [];

    /**
     * @var array
     */
	private $priceList = [];

    /**
     * @var FiltrationService
     */
	private $filtrationService;

    /**
     * GoogleShopping constructor.
     * @param ArrayHelper $arrayHelper
     * @param AttributeHelper $attributeHelper
     * @param PriceHelper $priceHelper
     * @param ImageHelper $imageHelper
     */
    public function __construct(
        ArrayHelper $arrayHelper,
        AttributeHelper $attributeHelper,
        PriceHelper $priceHelper,
		ImageHelper $imageHelper
	)
    {
        $this->arrayHelper = $arrayHelper;
        $this->attributeHelper = $attributeHelper;
        $this->priceHelper = $priceHelper;
		$this->imageHelper = $imageHelper;
	}

    /**
     * @param VariationElasticSearchScrollRepositoryContract $elasticSearch
     * @param array $formatSettings
     * @param array $filter
     */
    protected function generatePluginContent($elasticSearch, array $formatSettings = [], array $filter = [])
    {
    	$this->elasticExportPriceHelper = pluginApp(ElasticExportPriceHelper::class);
		$this->elasticExportStockHelper = pluginApp(ElasticExportStockHelper::class);
        $this->elasticExportHelper = pluginApp(ElasticExportCoreHelper::class);
		$this->elasticExportItemHelper = pluginApp(ElasticExportItemHelper::class);
		$this->elasticExportPropertyHelper = pluginApp(ElasticExportPropertyHelper::class);

		$this->attributeHelper->setPropertyHelper();
		
        $settings = $this->arrayHelper->buildMapFromObjectList($formatSettings, 'key', 'value');
        $this->filtrationService = pluginApp(FiltrationService::class, [$settings, $filter]);
        
        $this->setDelimiter("	"); // this is tab character!

		$shardIterator = 0;

        $this->attributeHelper->loadLinkedAttributeList($settings);

        $this->addCSVContent([
            'id',
            'title',
            'description',
            'google_product_category',
            'product_type',
            'link',
            'image_link',
            'additional_image_link',
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
			'availability_date'
        ]);

        if($elasticSearch instanceof VariationElasticSearchScrollRepositoryContract)
        {
			
        	$elasticSearch->setNumberOfDocumentsPerShard(250);
        	
            $limitReached = false;
            $lines = 0;
            do
            {
                if($limitReached === true)
                {
                    break;
                }

                $resultList = $elasticSearch->execute();

				$shardIterator++;

				if(count($resultList['error']) > 0)
				{
					$this->getLogger(__METHOD__)->addReference('failedShard', $shardIterator)->error('ElasticExportGoogleShopping::log.esError', [
						'Error message' => $resultList['error'],
					]);
				}

				if($shardIterator == 1)
				{
                    $this->getLogger(__METHOD__)->addReference('total', (int)$resultList['total'])->debug('ElasticExportGoogleShopping::logs.esResultAmount');
                }

                foreach($resultList['documents'] as $variation)
                {
                    if($lines == $filter['limit'])
                    {
                        $limitReached = true;
                        break;
                    }

                    if(is_array($resultList['documents']) && count($resultList['documents']) > 0)
                    {
                        $this->loadPriceList($variation, $settings);
                        
                        if($this->filtrationService->filter($variation))
                        {
                            continue;
                        }

                        try
                        {
                            $this->buildRow($variation, $settings);
                        }
                        catch(\Throwable $throwable)
                        {
                        	$this->errorBatch['rowError'][] = [
								'Error message ' => $throwable->getMessage(),
								'Error line'    => $throwable->getLine(),
								'VariationId'   => $variation['id']
							]; 
                        	
                        	$this->errorIterator++;
                        	
                        	if($this->errorIterator == 100)
                        	{
								$this->getLogger(__METHOD__)->error('ElasticExportGoogleShopping::logs.fillRowError', [
									'error list'	=> $this->errorBatch['rowError']
								]);
								
								$this->errorIterator = 0;
							}
                        }
                        $lines = $lines +1; 
                    }
                }
            }while ($elasticSearch->hasNext());

			if(is_array($this->errorBatch) && count($this->errorBatch['rowError']))
			{
				$this->getLogger(__METHOD__)->error('ElasticExportGoogleShopping::logs.fillRowError', [
					'errorList'	=> $this->errorBatch['rowError']
				]);

				$this->errorIterator = 0;
			}
        }
    }

    /**
     * @param array $variation
     * @param KeyValue $settings
     */
    private function buildRow($variation, $settings)
    {
        $variationAttributes = $this->attributeHelper->getVariationAttributes($variation, $settings);

		$priceList = $this->priceList;
        $variationPrice = $priceList['price'] . ' ' . $priceList['currency'];

		if(strlen($priceList['price']) == 0)
		{
			$variationPrice = '';
		}

        $salePrice = $priceList['specialPrice'] . ' ' . $priceList['currency'];

        if($salePrice >= $variationPrice || $salePrice <= 0.00)
        {
        	$salePrice = '';
		}

        $shippingCost = $this->elasticExportHelper->getShippingCost($variation['data']['item']['id'], $settings);

        if(!is_null($shippingCost))
        {
			$shippingCost = number_format((float)$shippingCost, 2, '.', '').' '.$priceList['currency'];
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

        $imageList = $this->elasticExportHelper->getImageListInOrder($variation, $settings, 11, 'variationImages');
        $images = $this->imageHelper->getImages($imageList);

        $data = [
            'id' 						=> $this->elasticExportHelper->generateSku($variation['id'], self::GOOGLE_SHOPPING, 0, $variation['data']['skus']['sku']),
            'title' 					=> $this->elasticExportHelper->getMutatedName($variation, $settings, 256),
            'description'				=> $this->getDescription($variation, $settings),
            'google_product_category'	=> $this->elasticExportHelper->getCategoryMarketplace((int)$variation['data']['defaultCategories'][0]['id'], (int)$settings->get('plentyId'), 129),
            'product_type'				=> $this->elasticExportHelper->getCategory((int)$variation['data']['defaultCategories'][0]['id'], (string)$settings->get('lang'), (int)$settings->get('plentyId')),
            'link'						=> $this->elasticExportHelper->getMutatedUrl($variation, $settings, true, false),
            'image_link'				=> $images[ImageHelper::MAIN_IMAGE],
			'additional_image_link'		=> $images[ImageHelper::ADDITIONAL_IMAGES],
            'condition'					=> $this->getCondition($variation['data']['item']['conditionApi']['id']),
            'availability'				=> $this->elasticExportHelper->getAvailability($variation, $settings, false),
            'price'						=> $variationPrice,
            'sale_price'				=> $salePrice,
            'brand'						=> $this->elasticExportItemHelper->getExternalManufacturerName($variation),
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
            'gender'					=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_GENDER, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'age_group'					=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_AGE_GROUP, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'excluded_destination'		=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_EXCLUDED_DESTINATION, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'adwords_redirect'			=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_ADWORDS_REDIRECT, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'identifier_exists'			=> $this->getIdentifierExists($variation, $settings),
            'unit_pricing_measure'		=> $basePriceComponents['unit_pricing_measure'],
            'unit_pricing_base_measure'	=> $basePriceComponents['unit_pricing_base_measure'],
            'energy_efficiency_class'	=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_ENERGY_EFFICIENCY_CLASS, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'size_system'				=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_SIZE_SYSTEM, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'size_type'					=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_SIZE_TYPE, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'mobile_link'				=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_MOBILE_LINK, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'sale_price_effective_date'	=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_SALE_PRICE_EFFECTIVE_DATE, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'adult'						=> '',
            'custom_label_0'			=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_CUSTOM_LABEL_0, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'custom_label_1'			=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_CUSTOM_LABEL_1, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'custom_label_2'			=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_CUSTOM_LABEL_2, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'custom_label_3'			=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_CUSTOM_LABEL_3, self::GOOGLE_SHOPPING, $settings->get('lang')),
            'custom_label_4'			=> $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_CUSTOM_LABEL_4, self::GOOGLE_SHOPPING, $settings->get('lang')),
			'availability_​date'			=> $this->elasticExportHelper->getReleaseDate($variation),
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
    	$description = $this->elasticExportPropertyHelper->getProperty($variation, self::CHARACTER_TYPE_DESCRIPTION, self::GOOGLE_SHOPPING, $settings->get('lang'));

        if (strlen($description) <= 0)
        {
            $description = $this->elasticExportHelper->getMutatedDescription($variation, $settings, 5000);
        }

        return $description;
    }

    /**
     * @param array $variation
     * @param KeyValue $settings
     */
    private function loadPriceList($variation, KeyValue $settings)
    {
        $this->priceList = $this->elasticExportPriceHelper->getPriceList($variation, $settings, 2, '.');
    }
}