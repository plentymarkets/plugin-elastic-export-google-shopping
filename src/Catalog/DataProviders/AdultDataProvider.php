<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class AdultDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class AdultDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::Adult.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Adult';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'yes',
            'no'
        ];
    }
}