<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class ShippingHeightDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class ShippingHeightUnitDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::ShippingHeight.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Shipping Height Unit';
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