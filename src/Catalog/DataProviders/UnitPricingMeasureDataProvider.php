<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class UnitPricingMeasureDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class UnitPricingMeasureDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::UnitPricingMeasure.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Unit Pricing Measure';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
                'oz',
                'lb',
                'mg',
                'g',
                'kg',
                'floz',
                'pt',
                'qt',
                'gal',
                'ml',
                'cl',
                'l',
                'cbm',
                'in',
                'ft',
                'yd',
                'cm',
                'm',
                'sqft',
                'sqm',
                'ct'
        ];
    }
}