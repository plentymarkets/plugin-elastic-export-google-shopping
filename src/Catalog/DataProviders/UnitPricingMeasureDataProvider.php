<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class UnitPricingMeasureDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class UnitPricingMeasureDataProvider extends AbstractKeyDataProvider
{

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