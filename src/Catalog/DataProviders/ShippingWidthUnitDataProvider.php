<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class ShippingWidthDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class ShippingWidthUnitDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::ShippingWidth.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Shipping Width Unit';
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