<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class CustomLabel3DataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class CustomLabel3DataProvider extends AbstractKeyDataProvider
{

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Custom Label 3';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [];
    }
}