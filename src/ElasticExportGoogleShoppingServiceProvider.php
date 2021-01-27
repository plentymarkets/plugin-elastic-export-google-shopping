<?php

namespace ElasticExportGoogleShopping;

use ElasticExportGoogleShopping\Catalog\Providers\CatalogBootServiceProvider;
use ElasticExportGoogleShopping\Crons\ExportCron;
use Plenty\Modules\Cron\Services\CronContainer;
use Plenty\Modules\DataExchange\Services\ExportPresetContainer;
use Plenty\Plugin\ServiceProvider;

class ElasticExportGoogleShoppingServiceProvider extends ServiceProvider
{

    const PLUGIN_NAME = 'ElasticExportGoogleShopping';

    /**
     * Abstract function for registering the service provider.
     *
     * @throws \ErrorException
     */
    public function register()
    {
        $this->getApplication()->register(CatalogBootServiceProvider::class);
    }

	public function exports(ExportPresetContainer $container)
	{
		$container->add(
			'GoogleShopping-Plugin',
			'ElasticExportGoogleShopping\ResultField\GoogleShopping',
			'ElasticExportGoogleShopping\Generator\GoogleShopping',
            '',
			true,
            true
		);
	}
    public function boot(CronContainer $cronContainer)
    {
        // register crons
        $cronContainer->add(CronContainer::EVERY_FIFTEEN_MINUTES, ExportCron::class);
    }
}
