<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Catalog\Contracts\AbstractKeyDataProvider;
use ElasticExportGoogleShopping\ElasticExportGoogleShoppingServiceProvider;

/**
 * Class SubscriptionCostPeriodDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class SubscriptionCostPeriodDataProvider extends AbstractKeyDataProvider
{

    /** @var string */
    protected $translationPath = ElasticExportGoogleShoppingServiceProvider::PLUGIN_NAME.'::SubscriptionCostPeriod.';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return 'Subscription Cost Period';
    }

    /**
     * @inheritDoc
     */
    protected function getProviderValues(): array
    {
        return [
            'month',
            'year',
        ];
    }
}