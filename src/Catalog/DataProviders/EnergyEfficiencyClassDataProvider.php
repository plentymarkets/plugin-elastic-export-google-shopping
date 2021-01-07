<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class EnergyEfficiencyClassDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class EnergyEfficiencyClassDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::EnergyEfficiencyClass.';

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