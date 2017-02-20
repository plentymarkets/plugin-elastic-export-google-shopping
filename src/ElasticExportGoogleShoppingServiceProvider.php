<?php

namespace ElasticExportGoogleShopping;

use Plenty\Modules\DataExchange\Services\ExportPresetContainer;
use Plenty\Plugin\DataExchangeServiceProvider;

class ElasticExportGoogleShoppingServiceProvider extends DataExchangeServiceProvider
{
	public function register()
	{
	}

	public function exports(ExportPresetContainer $container)
	{
		$container->add(
			'GoogleShopping-Plugin',
			'ElasticExportGoogleShopping\ResultFields\GoogleShopping',
			'ElasticExportGoogleShopping\Generators\GoogleShopping',
			'ElasticExportGoogleShopping\Filters\GoogleShopping',
			true
		);
	}
}
