<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class CustomLabel4DataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class CustomLabel4DataProvider extends AbstractKeyDataProvider
{

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Custom Label 4';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [];
    }
}