<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class IncludedDestinationDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class IncludedDestinationDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::IncludedDestination.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Included Destination';
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