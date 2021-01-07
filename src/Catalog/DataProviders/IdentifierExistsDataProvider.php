<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class GenderDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class IdentifierExistsDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::IdentifierExists.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Identifier Exists';
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