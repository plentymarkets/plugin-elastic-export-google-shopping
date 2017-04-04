<?php

namespace ElasticExportGoogleShopping\IDL_ResultList;

use Plenty\Modules\Item\DataLayer\Contracts\ItemDataLayerRepositoryContract;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Item\DataLayer\Models\RecordList;

class GoogleShopping
{
	const GOOGLE_SHOPPING = 7.00;

    /**
     * @param array $variationIds
     * @param KeyValue $settings
     * @param array $filter
     * @return RecordList|null
     */
    public function getResultList($variationIds, $settings, $filter = [])
    {
        if(is_array($variationIds) && count($variationIds) > 0)
        {
            $searchFilter = array(
                'variationBase.hasId' => array(
                    'id' => $variationIds
                )
            );

            if(array_key_exists('variationStock.netPositive', $filter))
            {
                $searchFilter['variationStock.netPositive'] = $filter['variationStock.netPositive'];
            }
            elseif(array_key_exists('variationStock.isSalable', $filter))
            {
                $searchFilter['variationStock.isSalable'] = $filter['variationStock.isSalable'];
            }

            $resultFields = array(
                'itemBase' => array(
                    'id',
                ),

                'variationBase' => array(
                    'id'
                ),

                'itemPropertyList' => array(
                    'params' => array(),
                    'fields' => array(
                        'propertyId',
                        'propertyValue',
                    )
                ),

                'variationStock' => array(
                    'params' => array(
                        'type' => 'virtual'
                    ),
                    'fields' => array(
                        'stockNet'
                    )
                ),

                'variationRetailPrice' => array(
                    'params' => array(
                        'referrerId' => $settings->get('referrerId') ? $settings->get('referrerId') : self::GOOGLE_SHOPPING,
                    ),
                    'fields' => array(
                        'price',
                        'vatValue',
                    ),
                ),

                'variationRecommendedRetailPrice' => array(
                    'params' => array(
                        'referrerId' => $settings->get('referrerId') ? $settings->get('referrerId') : self::GOOGLE_SHOPPING,
                    ),
                    'fields' => array(
                        'price',	// uvp
                    ),
                ),

                'variationSpecialOfferRetailPrice' => array(
                    'params' => array(
                        'referrerId' => $settings->get('referrerId') ? $settings->get('referrerId') : self::GOOGLE_SHOPPING,
                    ),
                    'fields' => array(
                        'retailPrice',
                    ),
                ),
            );

			/**
			 * @var ItemDataLayerRepositoryContract $itemDataLayer
			 */
            $itemDataLayer = pluginApp(ItemDataLayerRepositoryContract::class);

            if($itemDataLayer instanceof ItemDataLayerRepositoryContract)
			{
				return $itemDataLayer->search($resultFields, $searchFilter);
			}
        }

        return null;
    }
}