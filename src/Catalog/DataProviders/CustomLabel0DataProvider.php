<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class CustomLabel0DataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class CustomLabel0DataProvider extends AbstractKeyDataProvider
{

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Custom Label 0';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [];
    }
}