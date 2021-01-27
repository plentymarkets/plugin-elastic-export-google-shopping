<?php

namespace ElasticExportGoogleShopping\Crons;


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
     * @param CatalogMigration $exportService
     */
    public function handle(CatalogMigration $exportService)
    {
        $exportService->run();
    }
}
