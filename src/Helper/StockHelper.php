<?php

namespace ElasticExportGoogleShopping\Helper;

use Plenty\Modules\StockManagement\Stock\Contracts\StockRepositoryContract;

class StockHelper
{
    /**
     * Get all informations that depend on stock settings and stock volume
     * (inventoryManagementActive, $variationAvailable, $stock)
     * @param $variation
     * @return array
     */
    private function getStock($variation):array
    {
        $stockNet = 0;

        $stockRepositoryContract = pluginApp(StockRepositoryContract::class);
        if($stockRepositoryContract instanceof StockRepositoryContract)
        {
            $stockRepositoryContract->setFilters(['variationId' => $variation['id']]);
            $stockResult = $stockRepositoryContract->listStock(['stockNet'],1,1);
            $stockNet = $stockResult->getResult()->first()->stockNet;
        }

        $stock = 0;

        if($variation['data']['variation']['stockLimitation'] == 2)
        {
            $stock = 999;
        }
        elseif($variation['data']['variation']['stockLimitation'] == 1 && $stockNet > 0)
        {
            if($stockNet > 999)
            {
                $stock = 999;
            }
            else
            {
                $stock = $stockNet;
            }
        }
        elseif($variation['data']['variation']['stockLimitation'] == 0)
        {
            if($stockNet > 999)
            {
                $stock = 999;
            }
            else
            {
                if($stockNet > 0)
                {
                    $stock = $stockNet;
                }
                else
                {
                    $stock = 0;
                }
            }
        }

        return $stock;

    }

    /**
     * @param array $variation
     * @param array $filter
     * @return bool
     */
    public function isFilteredByStock($variation, $filter)
    {
        /**
         * If the stock filter is set, this will sort out all variations
         * not matching the filter.
         */
        if(array_key_exists('variationStock.netPositive' ,$filter))
        {
            $stock = $this->getStock($variation);
            if($stock <= 0)
            {
                return true;
            }
        }
        elseif(array_key_exists('variationStock.isSalable' ,$filter))
        {
            if(count($filter['variationStock.isSalable']['stockLimitation']) == 2)
            {
                if($variation['data']['variation']['stockLimitation'] != 0 || $variation['data']['variation']['stockLimitation'] != 2)
                {
                    $stock = $this->getStock($variation);
                    if($stock <= 0)
                    {
                        return true;
                    }
                }
            }
            else
            {
                if($variation['data']['variation']['stockLimitation'] != $filter['variationStock.isSalable']['stockLimitation'][0])
                {
                    $stock = $this->getStock($variation);
                    if($stock <= 0)
                    {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}