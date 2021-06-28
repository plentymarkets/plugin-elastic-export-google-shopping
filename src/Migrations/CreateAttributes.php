<?php

namespace ElasticExportGoogleShopping\Migrations;

use Plenty\Modules\Item\Attribute\Contracts\AttributeRepositoryContract;

/**
 * Class CreateAttributes
 *
 * @package ElasticExportBasicPriceSearchEngine\Migrations
 */
class CreateAttributes
{
    /** @var AttributeRepositoryContract $attributeRepositoryContract */
    private $attributeRepositoryContract;

    public function __construct(AttributeRepositoryContract $attributeRepositoryContract)
    {
        $this->attributeRepositoryContract = $attributeRepositoryContract;
    }
    public function run()
    {
        $this->create();
    }

    public function create()
    {
        $attributes = $this->attributeRepositoryContract->all();
        $attributeTypes = ['material', 'size', 'color', 'pattern'];
        $attributeMapping = [];
        foreach($attributes->getResult() as $attribute) {
            if(in_array($attribute->googleproducts_variation, $attributeTypes)) {
                $attributeMapping[] = [
                    'key' => $attribute->googleproducts_variation,
                    'label' => ucfirst($attribute->googleproducts_variation),
                    'required' => false,
                    'default' => 'attribute-'.$attribute->id.'-valueName',
                    'type' => 'attribute-value-name',
                    'fieldKey' => 'name',
                    'isMapping' => false,
                    'id' => null
                ];
            }
        }
    }
}