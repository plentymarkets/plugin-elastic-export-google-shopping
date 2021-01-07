<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class SizeSystemDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class SizeSystemDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::SizeSystem.';

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
            'US',
            'UK',
            'EU',
            'DE',
            'FR',
            'JP',
            'CN (China)',
            'IT',
            'BR',
            'MEX',
            'AU'
          ];
    }
}