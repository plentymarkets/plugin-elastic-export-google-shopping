<?php

namespace ElasticExportGoogleShopping\Catalog\Providers;

use ElasticExportGoogleShopping\Catalog\DataProviders\AdultDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\AgeGroupDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\AvailabilityDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\ConditionDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\EnergyEfficiencyClassDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\ExcludedDestinationDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\GenderDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\GeneralDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\IdentifierExistsDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\IncludedDestinationDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\IsBundleDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\MaxEnergyEfficiencyClassDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\MinEnergyEfficiencyClassDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\ShippingSizeUnitDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\ShippingWeightUnitDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\SizeSystemDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\SizeTypeDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\SubscriptionCostPeriodDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\UnitPricingMeasureDataProvider;
use Plenty\Modules\Catalog\Templates\BaseTemplateProvider;
use Plenty\Modules\Item\Variation\Contracts\VariationExportServiceContract;

/**
 * Class CatalogTemplateProvider
 *
 * @package ElasticExportGoogleShopping\Catalog\Providers
 */
class CatalogTemplateProvider extends BaseTemplateProvider
{
    /**
     * @return array
     */
    public function getMappings(): array
    {
        return [
            [
                'identifier' => 'general',
                'label' => 'General',
                'isMapping' => false,
                'provider' => GeneralDataProvider::class,
            ],
            [
                'identifier' => 'Availability',
                'label' => 'Availability',
                'isMapping' => true,
                'provider' => AvailabilityDataProvider::class,
                'required' => true,
            ],
            [
                'identifier' => 'Identifier Exists',
                'label' => 'Identifier Exists',
                'isMapping' => true,
                'provider' => IdentifierExistsDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Unit Pricing Measure',
                'label' => 'Unit Pricing Measure',
                'isMapping' => true,
                'provider' => UnitPricingMeasureDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Subscription Cost Period',
                'label' => 'Subscription Cost Period',
                'isMapping' => true,
                'provider' => SubscriptionCostPeriodDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Condition',
                'label' => 'Condition',
                'isMapping' => true,
                'provider' => ConditionDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Adult',
                'label' => 'Adult',
                'isMapping' => true,
                'provider' => AdultDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Is Bundle',
                'label' => 'Is Bundle',
                'isMapping' => true,
                'provider' => IsBundleDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Energy Efficiency Class',
                'label' => 'Energy Efficiency Class',
                'isMapping' => true,
                'provider' => EnergyEfficiencyClassDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Max Energy Efficiency Class',
                'label' => 'Max Energy Efficiency Class',
                'isMapping' => true,
                'provider' => MaxEnergyEfficiencyClassDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Min Energy Efficiency Class',
                'label' => 'Min Energy Efficiency Class',
                'isMapping' => true,
                'provider' => MinEnergyEfficiencyClassDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Age Group',
                'label' => 'Age Group',
                'isMapping' => true,
                'provider' => AgeGroupDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Gender',
                'label' => 'Gender',
                'isMapping' => true,
                'provider' => GenderDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Size System',
                'label' => 'Size System',
                'isMapping' => true,
                'provider' => SizeSystemDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Size Type',
                'label' => 'Size Type',
                'isMapping' => true,
                'provider' => SizeTypeDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Excluded destination',
                'label' => 'Excluded destination',
                'isMapping' => true,
                'provider' => ExcludedDestinationDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Included destination',
                'label' => 'Included destination',
                'isMapping' => true,
                'provider' => IncludedDestinationDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Shipping Weight Unit',
                'label' => 'Shipping Weight Unit',
                'isMapping' => true,
                'provider' => ShippingWeightUnitDataProvider::class,
                'required' => false,
            ],
            [
                'identifier' => 'Shipping Size Unit',
                'label' => 'Shipping Size Unit',
                'isMapping' => true,
                'provider' => ShippingSizeUnitDataProvider::class,
                'required' => false,
            ]
        ];
    }

    /**
     * @return array
     */
    public function getFilter(): array
    {
        return [
//            [
//                'name' => 'variationMarket.isVisibleForMarket',
//                'params' => [
//                      [
//                          'name' => 'marketId',
//                          'value' => 9.00
//                      ]
//                ]
//            ]
        ];
    }

    /**
     * @return callable[]
     */
    public function getPreMutators(): array
    {
        return [];
    }

    /**
     * @return callable[]
     */
    public function getPostMutators(): array
    {
        return [
            function($variation) {
//                /** @var VariationExportServiceContract $variationExportService */
//                $variationExportService = pluginApp(VariationExportServiceContract::class);
//                $preloadedPrices = (array)$variationExportService->getData('VariationSalesPrice', $variation['id']);

//                foreach ($preloadedPrices as $price) {
//                    if($price['type'] == 'specialOffer' && $price['price'] > 0) {
//                        $variation['sale_price'] = $price['price'];
//                    }
//                }
                $variation['sale_price'] = '123';
                return $variation;
            }
        ];
    }

    /**
     * @return callable
     */
    public function getSkuCallback(): callable
    {
        return function ($value, $item) {
            return $value;
        };
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getMetaInfo(): array
    {
        return [];
    }

}