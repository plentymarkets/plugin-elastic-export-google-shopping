<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class AvailabilityDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class AvailabilityDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::Availability.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Availability';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'in stock',
            'out of stock',
            'preorder'
        ];
    }
}