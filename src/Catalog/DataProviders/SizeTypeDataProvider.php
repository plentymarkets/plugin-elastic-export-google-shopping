<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class GenderDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class SizeTypeDataProvider extends AbstractKeyDataProvider
{

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Size System';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'regular',
            'petite',
            'oversize',
            'maternity',
        ];
    }
}