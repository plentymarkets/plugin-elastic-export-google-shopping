<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class CustomLabel1DataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class CustomLabel1DataProvider extends AbstractKeyDataProvider
{

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Custom Label 1';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [];
    }
}