<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class AvailabilityDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class AvailabilityDataProvider extends AbstractKeyDataProvider
{

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