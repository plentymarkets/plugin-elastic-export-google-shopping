<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class ShippingSizeUnitDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class ShippingSizeUnitDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::ShippingSizeUnit.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Shipping Size Unit';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'in',
            'cm',
        ];
    }
}