<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class ShippingWeightUnitDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class ShippingWeightUnitDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::ShippingWeightUnit.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Shipping Weight Unit';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'lb',
            'oz',
            'g',
            'kg'
        ];
    }
}