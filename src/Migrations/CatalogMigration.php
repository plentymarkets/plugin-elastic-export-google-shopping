<?php

namespace ElasticExportGoogleShopping\Migrations;

use Carbon\Carbon;
use ElasticExportGoogleShopping\Catalog\DataProviders\BaseFieldsDataProvider;
use ElasticExportGoogleShopping\Catalog\Providers\CatalogTemplateProvider;
use Plenty\Exceptions\ValidationException;
use Plenty\Modules\Catalog\Contracts\CatalogContentRepositoryContract;
use Plenty\Modules\Catalog\Contracts\CatalogRepositoryContract;
use Plenty\Modules\Catalog\Contracts\TemplateContainerContract;
use Plenty\Modules\Catalog\Contracts\TemplateContract;
use Plenty\Modules\DataExchange\Contracts\ExportRepositoryContract;
use Plenty\Modules\Item\Barcode\Contracts\BarcodeRepositoryContract;
use Plenty\Modules\Item\Barcode\Models\Barcode;
use Plenty\Modules\Item\SalesPrice\Contracts\SalesPriceRepositoryContract;

/**
 * Class CatalogMigration
 *
 * @package ElasticExportBasicPriceSearchEngine\Migrations
 */
class CatalogMigration
{

    /** @var TemplateContainerContract */
    private $templateContainer;

    /** @var ExportRepositoryContract */
    private $exportRepository;

    /** @var CatalogContentRepositoryContract */
    private $catalogContentRepository;

    /** @var CatalogRepositoryContract */
    private $catalogRepositoryContract;


    public function __construct(
        TemplateContainerContract $templateContainer,
        ExportRepositoryContract $exportRepository,
        CatalogContentRepositoryContract $catalogContentRepository,
        CatalogRepositoryContract $catalogRepositoryContract
    )
    {
        $this->templateContainer = $templateContainer;
        $this->exportRepository = $exportRepository;
        $this->catalogContentRepository = $catalogContentRepository;
        $this->catalogRepositoryContract = $catalogRepositoryContract;
    }

    public function run()
    {
        $this->barcode();
//        $this->price();
//        $this->updateCatalogData('Numetest');
//        $elasticExportFormats = $this->exportRepository->search(['formatKey' => 'ElasticExportGoogleShopping-Plugin']);
//
//        foreach($elasticExportFormats->getResult() as $format)
//        {
//            $this->updateCatalogData($format->name);
//        }
    }

    /**
     * @param $name
     *
     * @return bool
     * @throws \Exception
     */
    public function updateCatalogData($name)
    {
        // register the template
        $template = $this->registerTemplate();

        // create a new catalog
        $catalog = $this->create( $name, $template->getIdentifier())->toArray();

        $data = [];
        $values = pluginApp(BaseFieldsDataProvider::class)->get();
        foreach($values as $value) {
            $dataProviderKey = utf8_encode($this->getDataProviderByIdentifier($value['key']));
            if(is_array($value['additionalSources'])){
                $additionalSources = $value['additionalSources'];
            } else {
                $additionalSources = '';
            }
            $data['mappings'][$dataProviderKey]['fields'][] = [
                'key' => utf8_encode($value['key']),
                'sources' => [
                    [
                        'fieldId' => utf8_encode($value['default']),
                        'key' => $value['fieldKey'],
                        'lang' => 'de',
                        'type' => $value['type'],
                        'id' => $value['id'],
                        'isCombined' => isset($value['isCombined']),
                        'additionalSources' => $additionalSources
                    ]
                ]
            ];
        }

        // update created catalog data
        try
        {
            $this->catalogContentRepository->update($catalog['id'], $data);
        }
        catch(\Exception $e)
        {
        }

        return true;
    }

    /**
     * @param string $identifier
     * @return string
     */
    private function getDataProviderByIdentifier(string $identifier)
    {
        if (preg_match('/productDescription.attributes./', $identifier)) {
            return 'secondaryGeneral';
        }

        if(preg_match('/bulletPoints/', $identifier)) {
            return 'bulletPoints';
        }

        return 'general';
    }

    /**
     * @return TemplateContract
     */
    private function registerTemplate()
    {
        return $this->templateContainer->register(
            'BasicPriceSearchEngine',
            'ElasticExportBasicPriceSearchEngine',
            CatalogTemplateProvider::class
        );
    }

    /**
     * @param $name
     * @param $templateIdentifier
     *
     * @return mixed
     * @throws ValidationException
     */
    public function create($name ,$templateIdentifier)
    {
        return $this->catalogRepositoryContract->create(['name' => $name, 'template' => $templateIdentifier]);
    }

    public function barcode()
    {
        /** @var ExportRepositoryContract $testValue */
        $exportRepository = pluginApp(ExportRepositoryContract::class);
        $exportFormatSettings = $exportRepository->search(['formatKey' => 'GoogleShopping-Plugin'], ['formatSettings']);

        /** @var BarcodeRepositoryContract $type */
        $barcodeRepository = pluginApp(BarcodeRepositoryContract::class);

        foreach($exportFormatSettings->getResult() as $exportFormatSetting) {
            $orderReferrerId = $exportFormatSetting->formatSettings->where('key', 'referrerId')->first()->value;
            $formatSettingsBarcode = $exportFormatSetting->formatSettings->where('key', 'barcode')->first()->value;
            $formatSettingsBarcode = str_replace('EAN', 'GTIN', $formatSettingsBarcode);

            if($orderReferrerId == '-1') {
                $allBarcodes = $barcodeRepository->allBarcodes();

                /** @var Barcode $barcode */
                foreach ($allBarcodes->getResult() as $barcode) {
                    $barcodes[$barcode->id] = $barcode->plenty_item_barcode_type;
                    $barcodes[] = [
                        'id' => $barcode->id,
                        'type' => $barcode->plenty_item_barcode_type
                    ];
                }
            } else {
                $barcodes = $barcodeRepository->findBarcodesByReferrerRelation($orderReferrerId);
                $barcodes = $barcodes->sortBy('id')->toArray();
            }
            if($formatSettingsBarcode == 'FirstBarcode') {
               $barcodeId = $barcodes[0]['id'];
            } else {
               foreach($barcodes as $barcode) {
                   if($barcode['type'] == $formatSettingsBarcode) {
                       $barcodeId = $barcode['id'];
                       break;
                   }
               }
            }
        }
    }

    public function price()
    {
        /** @var ExportRepositoryContract $testValue */
        $exportRepository = pluginApp(ExportRepositoryContract::class);
        $exportFormatSettings = $exportRepository->search(['formatKey' => 'GoogleShopping-Plugin'], ['formatSettings']);

        foreach($exportFormatSettings->getResult() as $exportFormatSetting) {
            $orderReferrerId = $exportFormatSetting->formatSettings->where('key', 'referrerId')->first()->value;
            $formatSettingsCountry = $exportFormatSetting->formatSettings->where('key', 'destination')->first()->value;

            foreach(['default', 'specialOffer'] as $priceType) {
                /** @var SalesPriceRepositoryContract $salesPriceRepository */
                $salesPriceRepository = pluginApp(SalesPriceRepositoryContract::class);
                $salesPriceRepository->setFilters([
                    'referrer' => $orderReferrerId,
                    'countryId' => $formatSettingsCountry,
                    'type' => $priceType
                ]);

                $prices = $salesPriceRepository->all();

//                $priceToMap[$priceType] = $prices->getResult()->sortBy('id')->first()->id;
                $priceToMap[] = [
                    'key' => 'price',
                    'label' => 'Price',
                    'required' => false,
//                    'default' => 'salesPrice-'.$prices->getResult()->sortBy('id')->first()->id,
                    'type' => 'sales-price',
                    'fieldKey' => 'price',
                    'isMapping' => false,
                    'id' => null
                ];
                $salesPriceRepository->clearFilters();
            }
        }
    }
}