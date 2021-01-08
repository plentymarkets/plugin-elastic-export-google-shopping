<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class IsBundleDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class IsBundleDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::IsBundle.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Is Bundle';
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