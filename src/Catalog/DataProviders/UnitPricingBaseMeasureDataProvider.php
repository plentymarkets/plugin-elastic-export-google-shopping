<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class GenderDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class UnitPricingBaseMeasureDataProvider extends AbstractKeyDataProvider
{

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Unit Pricing Base Measure';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
//            'Weight' =>[
//                'oz',
//                'lb',
//                'mg',
//                'g',
//                'kg'
//            ],
//            'Volume us imperial' => [
//                'floz',
//                'pt',
//                'qt',
//                'gal'
//            ],
//            'Volume metric' => [
//                'ml',
//                'cl',
//                'l',
//                'cbm'
//            ],
//            'Length' => [
//                'in',
//                'ft',
//                'yd',
//                'cm',
//                'm'
//            ],
//            'Area' => [
//                'sqft',
//                'sqm'
//            ],
//            'Per unit' => [
//                'ct'
//            ]
        ];
    }
}