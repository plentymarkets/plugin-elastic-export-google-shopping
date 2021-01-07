<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class AgeGroupDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class AgeGroupDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::AgeGroup.';

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