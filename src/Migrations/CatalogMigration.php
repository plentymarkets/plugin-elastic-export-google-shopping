<?php

namespace ElasticExportGoogleShopping\Migrations;


use ElasticExportGoogleShopping\Catalog\DataProviders\BaseFieldsDataProvider;
use ElasticExportGoogleShopping\Catalog\Providers\CatalogTemplateProvider;
use ElasticExportGoogleShopping\Helper\BarcodeHelper;
use Illuminate\Support\Facades\DB;
use Plenty\Exceptions\ValidationException;
use Plenty\Modules\Catalog\Contracts\CatalogContentRepositoryContract;
use Plenty\Modules\Catalog\Contracts\CatalogRepositoryContract;
use Plenty\Modules\Catalog\Contracts\TemplateContainerContract;
use Plenty\Modules\Catalog\Contracts\TemplateContract;
use Plenty\Modules\DataExchange\Contracts\ExportRepositoryContract;
use Plenty\Modules\Item\Barcode\Contracts\BarcodeRepositoryContract;
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

    /** @var BarcodeHelper $barcodes */
    private $barcodes;

    public function __construct(
        TemplateContainerContract $templateContainer,
        ExportRepositoryContract $exportRepository,
        CatalogContentRepositoryContract $catalogContentRepository,
        CatalogRepositoryContract $catalogRepositoryContract,
        BarcodeHelper $barcodes
    )
    {
        $this->templateContainer = $templateContainer;
        $this->exportRepository = $exportRepository;
        $this->catalogContentRepository = $catalogContentRepository;
        $this->catalogRepositoryContract = $catalogRepositoryContract;
        $this->barcodes = $barcodes;
    }

    public function run()
    {
        $this->barcode();
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

        /** @var BarcodeRepositoryContract $type */
        $type = pluginApp(BarcodeRepositoryContract::class);
        $testBarcode = $type->allBarcodes();
        $barcodeReferrerId = [];
        foreach($testBarcode->getResult() as $barcode) {
            foreach($barcode->referrers as $referrers) {
                $barcodeReferrerId[] = $referrers->referrerId;
            }
        }
        /** @var ExportRepositoryContract $testValue */
        $testValue = pluginApp(ExportRepositoryContract::class);
        $tests = $testValue->search(['formatKey' => 'GoogleShopping-Plugin'], ['formatSettings']);
        $orderReferrerId = '';
        foreach($tests->getResult() as $test){
            foreach($test->formatSettings as $formatSetting){
                if($formatSetting['key'] == 'referrerId') {
                    $orderReferrerId =  $formatSetting['value'];
                }
                foreach($barcodeReferrerId as $barcodeId){
                    //Check if we have an order referrer
                    if($barcodeId == (float)$orderReferrerId){
                        $testOrder = $barcodeId;
                    }
                    if($barcodeId != (float)$orderReferrerId && $orderReferrerId == -1){
                        $testBarcodeNew = $orderReferrerId;
                    }
                }
                if($formatSetting['key'] == 'barcode'){
                    $barcodeMapping = [
                        'key' => 'gtin',
                        'label' => 'EAN',
                        'required' => false,
                        'default' => $this->barcodes->barcodeValue($formatSetting['value']),
                        'type' => 'barcode-code',
                        'fieldKey' => 'code',
                        'isMapping' => false,
                        'id' => null
                    ];
                    break;
                }
            }
        }
    }
}