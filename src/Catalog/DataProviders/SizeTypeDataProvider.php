<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class SizeTypeDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class SizeTypeDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::SizeType.';

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
            'regular',
            'petite',
            'oversize',
            'maternity',
        ];
    }
}