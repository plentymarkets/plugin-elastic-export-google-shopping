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
     * @param ElasticExportPropertyHelper $exportService
     */
    public function handle(ElasticExportPropertyHelper $exportService)
    {
        $exportService->getItemPropertyList([], 7.00);
    }
}
