<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;

/**
 * Class AgeGroupDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class AgeGroupDataProvider extends AbstractKeyDataProvider
{

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Age Group';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'newborn',
            'infant',
            'toddler',
            'kids',
            'adult'
        ];
    }
}