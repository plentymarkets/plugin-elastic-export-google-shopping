<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class EnergyEfficiencyClassDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class EnergyEfficiencyClassDataProvider extends AbstractKeyDataProvider
{

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Energy Efficiency Class';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'A+++',
            'A++',
            'A+',
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',

        ];
    }
}