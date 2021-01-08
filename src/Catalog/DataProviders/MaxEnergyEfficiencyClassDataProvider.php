<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class MaxEnergyEfficiencyClassDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class MaxEnergyEfficiencyClassDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::MaxEnergyEfficiencyClass.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Max Energy Efficiency Class';
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