<?php

namespace ElasticExportGoogleShopping\Migrations;

use Plenty\Modules\Property\Contracts\PropertyGroupNameRepositoryContract;
use Plenty\Modules\Property\Contracts\PropertyGroupOptionRepositoryContract;
use Plenty\Modules\Property\Contracts\PropertyGroupRelationRepositoryContract;
use Plenty\Modules\Property\Contracts\PropertyGroupRepositoryContract;
use Plenty\Modules\Property\Contracts\PropertyNameRepositoryContract;
use Plenty\Modules\Property\Contracts\PropertyOptionRepositoryContract;
use Plenty\Modules\Property\Contracts\PropertyRelationValueRepositoryContract;
use Plenty\Modules\Property\Contracts\PropertyRepositoryContract;
use Plenty\Modules\Property\Contracts\PropertySelectionRepositoryContract;
use Plenty\Modules\Property\Models\Property;
use Plenty\Modules\Property\Models\PropertyGroup;
use Plenty\Modules\Property\Models\PropertyGroupRelation;
use Rewe\Helper\DynamoDbHelper;
use Rewe\Product\Helper\ProductPropertyHelper;
use Rewe\Services\ConfigService;

/**
 * Class CreateProperties
 *
 * @package ElasticExportGoogleShopping\Migrations
 */
class CreateProperties
{
    /** @var PropertyGroupRepositoryContract */
    private $propertyGroupRepository;

    /** @var PropertyGroupNameRepositoryContract */
    private $propertyGroupNameRepository;

    /** @var PropertyGroupOptionRepositoryContract */
    private $propertyGroupOptionRepository;

    /** @var PropertyRepositoryContract */
    private $propertyRepository;

    /** @var PropertySelectionRepositoryContract */
    private $propertySelectionRepository;

    /** @var ProductPropertyHelper */
    private $productPropertyHelper;

    /** @var PropertyOptionRepositoryContract */
    private $propertyOptionRepository;

    /** @var float */
    private $orderReferrer;

    /**
     * CreateProductTypeProperty constructor.
     *
     * @param ProductPropertyHelper $productPropertyHelper
     * @param PropertyGroupRepositoryContract $propertyGroupRepositoryContract
     * @param PropertyGroupNameRepositoryContract $propertyGroupNameRepositoryContract
     * @param PropertyRepositoryContract $propertyRepositoryContract
     * @param PropertySelectionRepositoryContract $propertySelectionRepositoryContract
     * @param PropertyGroupOptionRepositoryContract $propertyGroupOptionRepositoryContract
     * @param PropertyOptionRepositoryContract $propertyOptionRepositoryContract
     */
    public function __construct(
        ProductPropertyHelper $productPropertyHelper,
        PropertyGroupRepositoryContract $propertyGroupRepositoryContract,
        PropertyGroupNameRepositoryContract $propertyGroupNameRepositoryContract,
        PropertyRepositoryContract $propertyRepositoryContract,
        PropertySelectionRepositoryContract $propertySelectionRepositoryContract,
        PropertyGroupOptionRepositoryContract $propertyGroupOptionRepositoryContract,
        PropertyOptionRepositoryContract $propertyOptionRepositoryContract
    )
    {
        $this->productPropertyHelper = $productPropertyHelper;
        $this->propertyGroupRepository = $propertyGroupRepositoryContract;
        $this->propertyGroupNameRepository = $propertyGroupNameRepositoryContract;
        $this->propertyRepository = $propertyRepositoryContract;
        $this->propertySelectionRepository = $propertySelectionRepositoryContract;
        $this->propertyGroupOptionRepository = $propertyGroupOptionRepositoryContract;
        $this->propertyOptionRepository = $propertyOptionRepositoryContract;
    }

    public function run()
    {

//        /** @var PropertyGroup $propertyGroup */
//        $propertyGroup = $this->createGeneralRewePropertyGroup();
//
//        /** @var Property $productTypeProperty */
//        $productTypeProperty =  $this->createProductTypeProperty();
//
//        /** @var PropertyGroupRelationRepositoryContract $propertyGroupRelationRepo */
//        $propertyGroupRelationRepo = pluginApp(PropertyGroupRelationRepositoryContract::class);
//        $propertyGroupRelationRepo->link($productTypeProperty->id, $propertyGroup->id);

    }

    /**
     * @return PropertyGroup
     */
    private function createGeneralRewePropertyGroup()
    {
        /** @var PropertyGroup $group */
        $group = $this->propertyGroupRepository->createGroup([
            'groupType' => '',
            'surchargeType' => '',
            'position' => 1
        ]);

        $this->propertyGroupOptionRepository->createGroupOption([
            'propertyGroupId' => $group->id,
            'groupOptionIdentifier' => 'surchargeType',
            'value' => 'none',
        ]);

        $this->propertyGroupOptionRepository->createGroupOption([
            'propertyGroupId' => $group->id,
            'groupOptionIdentifier' => 'groupType',
            'value' => 'none',
        ]);

        /** @var PropertyGroup $germanGroupName */
        $germanGroupName = $this->propertyGroupNameRepository->createGroupName([
            'propertyGroupId' => $group->id,
            'description' => '',
            'lang' => 'de',
            'name' => 'GoogleShopping'
        ]);

        /** @var PropertyGroup $englishGroupName */
        $englishGroupName = $this->propertyGroupNameRepository->createGroupName([
            'propertyGroupId' => $group->id,
            'description' => '',
            'lang' => 'en',
            'name' => 'GoogleShopping'
        ]);

        return $group;
    }

    /**
     * @return Property
     */
    private function createProductTypeProperty()
    {
        /** @var Property $productTypeProperty */
        $productTypeProperty = $this->propertyRepository->createProperty([
            'cast' => 'selection',
            'typeIdentifier' => 'item',
            'position' => 1,
            'names' => [
                [
                    'lang' => 'de',
                    'name' => 'Shipping Size Unit 1',
                    'description' => ''
                ],
                [
                    'lang' => 'en',
                    'name' => 'Shipping Size Unit 1',
                    'description' => ''
                ],
            ],
            'availabilities' => null,
            'description' => '',
            'selections' => null,
            'options' => null
        ]);

        $this->propertySelectionRepository->createPropertySelection([
            'propertyId' => $productTypeProperty->id,
            'position' => 0,
            'relation' => [
                [
                    'relationTargetId' => null,
                    'relationTypeIdentifier' => null,
                    'relationValues' => [
                        [
                            'value' => 'in',
                            'lang' => 'de',
                        ],
                        [
                            'value' => 'in',
                            'lang' => 'en',
                        ],
                    ],
                ],
            ],
        ]);

        $this->propertySelectionRepository->createPropertySelection([
            'propertyId' => $productTypeProperty->id,
            'position' => 0,
            'relation' => [
                [
                    'relationTargetId' => null,
                    'relationTypeIdentifier' => null,
                    'relationValues' => [
                        [
                            'value' => 'cm',
                            'lang' => 'de',
                        ],
                        [
                            'value' => 'cm',
                            'lang' => 'en',
                        ],
                    ],
                ],
            ],
        ]);

//        $this->propertyOptionRepository->createPropertyOption([
//            'propertyId' => $productTypeProperty->id,
//            'typeOptionIdentifier' => 'referrers',
//            'value' => [
//                $this->orderReferrer
//            ]
//        ]);

        return $productTypeProperty;
    }
}