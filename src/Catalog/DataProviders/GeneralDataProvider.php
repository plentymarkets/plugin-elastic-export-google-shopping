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
            ],
            [
                'key' => 'title',
                'label' => 'Title',
                'required' => true
            ],
            [
                'key' => 'description',
                'label' => 'Description',
                'required' => false
            ],
            [
                'key' => 'link',
                'label' => 'Link',
                'required' => false
            ],
            [
                'key' => 'image_link',
                'label' => 'Image link',
                'required' => false
            ],
            [
                'key' => 'additional_image_link',
                'label' => 'Additional image link',
                'required' => false
            ],
            [
                'key' => 'mobile_link',
                'label' => 'Mobile Link',
                'required' => false
            ],
            [
                'key' => 'availability_date',
                'label' => 'Availability Date',
                'required' => false
            ],
            [
                'key' => 'cost_of_goods_sold',
                'label' => 'Cost of Goods Sold',
                'required' => false
            ],
            [
                'key' => 'expiration_date',
                'label' => 'Expiration Date',
                'required' => false
            ],
            [
                'key' => 'price',
                'label' => 'Price',
                'required' => false
            ],
            [
                'key' => 'sale_price',
                'label' => 'Sale Price',
                'required' => false
            ],
            [
                'key' => 'sale_price_start_date',
                'label' => 'Sale Price Start Date',
                'required' => false
            ],
            [
                'key' => 'sale_price_end_date',
                'label' => 'Sale Price End Date',
                'required' => false
            ],
            [
                'key' => 'unit_pricing_measure_value',
                'label' => 'Unit Pricing Measure Value',
                'required' => false
            ],
            [
                'key' => 'installment_months',
                'label' => 'Installment Months',
                'required' => false
            ],
            [
                'key' => 'installment_amount',
                'label' => 'Installment Amount',
                'required' => false
            ],
            [
                'key' => 'subscription_cost_period_length',
                'label' => 'Subscription Cost Period Length',
                'required' => false
            ],
            [
                'key' => 'subscription_amount',
                'label' => 'Subscription Amount',
                'required' => false
            ],
            [
                'key' => 'loyalty_points_value',
                'label' => 'Loyalty Points Value',
                'required' => false
            ],
            [
                'key' => 'loyalty_points_name',
                'label' => 'Loyalty Points Name',
                'required' => false
            ],
            [
                'key' => 'loyalty_points_ratio',
                'label' => 'Loyalty Points Ratio',
                'required' => false
            ],
            [
                'key' => 'google_product_category',
                'label' => 'Google Product Category',
                'required' => false
            ],
            [
                'key' => 'product_type',
                'label' => 'Product Type',
                'required' => false
            ],
            [
                'key' => 'brand',
                'label' => 'Brand',
                'required' => false
            ],
            [
                'key' => 'gtin',
                'label' => 'GTIN',
                'required' => false
            ],
            [
                'key' => 'isbn',
                'label' => 'ISBN',
                'required' => false
            ],
            [
                'key' => 'mpn',
                'label' => 'MPN',
                'required' => false
            ],
            [
                'key' => 'multipack',
                'label' => 'Multipack',
                'required' => false
            ],
            [
                'key' => 'color',
                'label' => 'Color',
                'required' => false
            ],
            [
                'key' => 'material',
                'label' => 'Material',
                'required' => false
            ],
            [
                'key' => 'pattern',
                'label' => 'Pattern',
                'required' => false
            ],
            [
                'key' => 'size',
                'label' => 'Size',
                'required' => false
            ],
            [
                'key' => 'item_group_id',
                'label' => 'Item Group Id',
                'required' => false
            ],
            [
                'key' => 'product_highlight',
                'label' => 'Product Highlight',
                'required' => false
            ],
            [
                'key' => 'ads_redirect',
                'label' => 'Ads Redirect',
                'required' => false
            ],
            [
                'key' => 'custom_label_0',
                'label' => 'Custom label 0',
                'required' => false
            ],
            [
                'key' => 'custom_label_1',
                'label' => 'Custom label 1',
                'required' => false
            ],
            [
                'key' => 'custom_label_2',
                'label' => 'Custom label 2',
                'required' => false
            ],
            [
                'key' => 'custom_label_3',
                'label' => 'Custom label 3',
                'required' => false
            ],
            [
                'key' => 'custom_label_4',
                'label' => 'Custom label 4',
                'required' => false
            ],
            [
                'key' => 'promotion_id',
                'label' => 'Promotion Id',
                'required' => false
            ],
            [
                'key' => 'shopping_ads_excluded_country',
                'label' => 'Shopping Ads Excluded Country',
                'required' => false
            ],
            [
                'key' => 'shipping_label',
                'label' => 'Shipping Label',
                'required' => false
            ],
            [
                'key' => 'shipping_weight_value',
                'label' => 'Shipping Weight Value',
                'required' => false
            ],
            [
                'key' => 'shipping_length_value',
                'label' => 'Shipping Length Value',
                'required' => false
            ],
            [
                'key' => 'shipping_width_value',
                'label' => 'Shipping Width Value',
                'required' => false
            ],
            [
                'key' => 'shipping_height_value',
                'label' => 'Shipping Height Value',
                'required' => false
            ],
            [
                'key' => 'ships_from_country',
                'label' => 'Ships From Country',
                'required' => false
            ],
            [
                'key' => 'transit_time_label',
                'label' => 'Transit Time Label',
                'required' => false
            ],
            [
                'key' => 'max_handling_time',
                'label' => 'Max Handling Time',
                'required' => false
            ],
            [
                'key' => 'min_handling_time',
                'label' => 'Min Handling Time',
                'required' => false
            ],
            [
                'key' => 'tax_category',
                'label' => 'Tax Category',
                'required' => false
            ]
        ];
    }


    public function setTemplate(TemplateContract $template) {}

    public function setMapping(array $mapping) {}
}