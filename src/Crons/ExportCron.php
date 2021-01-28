<?php

namespace ElasticExportGoogleShopping\Crons;


use ElasticExportGoogleShopping\Helper\ElasticExportPropertyHelper;
use ElasticExportGoogleShopping\Migrations\CatalogMigration;
use ElasticExportGoogleShopping\Migrations\CreateProperties;

/**
 * Class ExportCron
 *
 * @package ElasticExportGoogleShopping\Crons
 */
class ExportCron
{
    /**
//     * @param CatalogMigration $exportService
     * @param CreateProperties $exportService
     */
    public function handle(CreateProperties $exportService)
    {
//        $exportService->getItemPropertyList([], 7.00);
        $exportService->run();
    }
}
