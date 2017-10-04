<?php

namespace ElasticExportGoogleShopping\Helper;

use ElasticExport\Helper\ElasticExportPropertyHelper;
use ElasticExportGoogleShopping\Generator\GoogleShopping;
use Plenty\Modules\Helper\Models\KeyValue;
use Plenty\Modules\Item\Attribute\Contracts\AttributeRepositoryContract;
use Plenty\Modules\Item\Attribute\Contracts\AttributeValueNameRepositoryContract;
use Plenty\Modules\Item\Attribute\Contracts\AttributeValueRepositoryContract;
use Plenty\Modules\Item\Attribute\Models\Attribute;
use Plenty\Modules\Item\Attribute\Models\AttributeValueName;
use Plenty\Repositories\Models\PaginatedResult;

class AttributeHelper
{
    const CHARACTER_TYPE_COLOR						= 'color';
    const CHARACTER_TYPE_SIZE						= 'size';
    const CHARACTER_TYPE_PATTERN					= 'pattern';
    const CHARACTER_TYPE_MATERIAL					= 'material';

    /**
     * @var array
     */
    private $attributeValueCache = [];

    /**
     * @var array
     */
    private $linkedAttributeList = [];

    /**
     * @var AttributeRepositoryContract $attributeRepositoryContract
     */
    private $attributeRepositoryContract;
    /**
     * @var AttributeValueRepositoryContract
     */
    private $attributeValueRepositoryContract;
    /**
     * @var AttributeValueNameRepositoryContract
     */
    private $attributeValueNameRepositoryContract;
	/**
	 * @var ElasticExportPropertyHelper
	 */
    private $elasticExportPropertyHelper;

    /**
     * AttributeHelper constructor.
     * @param AttributeRepositoryContract $attributeRepositoryContract
     * @param AttributeValueRepositoryContract $attributeValueRepositoryContract
     * @param AttributeValueNameRepositoryContract $attributeValueNameRepositoryContract
     */
    public function __construct(
        AttributeRepositoryContract $attributeRepositoryContract,
        AttributeValueRepositoryContract $attributeValueRepositoryContract,
        AttributeValueNameRepositoryContract $attributeValueNameRepositoryContract)
    {
        $this->attributeRepositoryContract = $attributeRepositoryContract;
        $this->attributeValueRepositoryContract = $attributeValueRepositoryContract;
        $this->attributeValueNameRepositoryContract = $attributeValueNameRepositoryContract;
    }

    /**
     * Get variation attributes.
     *
     * @param array $variation
	 * @param KeyValue $settings
     * @return array
     */
    public function getVariationAttributes($variation, $settings):array
    {
    	$this->elasticExportPropertyHelper = pluginApp(ElasticExportPropertyHelper::class);

        $list = [];
        $variationAttributes = [];

        foreach($variation['data']['attributes'] as $attributeValue)
        {
            if(isset($attributeValue['attributeId'])
                && array_key_exists($attributeValue['attributeId'], $this->linkedAttributeList)
                && strlen($this->linkedAttributeList[$attributeValue['attributeId']]) > 0)
            {
                if (strlen($this->attributeValueCache[$attributeValue['valueId']]) > 0)
                {
                    $variationAttributes[$this->linkedAttributeList[$attributeValue['attributeId']]][] = $this->attributeValueCache[$attributeValue['valueId']];
                }
            }
        }

        $typeList = array(
            self::CHARACTER_TYPE_COLOR,
            self::CHARACTER_TYPE_SIZE,
            self::CHARACTER_TYPE_PATTERN,
            self::CHARACTER_TYPE_MATERIAL
        );

        foreach ($typeList as $type)
        {
            $property = $this->elasticExportPropertyHelper->getProperty($variation, $type, GoogleShopping::GOOGLE_SHOPPING, $settings->get('lang'));

            if (strlen(trim($property)) > 0)
            {
                $list[$type] = trim($property);
            }
            elseif (strlen(trim($variationAttributes[$type][0])) > 0)
            {
                $list[$type] = trim($variationAttributes[$type][0]);
            }
            else
            {
                $list[$type] = '';
            }
        }

        return $list;
    }

    /**
     * Get Google linked attribute list.
     *
     * @param KeyValue $settings
     */
    public function loadLinkedAttributeList(KeyValue $settings)
    {
        $page = 1;
        $totalCount = null;
        $attributeList = $this->attributeRepositoryContract->all();

        if($attributeList instanceof PaginatedResult)
        {
            $totalCount = $attributeList->getTotalCount();

            // pagination iteration
            while($totalCount > 0)
            {
                $this->iterateAttributeList($attributeList, $settings);

                $page++;
                $totalCount = $totalCount - 50;

                $attributeList = $this->attributeRepositoryContract->all(['*'], 50, $page);
            }
        }
    }

    /**
     * Iterates threw an attribute list and prepares the attribute values for the
     * class cache.
     *
     * @param PaginatedResult $attributeList
     * @param KeyValue $settings
     */
    private function iterateAttributeList($attributeList, $settings)
    {
        foreach($attributeList->getResult() as $attribute)
        {
            $attributeValuePage = 1;
            $attributeValueTotal = null;

            if($attribute instanceof Attribute)
            {
                if(strlen($attribute->googleShoppingAttribute) > 0)
                {
                    $this->linkedAttributeList[$attribute->id] = $attribute->googleShoppingAttribute;

                    $attributeValueList = $this->attributeValueRepositoryContract->findByAttributeId($attribute->id, $attributeValuePage);
                    if($attributeValueList instanceof PaginatedResult)
                    {
                        $attributeValueTotal = $attributeValueList->getTotalCount();
                        while($attributeValueTotal > 0)
                        {
                            $this->setAttributeValueToCache($attributeValueList, $settings);
                            $attributeValuePage++;
                            $attributeValueTotal = $attributeValueTotal - 50;
                            $attributeValueList = $this->attributeValueRepositoryContract->findByAttributeId($attribute->id, $attributeValuePage);
                        }
                    }
                }
            }
        }
    }

    /**
     * @param PaginatedResult $attributeValueList
     * @param KeyValue $settings
     */
    private function setAttributeValueToCache($attributeValueList, $settings)
    {
        if($attributeValueList instanceof PaginatedResult)
        {
            foreach ($attributeValueList->getResult() as $attributeValue)
            {
                $attributeValueName = $this->attributeValueNameRepositoryContract->findOne($attributeValue->id, $settings->get('lang'));

                if($attributeValueName instanceof AttributeValueName)
                {
                    $this->attributeValueCache[$attributeValue->id] = $attributeValueName->name;
                }
            }
        }
    }
}