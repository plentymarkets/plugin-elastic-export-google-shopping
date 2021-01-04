<?php

namespace ElasticExportGoogleShopping\Catalog\DataProviders;

use Plenty\Modules\Catalog\Contracts\TemplateContract;
use Plenty\Modules\Catalog\DataProviders\BaseDataProvider;

/**
 * Class GeneralDataProvider
 * @package ElasticExportGoogleShopping\Catalog\DataProviders
 */
class GeneralDataProvider extends BaseDataProvider
{
    public function getRows(): array
    {
        return [
            //required
            [
                'key' => 'id',
                'label' => 'ID',
                'required' => false
            ],[
                'key' => 'title',
                'label' => 'Title',
                'required' => true
            ],[
                'key' => 'description',
                'label' => 'Description',
                'required' => false
            ],[
                'key' => 'google_product_category',
                'label' => 'Google Product Category',
                'required' => false
            ],[
                'key' => 'product_type',
                'label' => 'Product Type',
                'required' => false
            ],[
                'key' => 'link',
                'label' => 'Link',
                'required' => false
            ],[
                'key' => 'image_link',
                'label' => 'Image link',
                'required' => false
            ],[
                'key' => 'additional_image_link',
                'label' => 'Additional image link',
                'required' => false
            ],[
                'key' => 'condition',
                'label' => 'Condition',
                'required' => false
            ],[
                'key' => 'availability',
                'label' => 'Availability',
                'required' => false
            ],[
                'key' => 'price',
                'label' => 'Price',
                'required' => false
            ],[
                'key' => 'sale_price',
                'label' => 'Sale Price',
                'required' => false
            ],[
                'key' => 'brand',
                'label' => 'Brand',
                'required' => false
            ],[
                'key' => 'gtin',
                'label' => 'GTIN',
                'required' => false
            ],[
                'key' => 'isbn',
                'label' => 'ISBN',
                'required' => false
            ],[
                'key' => 'mpn',
                'label' => 'MPN',
                'required' => false
            ],[
                'key' => 'item_group_id',
                'label' => 'Item Group Id',
                'required' => false
            ],[
                'key' => 'item_group_id',
                'label' => 'Item Group Id',
                'required' => false
            ],[
                'key' => 'shipping',
                'label' => 'Shipping',
                'required' => false
            ],[
                'key' => 'shipping_weight',
                'label' => 'Shipping Weight',
                'required' => false
            ],[
                'key' => 'adwords_redirect',
                'label' => 'Adwords Redirect',
                'required' => false
            ]
        ];
    }


    public function setTemplate(TemplateContract $template) {}

    public function setMapping(array $mapping) {}
}