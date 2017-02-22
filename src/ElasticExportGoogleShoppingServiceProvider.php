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
			'ElasticExportGoogleShopping\ResultField\GoogleShopping',
			'ElasticExportGoogleShopping\Generator\GoogleShopping',
			'ElasticExportGoogleShopping\Filter\GoogleShopping',
			true
		);
	}
}
