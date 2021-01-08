<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class ConditionDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class ConditionDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::Condition.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Condition';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'new',
            'refurbished',
            'used'
        ];
    }
}