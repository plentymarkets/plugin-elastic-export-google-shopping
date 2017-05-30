<?php

namespace ElasticExportGoogleShopping\Helper;

use Plenty\Modules\Item\Property\Contracts\PropertyMarketReferenceRepositoryContract;
use Plenty\Modules\Item\Property\Contracts\PropertyNameRepositoryContract;

class PropertyHelper
{
	const GOOGLE_SHOPPING = 129.00;

    const CHARACTER_TYPE_GENDER						= 'gender';
    const CHARACTER_TYPE_AGE_GROUP					= 'age_group';
    const CHARACTER_TYPE_SIZE_TYPE					= 'size_type';
    const CHARACTER_TYPE_SIZE_SYSTEM				= 'size_system';
    const CHARACTER_TYPE_ENERGY_EFFICIENCY_CLASS	= 'energy_efficiency_class';

    private $itemPropertyCache = [];

    /**
     * Get property.
     *
     * @param array $variation
     * @param string $propertyType
     * @return string
     */
    public function getProperty($variation, string $propertyType):string
    {
        $itemPropertyList = $this->getItemPropertyList($variation);

        if(array_key_exists($propertyType, $itemPropertyList))
        {
            return $itemPropertyList[$propertyType];
        }

        return '';
    }

    /**
     * Returns a list of additional header for the CSV based on
     * the configured properties and builds also the property data for
     * further usage. The properties have to have a configuration for BeezUp.
     *
     * @param array $variation
     * @return array
     */
    private function getItemPropertyList($variation):array
    {
        if(!array_key_exists($variation['data']['item']['id'], $this->itemPropertyCache))
        {
            /**
             * @var PropertyNameRepositoryContract $propertyNameRepository
             */
            $propertyNameRepository = pluginApp(PropertyNameRepositoryContract::class);

            /**
             * @var PropertyMarketReferenceRepositoryContract $propertyMarketReferenceRepository
             */
            $propertyMarketReferenceRepository = pluginApp(PropertyMarketReferenceRepositoryContract::class);

            if(!$propertyNameRepository instanceof PropertyNameRepositoryContract ||
                !$propertyMarketReferenceRepository instanceof PropertyMarketReferenceRepositoryContract)
            {
                return [];
            }

            $list = array();

            foreach($variation['data']['properties'] as $property)
            {
                if(!is_null($property['property']['id']) &&
                    $property['property']['valueType'] != 'file' &&
                    $property['property']['valueType'] != 'empty')
                {
                    $propertyMarketReference = $propertyMarketReferenceRepository->findOne($property['property']['id'], self::GOOGLE_SHOPPING);

                    if(
                        is_null($propertyMarketReference) ||
                        $propertyMarketReference->externalComponent == '0'
                    )
                    {
                        continue;
                    }


                    if($property['property']['valueType'] == 'text')
                    {
                        if(is_array($property['texts']) && !is_null($property['texts']['value']))
                        {
                            $list[(string)$propertyMarketReference->externalComponent] = $property['texts']['value'];
                        }
                    }
                    if($property['property']['valueType'] == 'selection')
                    {
                        if(is_array($property['selection']) && !is_null($property['selection']['name']))
                        {
                            $list[(string)$propertyMarketReference->externalComponent] = $property['selection']['name'];
                        }
                    }
                }
            }
            $this->itemPropertyCache[$variation['data']['item']['id']] = $list;
        }
        return $this->itemPropertyCache[$variation['data']['item']['id']];
    }
}