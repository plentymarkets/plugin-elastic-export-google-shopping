<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

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
    public function get():array
    {
        return [
            [
                'key' => 'name.de',
                'label' => 'Name',
                'required' => true,
                'default' => 'variation-name',
                'type' => 'variation',
                'fieldKey' => 'name',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'article_id',
                'label' => 'Article Id',
                'required' => false,
                'default' => 'item-id',
                'type' => 'item',
                'fieldKey' => 'id',
                'isMapping' => false,
                'id' => null
            ],
//            [
//                'key' => 'deeplink',
//                'label' => 'Deeplink',
//                'required' => false,
//                'default' => '',
//                'type' => 'text',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
            [
                'key' => 'short_description',
                'label' => 'Short description',
                'required' => false,
                'default' => 'itemText-shortDescription',
                'type' => 'text',
                'fieldKey' => 'shortDescription',
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
                'id' => null
            ],
            [
                'key' => 'article',
                'label' => 'Article No',
                'required' => false,
                'default' => 'variation-number',
                'type' => 'variation',
                'fieldKey' => 'number',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'producer',
                'label' => 'Producer',
                'required' => false,
                'default' => 'item-manufacturerId',
                'type' => 'item',
                'fieldKey' => 'manufacturer.id',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'model',
                'label' => 'Model',
                'required' => false,
                'default' => 'variation-model',
                'type' => 'variation',
                'fieldKey' => 'model',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'availability',
                'label' => 'Availability',
                'required' => false,
                'default' => 'variation-availability',
                'type' => 'variation',
                'fieldKey' => 'availability',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'ean',
                'label' => 'EAN',
                'required' => false,
                'default' => 'barcode-1',
                'type' => 'barcode-code',
                'fieldKey' => 'code',
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
            [
                'key' => 'unit',
                'label' => 'Unit',
                'required' => false,
                'default' => 'variation-unit',
                'type' => 'unit',
                'fieldKey' => 'unitOfMeasurement',
                'isMapping' => false,
                'id' => null,
            ],
            [
                'key' => 'price',
                'label' => 'Price',
                'required' => false,
                'default' => 'salesPrice-1',
                'type' => 'sales-price',
                'fieldKey' => 'price',
                'isMapping' => false,
                'id' => 1
            ],
            [
                'key' => 'price_old',
                'label' => 'Price old',
                'required' => false,
                'default' => 'salesPrice-2',
                'type' => 'sales-price',
                'fieldKey' => 'price',
                'isMapping' => false,
                'id' => 2
            ],
            [
                'key' => 'weight',
                'label' => 'Weight',
                'required' => false,
                'default' => 'variation-weightNetG',
                'type' => 'variation',
                'fieldKey' => 'weightNetG',
                'isMapping' => false,
                'id' => null
            ],
//            [
//                'key' => 'category1',
//                'label' => 'Category1',
//                'required' => false,
//                'default' => 'defaultCategory-id',
//                'type' => 'default-category',
//                'fieldKey' => 'categoryId',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'category2',
//                'label' => 'Category2',
//                'required' => false,
//                'default' => '',
//                'type' => 'default-category',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'category3',
//                'label' => 'Category3',
//                'required' => false,
//                'default' => '',
//                'type' => 'default-category',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'category4',
//                'label' => 'Category4',
//                'required' => false,
//                'default' => '',
//                'type' => 'default-category',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'category5',
//                'label' => 'Category5',
//                'required' => false,
//                'default' => '',
//                'type' => 'default-category',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'category6',
//                'label' => 'Category6',
//                'required' => false,
//                'default' => '',
//                'type' => 'default-category',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
            [
                'key' => 'category_concat',
                'label' => 'Category Concat',
                'required' => false,
                'default' => '',
                'type' => 'default-category',
                'fieldKey' => '',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'image_url_preview',
                'label' => 'Image Url Preview',
                'required' => false,
                'default' => '',
                'type' => 'images',
                'fieldKey' => '',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'image_url',
                'label' => 'Image Url',
                'required' => false,
                'default' => '',
                'type' => 'images',
                'fieldKey' => '',
                'isMapping' => false,
                'id' => null
            ],
            [
                'key' => 'shipment_and_handling',
                'label' => 'Shipment & Handling',
                'required' => false,
                'default' => '',
                'type' => 'is-shipped-by',
                'fieldKey' => '',
                'isMapping' => false,
                'id' => null
            ],
//            [
//                'key' => 'unit_price',
//                'label' => 'Unit Price',
//                'required' => false,
//                'default' => '',
//                'type' => 'unit',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'unit_price_value',
//                'label' => 'Unit Price Value',
//                'required' => false,
//                'default' => '',
//                'type' => 'unit',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
//            [
//                'key' => 'unit_price_lot',
//                'label' => 'Unit Price Lot',
//                'required' => false,
//                'default' => '',
//                'type' => 'unit',
//                'fieldKey' => '',
//                'isMapping' => false,
//                'id' => null
//            ],
            [
                'key' => 'variation_id',
                'label' => 'Variation Id',
                'required' => false,
                'default' => 'variation-id',
                'type' => 'variation',
                'fieldKey' => 'id',
                'isMapping' => false,
                'id' => null
            ]
        ];
    }
}
