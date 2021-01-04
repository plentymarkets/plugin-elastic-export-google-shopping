<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class ColorDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class ColorDataProvider extends AbstractKeyDataProvider
{

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Color';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [];
    }
}