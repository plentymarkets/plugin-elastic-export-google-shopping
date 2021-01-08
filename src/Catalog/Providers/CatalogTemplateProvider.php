<?php

namespace ElasticExportGoogleShopping\Catalog\Providers;

use ElasticExportGoogleShopping\Catalog\DataProviders\AdultDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\AgeGroupDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\AvailabilityDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\EnergyEfficiencyClassDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\ExcludedDestinationDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\GenderDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\GeneralDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\IdentifierExistsDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\ShippingHeightUnitDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\ShippingLengthUnitDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\ShippingWidthUnitDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\SizeSystemDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\SizeTypeDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\UnitPricingBaseMeasureDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\UnitPricingMeasureDataProvider;
use Plenty\Modules\Catalog\Templates\BaseTemplateProvider;

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
            ],[
                'identifier' => 'Availability',
                'label' => 'Availability',
                'isMapping' => true,
                'provider' => AvailabilityDataProvider::class,
                'required' => true,
            ],[
                'identifier' => 'Gender',
                'label' => 'Gender',
                'isMapping' => true,
                'provider' => GenderDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Age Group',
                'label' => 'Age Group',
                'isMapping' => true,
                'provider' => AgeGroupDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Excluded destination',
                'label' => 'Excluded destination',
                'isMapping' => true,
                'provider' => ExcludedDestinationDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Identifier Exists',
                'label' => 'Identifier Exists',
                'isMapping' => true,
                'provider' => IdentifierExistsDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Unit Pricing Measure',
                'label' => 'Unit Pricing Measure',
                'isMapping' => true,
                'provider' => UnitPricingMeasureDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Unit Pricing Base Measure',
                'label' => 'Unit Pricing Base Measure',
                'isMapping' => true,
                'provider' => UnitPricingBaseMeasureDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Energy Efficiency Class',
                'label' => 'Energy Efficiency Class',
                'isMapping' => true,
                'provider' => EnergyEfficiencyClassDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Shipping Length Unit',
                'label' => 'Shipping Length Unit',
                'isMapping' => true,
                'provider' => ShippingLengthUnitDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Shipping Width Unit',
                'label' => 'Shipping Width Unit',
                'isMapping' => true,
                'provider' => ShippingWidthUnitDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Shipping Height Unit',
                'label' => 'Shipping Height Unit',
                'isMapping' => true,
                'provider' => ShippingHeightUnitDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Size System',
                'label' => 'Size System',
                'isMapping' => true,
                'provider' => SizeSystemDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Size Type',
                'label' => 'Size Type',
                'isMapping' => true,
                'provider' => SizeTypeDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Adult',
                'label' => 'Adult',
                'isMapping' => true,
                'provider' => AdultDataProvider::class,
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
        return [];
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