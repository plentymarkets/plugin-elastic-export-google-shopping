<?php

namespace ElasticExportGoogleShopping\Helper;

use Plenty\Modules\StockManagement\Stock\Contracts\StockRepositoryContract;
use Plenty\Repositories\Models\PaginatedResult;

class StockHelper
{
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
            $stock = 0;
            $stockRepositoryContract = pluginApp(StockRepositoryContract::class);
            if($stockRepositoryContract instanceof StockRepositoryContract)
            {
                $stockRepositoryContract->setFilters(['variationId' => $variation['id']]);
                $stockResult = $stockRepositoryContract->listStockByWarehouseType('sales',['stockNet'],1,1);
                if($stockResult instanceof PaginatedResult)
                {
                    $stockList = $stockResult->getResult();
                    foreach($stockList as $stock)
                    {
                        $stock = $stock->stockNet;
                        break;
                    }
                }
            }
            if($stock <= 0)
            {
                return true;
            }
        }
        elseif(array_key_exists('variationStock.isSalable' ,$filter))
        {
            if(count($filter['variationStock.isSalable']['stockLimitation']) == 2)
            {
                if($variation['data']['variation']['stockLimitation'] != 0 && $variation['data']['variation']['stockLimitation'] != 2)
                {
                    $stock = 0;
                    $stockRepositoryContract = pluginApp(StockRepositoryContract::class);
                    if($stockRepositoryContract instanceof StockRepositoryContract)
                    {
                        $stockRepositoryContract->setFilters(['variationId' => $variation['id']]);
                        $stockResult = $stockRepositoryContract->listStockByWarehouseType('sales',['stockNet'],1,1);
                        if($stockResult instanceof PaginatedResult)
                        {
                            $stockList = $stockResult->getResult();
                            foreach($stockList as $stock)
                            {
                                $stock = $stock->stockNet;
                                break;
                            }
                        }
                    }
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
                    $stock = 0;
                    $stockRepositoryContract = pluginApp(StockRepositoryContract::class);
                    if($stockRepositoryContract instanceof StockRepositoryContract)
                    {
                        $stockRepositoryContract->setFilters(['variationId' => $variation['id']]);
                        $stockResult = $stockRepositoryContract->listStockByWarehouseType('sales',['stockNet'],1,1);
                        if($stockResult instanceof PaginatedResult)
                        {
                            $stockList = $stockResult->getResult();
                            foreach($stockList as $stock)
                            {
                                $stock = $stock->stockNet;
                                break;
                            }
                        }
                    }
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