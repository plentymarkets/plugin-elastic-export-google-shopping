<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

// use Plenty\Modules\Catalog\Contracts\TemplateContract;
use Plenty\Modules\Catalog\DataProviders\BaseDataProvider;

/**
 * Class AvailabilityDateDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class AvailabilityDateDataProvider extends BaseDataProvider
{
    public function getRows(): array
    {
        return [
            [
                'key' => 'availability_date',
                'label' => 'Availability Date',
                'required' => false
            ]
        ];
    }

//    public function setTemplate(TemplateContract $template) {}
//
//    public function setMapping(array $mapping) {}
}