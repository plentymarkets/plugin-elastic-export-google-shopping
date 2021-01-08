<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class ShippingLengthUnitDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class ShippingLengthUnitDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::ShippingLength.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Shipping Length Unit';
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