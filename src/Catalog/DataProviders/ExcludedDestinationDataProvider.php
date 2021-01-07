<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class ExcludedDestinationDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class ExcludedDestinationDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::ExcludedDestination.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Excluded Destination';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'Shopping ads',
            'Buy on Google listings',
            'Display ads',
            'Local inventory ads',
            'Free listings',
            'Free local listings'
        ];
    }
}