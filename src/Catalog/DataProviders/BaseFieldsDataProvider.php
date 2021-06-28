<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use ElasticExportGoogleShopping\Migrations\CatalogMigration;

/**
 * Class BaseFieldsDataProvider
 *
 * @package ElasticExportBasicPriceSearchEngine\Catalog\DataProviders
 */
class BaseFieldsDataProvider
{
    /**
     * @return array
     */

	/** @var CatalogMigration */
	private $catalogMigration;

	public function __construct(
		CatalogMigration $catalogMigration,

	)
	{
		$this->catalogMigration = $catalogMigration;
	}

    public function get():array
    {
        return [
            [
                'key' => 'id',
                'label' => 'Id',
                'required' => true,
                'default' => 'variation-id',
                'type' => 'variation',
                'fieldKey' => 'id',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'title',
                'label' => 'Article Id',
                'required' => false,
                'default' => 'itemText-name1',
                'type' => 'text',
                'fieldKey' => 'name1',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'description',
                'label' => 'Description',
                'required' => false,
                'default' => 'itemText-description',
                'type' => 'text',
                'fieldKey' => 'description',
                'isMapping' => false,
                'id' => null,
                'isCombined' => true,
                'additionalSources' => [
                    'key' => 'description',
                    'label' => 'Description',
                    'required' => false,
                    'default' => 'itemText-technicalData',
                    'type' => 'text',
                    'fieldKey' => 'technicalData',
                    'isMapping' => false,
                    'id' => null,
                ]
            ],
            [
                'key' => 'link',
                'label' => 'Link',
                'required' => false,
                'default' => 'itemText-urlPath',
                'type' => 'text',
                'fieldKey' => 'urlPath',
                'isMapping' => false,
                'id' => null
            ],
//            [
//                'key' => 'imageLink',
//                'label' => 'Link',
//                'required' => false,
//                'default' => 'itemText-urlPath',
//                'type' => 'text',
//                'fieldKey' => 'urlPath',
//                'isMapping' => false,
//                'id' => null
//            ],[
//                'key' => 'additionalImageLink',
//                'label' => 'Link',
//                'required' => false,
//                'default' => 'itemText-urlPath',
//                'type' => 'text',
//                'fieldKey' => 'urlPath',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'mobileLink',
//                'label' => 'Link',
//                'required' => false,
//                'default' => 'itemText-urlPath',
//                'type' => 'text',
//                'fieldKey' => 'urlPath',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'costOfGoodsSold',
//                'label' => 'Producer',
//                'required' => false,
//                'default' => 'item-manufacturerId',
//                'type' => 'item',
//                'fieldKey' => 'manufacturer.id',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'expiration_date',
//                'label' => 'Producer',
//                'required' => false,
//                'default' => 'item-manufacturerId',
//                'type' => 'item',
//                'fieldKey' => 'manufacturer.id',
//                'isMapping' => false,
//                'id' => null
//            ],
            [
                'key' => 'price',
                'label' => 'Price',
                'required' => false,
                'default' => 'salesPrice-1',
                'type' => 'sales-price',
                'fieldKey' => 'price',
                'isMapping' => false,
                'id' => null
            ],
//            [
//                'key' => 'salePrice',
//                'label' => 'Model',
//                'required' => false,
//                'default' => 'salesPrice-1',
//                'type' => 'sales-price',
//                'fieldKey' => 'price',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'salePriceStartDate',
//                'label' => 'Model',
//                'required' => false,
//                'default' => 'salesPrice-1',
//                'type' => 'sales-price',
//                'fieldKey' => 'price',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'salePriceEndDate',
//                'label' => 'Model',
//                'required' => false,
//                'default' => 'salesPrice-1',
//                'type' => 'sales-price',
//                'fieldKey' => 'price',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'unitPricingMeasureValue',
//                'label' => 'Availability',
//                'required' => false,
//                'default' => 'variation-availability',
//                'type' => 'variation',
//                'fieldKey' => 'availability',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'installmentMonths',
//                'label' => 'Availability',
//                'required' => false,
//                'default' => 'variation-availability',
//                'type' => 'variation',
//                'fieldKey' => 'availability',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'installmenAmount',
//                'label' => 'Availability',
//                'required' => false,
//                'default' => 'variation-availability',
//                'type' => 'variation',
//                'fieldKey' => 'availability',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'subscriptionCostPeriodlength',
//                'label' => 'EAN',
//                'required' => false,
//                'default' => 'barcode-1',
//                'type' => 'barcode-code',
//                'fieldKey' => 'code',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'subscriptionAmmount',
//                'label' => 'EAN',
//                'required' => false,
//                'default' => 'barcode-1',
//                'type' => 'barcode-code',
//                'fieldKey' => 'code',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'LoyaltyPointsValue',
//                'label' => 'EAN',
//                'required' => false,
//                'default' => 'barcode-1',
//                'type' => 'barcode-code',
//                'fieldKey' => 'code',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'LoyaltyPointsName',
//                'label' => 'EAN',
//                'required' => false,
//                'default' => 'barcode-1',
//                'type' => 'barcode-code',
//                'fieldKey' => 'code',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'LoyaltyPointsRatio',
//                'label' => 'EAN',
//                'required' => false,
//                'default' => 'barcode-1',
//                'type' => 'barcode-code',
//                'fieldKey' => 'code',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'googleProductCategory',
//                'label' => 'Google Product Category',
//                'required' => false,
//                'default' => 'barcode-1',
//                'type' => 'barcode-code',
//                'fieldKey' => 'code',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'productType',
//                'label' => 'Product Type',
//                'required' => false,
//                'default' => 'barcode-1',
//                'type' => 'barcode-code',
//                'fieldKey' => 'code',
//                'isMapping' => false,
//                'id' => null
//            ],
            [
                'key' => 'brand',
                'label' => 'EAN',
                'required' => false,
                'default' => 'item-manufacturerExternalName',
                'type' => 'item',
                'fieldKey' => 'manufacturer.externalName',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'gtin',
                'label' => 'EAN',
                'required' => false,
                'default' => 'barcode-'. $this->catalogMigration->barcode(),
                'type' => 'barcode-code',
                'fieldKey' => 'code',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'mpn',
                'label' => 'EAN',
                'required' => false,
                'default' => 'variation-model',
                'type' => 'variation',
                'fieldKey' => 'model',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'isbn',
                'label' => 'ISBN',
                'required' => false,
                'default' => 'barcode-4',
                'type' => 'barcode-code',
                'fieldKey' => 'code',
                'isMapping' => false,
                'id' => null
            ],
//            [
//                'key' => 'multipack',
//                'label' => 'Unit',
//                'required' => false,
//                'default' => 'variation-unit',
//                'type' => 'unit',
//                'fieldKey' => 'unitOfMeasurement',
//                'isMapping' => false,
//                'id' => null,
//            ],
//            [
//                'key' => 'color',
//                'label' => 'Price',
//                'required' => false,
//                'default' => 'salesPrice-1',
//                'type' => 'sales-price',
//                'fieldKey' => 'price',
//                'isMapping' => false,
//                'id' => 1
//            ],
//            [
//                'key' => 'material',
//                'label' => 'Price',
//                'required' => false,
//                'default' => 'salesPrice-1',
//                'type' => 'sales-price',
//                'fieldKey' => 'price',
//                'isMapping' => false,
//                'id' => 1
//            ],
//            [
//                'key' => 'pattern',
//                'label' => 'Price',
//                'required' => false,
//                'default' => 'salesPrice-1',
//                'type' => 'sales-price',
//                'fieldKey' => 'price',
//                'isMapping' => false,
//                'id' => 1
//            ],
//            [
//                'key' => 'size',
//                'label' => 'Price',
//                'required' => false,
//                'default' => 'salesPrice-1',
//                'type' => 'sales-price',
//                'fieldKey' => 'price',
//                'isMapping' => false,
//                'id' => 1
//            ],
            [
                'key' => 'item_group_id',
                'label' => 'Price old',
                'required' => false,
                'default' => 'item-id',
                'type' => 'item',
                'fieldKey' => 'id',
                'isMapping' => false,
                'id' => 2
            ],
//            [
//                'key' => 'product_highlight',
//                'label' => 'Weight',
//                'required' => false,
//                'default' => 'variation-weightNetG',
//                'type' => 'variation',
//                'fieldKey' => 'weightNetG',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'ads_redirect',
//                'label' => 'Weight',
//                'required' => false,
//                'default' => 'variation-weightNetG',
//                'type' => 'variation',
//                'fieldKey' => 'weightNetG',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'custom_label0',
//                'label' => 'custom_label0',
//                'required' => false,
//                'default' => 'defaultcustom_label-id',
//                'type' => 'default-custom_label',
//                'fieldKey' => 'custom_labelId',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'custom_label1',
//                'label' => 'custom_label1',
//                'required' => false,
//                'default' => '',
//                'type' => 'default-custom_label',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'custom_label2',
//                'label' => 'custom_label2',
//                'required' => false,
//                'default' => '',
//                'type' => 'default-custom_label',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'custom_label3',
//                'label' => 'custom_label3',
//                'required' => false,
//                'default' => '',
//                'type' => 'default-custom_label',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'custom_label4',
//                'label' => 'custom_label4',
//                'required' => false,
//                'default' => '',
//                'type' => 'default-custom_label',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'shoppingAdsExcludedCountry',
//                'label' => 'Image Url Preview',
//                'required' => false,
//                'default' => '',
//                'type' => 'images',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'shoppingLabel',
//                'label' => 'Image Url',
//                'required' => false,
//                'default' => '',
//                'type' => 'images',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
            [
                'key' => 'shipment_weight_value',
                'label' => 'Shipment Weight Value',
                'required' => false,
                'default' => 'variation-weightG',
                'type' => 'variation',
                'fieldKey' => 'weighthG',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'shipment_length_value',
                'label' => 'Shipment Weight Value',
                'required' => false,
                'default' => 'variation-weightG',
                'type' => 'variation',
                'fieldKey' => 'weighthG',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'shipment_height_value',
                'label' => 'Shipment Weight Value',
                'required' => false,
                'default' => 'variation-weightG',
                'type' => 'variation',
                'fieldKey' => 'weighthG',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'ships_from_country',
                'label' => 'Shipment Weight Value',
                'required' => false,
                'default' => 'variation-weightG',
                'type' => 'variation',
                'fieldKey' => 'weighthG',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'transit_time_label',
                'label' => 'Shipment Weight Value',
                'required' => false,
                'default' => 'variation-weightG',
                'type' => 'variation',
                'fieldKey' => 'weighthG',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'max_handling_time',
                'label' => 'Shipment Weight Value',
                'required' => false,
                'default' => 'variation-weightG',
                'type' => 'variation',
                'fieldKey' => 'weighthG',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'min_handling_time',
                'label' => 'Shipment Weight Value',
                'required' => false,
                'default' => 'variation-weightG',
                'type' => 'variation',
                'fieldKey' => 'weighthG',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'tax_category',
                'label' => 'Shipment Weight Value',
                'required' => false,
                'default' => 'variation-weightG',
                'type' => 'variation',
                'fieldKey' => 'weighthG',
                'isMapping' => false,
                'id' => null
            ],
        ];
    }
}
