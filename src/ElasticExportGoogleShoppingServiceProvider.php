<?php

namespace ElasticExportGoogleShopping;

use ElasticExportGoogleShopping\Catalog\Providers\CatalogBootServiceProvider;
use Plenty\Modules\DataExchange\Services\ExportPresetContainer;
use Plenty\Plugin\ServiceProvider;

class ElasticExportGoogleShoppingServiceProvider extends ServiceProvider
{
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
}
