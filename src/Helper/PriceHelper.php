<?php

namespace ElasticExportGoogleShopping\Helper;

use Plenty\Legacy\Repositories\Item\SalesPrice\SalesPriceSearchRepository;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Item\SalesPrice\Models\SalesPriceSearchRequest;

class PriceHelper
{
    const TRANSFER_RRP_YES = 1;
    const TRANSFER_OFFER_PRICE_YES = 1;

    /**
     * @var SalesPriceSearchRepository
     */
    private $salesPriceSearchRepository;
    /**
     * @var UnitHelper
     */
    private $unitHelper;

    /**
     * PriceHelper constructor.
     * @param SalesPriceSearchRepository $salesPriceSearchRepository
     * @param UnitHelper $unitHelper
     */
    public function __construct(
        SalesPriceSearchRepository $salesPriceSearchRepository,
        UnitHelper $unitHelper)
    {
        $this->salesPriceSearchRepository = $salesPriceSearchRepository;
        $this->unitHelper = $unitHelper;
    }

    /**
     * Get a List of price, reduced price and the reference for the reduced price.
     * @param array $variation
     * @param KeyValue $settings
     * @return array
     */
    public function getPriceList($variation, KeyValue $settings):array
    {
        //getting the retail price
        /**
         * SalesPriceSearchRequest $salesPriceSearchRequest
         */
        $salesPriceSearchRequest = pluginApp(SalesPriceSearchRequest::class);
        if($salesPriceSearchRequest instanceof SalesPriceSearchRequest)
        {
            $salesPriceSearchRequest->variationId = $variation['id'];
            $salesPriceSearchRequest->referrerId = $settings->get('referrerId');
        }

        $salesPriceSearch  = $this->salesPriceSearchRepository->search($salesPriceSearchRequest);
        $variationPrice = $salesPriceSearch->price;

        if($settings->get('transferOfferPrice') == self::TRANSFER_OFFER_PRICE_YES)
        {
            $salesPriceSearchRequest->type = 'specialOffer';
            $variationSpecialPrice = $this->salesPriceSearchRepository->search($salesPriceSearchRequest)->price;
        }
        else
        {
            $variationSpecialPrice = 0.00;
        }

        //setting retail price as selling price without a reduced price
        $price = $variationPrice;
        $price = number_format((float)$price, 2, '.', '');
        $variationSpecialPrice = number_format((float)$variationSpecialPrice, 2, '.', '');

        if($variationSpecialPrice >= $variationPrice || $variationSpecialPrice <= 0.00)
        {
            $variationSpecialPrice = '';
        }

        return array(
            'variationRetailPrice.price'                     =>  $price,
            'specialPrice'                                   =>  $variationSpecialPrice,
        );
    }


    /**
     * @param array $variation
     * @return array
     */
    public function getBasePriceComponents($variation):array
    {
        $unitPricingMeasure = '';
        $unitPricingBaseMeasure = '';

        if ((int)$variation['data']['unit']['id'] >= 1 && (float)$variation['data']['unit']['content'] > 1)
        {
            if (in_array($variation['data']['unit']['id'], array('5','2','31','38')))
            {
                $unitPricingMeasure = ((string)number_format((float)$variation['data']['unit']['content'], 2, '.', '').' '.(string)$this->unitHelper->getUnit($variation['data']['unit']['id']));
            }
            elseif ($this->unitHelper->getUnit($variation['data']['unit']['id']) != '')
            {
                $unitPricingMeasure = ((string)number_format((float)$variation['data']['unit']['content'], 2, '.', '').' '.(string)$this->unitHelper->getUnit($variation['data']['unit']['id']));
            }

            if ($unitPricingMeasure != '')
            {
                $unitPricingBaseMeasure = $this->unitHelper->getUnitPricingBaseMeasure($variation);
            }
        }

        return array(
            'unit_pricing_measure'	  =>  $unitPricingMeasure,
            'unit_pricing_base_measure' =>  $unitPricingBaseMeasure
        );

    }
}