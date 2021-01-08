<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class MinEnergyEfficiencyClassDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class MinEnergyEfficiencyClassDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::MinEnergyEfficiencyClass.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Min Energy Efficiency Class';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'A+++',
            'A++',
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G'
        ];
    }
}