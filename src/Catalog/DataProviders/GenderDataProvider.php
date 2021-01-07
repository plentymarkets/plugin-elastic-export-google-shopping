<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class GenderDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class GenderDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::Gender.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Gender';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'male',
            'female',
            'unisex'
        ];
    }
}