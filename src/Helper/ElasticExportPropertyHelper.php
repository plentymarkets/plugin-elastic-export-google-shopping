<?php

namespace ElasticExportGoogleShopping\Helper;

use Illuminate\Support\Collection;
use Plenty\Modules\Item\Property\Contracts\PropertyMarketReferenceRepositoryContract;
use Plenty\Modules\Item\Property\Contracts\PropertyNameRepositoryContract;
use Plenty\Modules\Item\Property\Contracts\PropertyRepositoryContract;
use Plenty\Modules\Item\Property\Contracts\PropertySelectionRepositoryContract;
use Plenty\Modules\Item\Property\Models\Property;
use Plenty\Modules\Item\Property\Models\PropertyMarketReference;
use Plenty\Modules\Item\Property\Models\PropertyName;

/**
 * Class ElasticExportPropertyHelper
 * @package ElasticExportGoogleShopping\Helper
 */
class ElasticExportPropertyHelper
{
	
    const NOT_SET_FOR_MARKET = '0';
    const CHECKBOX_COMPONENT = '';

    const PROPERTY_TYPE_TEXT = 'text';
    const PROPERTY_TYPE_SELECTION = 'selection';
    const PROPERTY_TYPE_INT = 'int';
    const PROPERTY_TYPE_FLOAT = 'float';
    const PROPERTY_TYPE_EMPTY = 'empty';
    const PROPERTY_TYPE_FILE = 'file';

    /**
     * @var array
     */
    private $itemPropertyCache = [];

    /**
     * @var PropertyRepositoryContract
     */
    private $propertyRepository;

    /**
     * @var PropertyNameRepositoryContract
     */
    private $propertyNameRepository;

    /**
     * @var PropertyMarketReferenceRepositoryContract
     */
    private $propertyMarketReferenceRepository;

	/**
	 * @var array
	 */
    private $propertyList = [];

	/**
	 * @var bool
	 */
    private $listGenerated = false;

	/**
	 * ElasticExportPropertyHelper constructor.
     *
	 * @param PropertyMarketReferenceRepositoryContract $propertyMarketReferenceRepository
	 */
	public function __construct(
	    PropertyRepositoryContract $propertyRepository,
        PropertyNameRepositoryContract $propertyNameRepository,
        PropertyMarketReferenceRepositoryContract $propertyMarketReferenceRepository)
	{
        $this->propertyRepository = $propertyRepository;
        $this->propertyNameRepository = $propertyNameRepository;
        $this->propertyMarketReferenceRepository = $propertyMarketReferenceRepository;
	}

	/**
	 * Preload a list of properties for a specific marketplace.
	 * 
	 * @param float $marketReference
	 */
	public function getCompletePropertyList($marketReference)
	{
		$propertyList = $this->propertyMarketReferenceRepository->getPropertyMarketReferences($marketReference);
		
		foreach($propertyList as $property)
		{
			if($property instanceof PropertyMarketReference)
			{
				if(($property->externalComponent != "0" && strlen($property->externalComponent)) || (int)$property->componentId != 0)
				{
					$this->propertyList[$property->propertyId] = $property;
				}
			}
		}
		
		$this->listGenerated = true;
	}

	/**
	 * Get property.
	 *
	 * @param array $variation
	 * @param string $propertyType
	 * @param float $marketReference
	 * @param string $lang
	 * @return string
	 */
	public function getProperty($variation, string $propertyType, float $marketReference, string $lang = 'de'):string
	{
		if(count($this->propertyList) == 0 && $this->listGenerated === false)
		{
			$this->getCompletePropertyList($marketReference);
		}
		
		$itemPropertyList = $this->getItemPropertyList($variation, $marketReference, $lang);

		if(array_key_exists($propertyType, $itemPropertyList))
		{
			return $itemPropertyList[$propertyType];
		}

		return '';
	}

	/**
	 * Returns a list of configured properties and builds also the property data for
	 * further usage. The properties need to have a configuration for a marketReference.
	 *
	 * @param array $variation
	 * @param float $marketReference
     * @param string $lang
	 * @return array
	 */
	public function getItemPropertyList($variation, float $marketReference, string $lang = 'de'):array
	{
		if(count($this->propertyList) == 0 && $this->listGenerated === false)
		{
			$this->getCompletePropertyList($marketReference);
		}
		/** @var PropertySelectionRepositoryContract $test */
		$test = pluginApp(PropertySelectionRepositoryContract::class);
//		$this->propertyList[2]->propertyId
		$test2 = $test->findByProperty(2);

//		foreach($this->propertyList as $property) {
//		    $propertyOptions = $test->findByProperty($property->propertyId);
//		    $properties[$property->propertyId]['name'] = $property->externalComponent;
//		    foreach($propertyOptions as $propertyOption) {
//                $properties[$property->propertyId]['options'][] = [
//                    'name' => $propertyOption->name,
//                    'description' => $propertyOption->description,
//                    'lang' => $propertyOption->lang
//                ];
//            }
//        }
        foreach($this->propertyList as $property) {
            $propertyOptions = $test->findByProperty($property->propertyId);
            $properties[$property->propertyId]['name'] = $property->externalComponent;
            foreach($propertyOptions as $propertyOption) {
                $properties[$property->propertyId]['options'][$propertyOption->id][$propertyOption->lang] = $propertyOption->name;
            }
        }

		if(!array_key_exists($variation['data']['item']['id'], $this->itemPropertyCache))
		{
			unset($this->itemPropertyCache);

			$list = array();
			
			if(is_array($this->propertyList) && count($this->propertyList))
			{
				foreach($variation['data']['properties'] as $variationProperty)
				{
					if(array_key_exists($variationProperty['property']['id'], $this->propertyList))
					{
						$key = '';
						if(!is_null($variationProperty['property']['id']) &&
							$variationProperty['property']['valueType'] != self::PROPERTY_TYPE_FILE)
						{
							// Check if property with this lang exists
							$propertyName = $this->getPropertyName($variationProperty);

							// Check if property with this marketReference exists
							$propertyMarketReference = $this->propertyList[$variationProperty['property']['id']];

							if($propertyMarketReference instanceof PropertyMarketReference)
							{
								if($propertyMarketReference->externalComponent == self::NOT_SET_FOR_MARKET)
								{
									continue;
								}

								// If property exists, then verify if it's select box or check box and set the associated key
								if($propertyMarketReference->externalComponent !== self::CHECKBOX_COMPONENT)
								{
									$key = $propertyMarketReference->externalComponent;
								}
								elseif(strlen($propertyName))
								{
									$key = $propertyName;
								}

								if(strlen($key))
								{
									// Get the value of property type depending of the type
									if(!empty($this->getValueOfNonEmptyPropertyType($variationProperty)))
									{
										$list[(string)$key] = $this->getValueOfNonEmptyPropertyType($variationProperty);
									}
									elseif($this->hasEmptyPropertyType($variationProperty))
									{
										$list[(string)$key] = '';
									}
								}
							}
						}
					}
				}
			}

			$this->itemPropertyCache[$variation['data']['item']['id']] = $list;
		}

		return $this->itemPropertyCache[$variation['data']['item']['id']];
	}

    /**
     * Get the value of first property with the specified backendName.
     * The marketReference of the property is not taken into account.
     *
     * @param array $variation
     * @param string $backendName
     * @param string $lang
     * @return string
     */
    public function getItemPropertyByBackendName(array $variation, string $backendName, string $lang = 'de'): string
    {
        foreach($variation['data']['properties'] as $variationProperty)
        {
            if(!is_null($variationProperty['property']['id']) &&
                $variationProperty['property']['valueType'] != 'file')
            {
                $propertyName = $this->propertyNameRepository->findOne($variationProperty['property']['id'], $lang);

                if($propertyName instanceof PropertyName && !is_null($propertyName))
                {
                    $property = $this->propertyRepository->findById($variationProperty['property']['id']);

                    if($property instanceof Property && !is_null($property) && $property->backendName == $backendName)
                    {
                        return $this->getValueOfNonEmptyPropertyType($variationProperty);
                    }
                }
            }
        }

        return '';
    }

    /**
     * Get the value of a property that has non-empty type.
     *
     * @param array $property
     * @return string
     */
    private function getValueOfNonEmptyPropertyType($property):string
    {
        if(isset($property['property']) && isset($property['property']['valueType']))
        {
            if($property['property']['valueType'] == self::PROPERTY_TYPE_TEXT)
            {
                if(isset($property['texts']) && is_array($property['texts']))
                {
                    if(isset($property['texts']['value']))
                    {
                        return (string)$property['texts']['value'];
                    }
                }
            }

            if($property['property']['valueType'] == self::PROPERTY_TYPE_SELECTION)
            {
                if(isset($property['selection']) && is_array($property['selection']))
                {
                    if(isset($property['selection']['name']))
                    {
                        return (string)$property['selection']['name'];
                    }
                }
            }

            if($property['property']['valueType'] == self::PROPERTY_TYPE_INT)
            {
                if(isset($property['valueInt']))
                {
                    return (string)$property['valueInt'];
                }
            }

            if($property['property']['valueType'] == self::PROPERTY_TYPE_FLOAT)
            {
                if(isset($property['valueFloat']))
                {
                    return (string)$property['valueFloat'];
                }
            }
        }

        return '';
    }

    /**
     * Get if property has empty type.
     *
     * @param array $property
     * @return bool
     */
    private function hasEmptyPropertyType(array $property):bool
    {
        if($property['property']['valueType'] == self::PROPERTY_TYPE_EMPTY)
        {
            return true;
        }

        return false;
    }

	/**
     * Get the property name.
     *
	 * @param $variationProperty
	 * @return string
	 */
    public function getPropertyName($variationProperty)
	{
		if(isset($variationProperty['property']['names']['name']) && strlen($variationProperty['property']['names']['name']))
		{
			return $variationProperty['property']['names']['name'];
		}

		return '';
	}
}