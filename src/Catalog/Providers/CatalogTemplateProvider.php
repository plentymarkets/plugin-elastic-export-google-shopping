<?php

namespace ElasticExportGoogleShopping\Catalog\Providers;

use ElasticExportGoogleShopping\Catalog\DataProviders\AdultDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\AgeGroupDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\ColorDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\CustomLabel0DataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\CustomLabel1DataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\CustomLabel2DataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\CustomLabel3DataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\CustomLabel4DataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\EnergyEfficiencyClassDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\ExcludedDestinationDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\GenderDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\GeneralDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\IdentifierExistsDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\MaterialDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\MobileLinkDataProvider;
use ElasticExportGoogleShopping\Catalog\DataProviders\PatternDataProdiver;
use ElasticExportGoogleShopping\Catalog\DataProviders\SizeDataProvider;
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
                'identifier' => 'Gender',
                'label' => 'Gender',
                'isMapping' => true,
                'provider' => GenderDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Color',
                'label' => 'Color',
                'isMapping' => true,
                'provider' => ColorDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Size',
                'label' => 'Size',
                'isMapping' => true,
                'provider' => SizeDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Material',
                'label' => 'Material',
                'isMapping' => true,
                'provider' => MaterialDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Pattern',
                'label' => 'Pattern',
                'isMapping' => true,
                'provider' => PatternDataProdiver::class,
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
                'identifier' => 'Mobile Link',
                'label' => 'Mobile Link',
                'isMapping' => true,
                'provider' => MobileLinkDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Adult',
                'label' => 'Adult',
                'isMapping' => true,
                'provider' => AdultDataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Custom Label 0',
                'label' => 'Custom Label 0',
                'isMapping' => true,
                'provider' => CustomLabel0DataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Custom Label 1',
                'label' => 'Custom Label 1',
                'isMapping' => true,
                'provider' => CustomLabel1DataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Custom Label 2',
                'label' => 'Custom Label 2',
                'isMapping' => true,
                'provider' => CustomLabel2DataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Custom Label 3',
                'label' => 'Custom Label 3',
                'isMapping' => true,
                'provider' => CustomLabel3DataProvider::class,
                'required' => false,
            ],[
                'identifier' => 'Custom Label 4',
                'label' => 'Custom Label 4',
                'isMapping' => true,
                'provider' => CustomLabel4DataProvider::class,
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