<?php

namespace ElasticExportGoogleShopping\Crons;


use ElasticExportGoogleShopping\Migrations\CatalogMigration;

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
