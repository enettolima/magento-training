<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 5:43 PM
 */

namespace Training\Vendor\Model;


use Magento\Framework\Api\SortOrder;
use Training\Vendor\Api\Data;
use Training\Vendor\Api\Data\VendorSearchResultsInterfaceFactory;
use Training\Vendor\Api\VendorRepositoryInterface;
use Training\Vendor\Model\ResourceModel\Vendor as VendorResource;
use Training\Vendor\Model\ResourceModel\Vendor\CollectionFactory;

class VendorRepository implements VendorRepositoryInterface
{

    /**
     * @var VendorResource
     */
    private $vendorResource;
    /**
     * @var VendorFactory
     */
    private $vendorFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var VendorSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    public function __construct(
        VendorResource $vendorResource,
        VendorFactory $vendorFactory,
        CollectionFactory $collectionFactory,
        VendorSearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->vendorResource = $vendorResource;
        $this->vendorFactory = $vendorFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }


    /**
     * @param Data\VendorInterface $vendor
     * @return mixed
     */
    public function save(\Training\Vendor\Api\Data\VendorInterface $vendor)
    {
        $vendor->save();

        return $vendor->getId();
    }

    /**
     * @param $vendorId
     * @return \Training\Vendor\Api\Data\VendorInterface
     */
    public function getById($vendorId)
    {
        $vendor = $this->vendorFactory->create();

        return $vendor->load($vendorId);
    }

    /**
     * @param $vendorId
     * @return mixed
     */
    public function delete($vendorId)
    {
        $vendor = $this->vendorFactory->create();

        return $vendor->setId($vendorId)->delete();
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\Vendor\Api\Data\VendorSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        // filters
        foreach($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }

        // sorting
        /** @var SortOrder $sortOrder */
        foreach((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $field = $sortOrder->getField();
            $collection->addOrder(
                $field,
                $this->getSortOrderDirection($sortOrder)
            );

        }

        // pagination
        $collection->setCurPage($searchCriteria->getCurrentPage());

        // page size
        $collection->setPageSize($searchCriteria->getPageSize());

        // load
        $collection->load();

        // set search criteria
        /** @var \Training\Vendor\Api\Data\VendorSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);

        // set results
        $searchResults->setItems($collection->getData());

        // set total count
        $searchResults->setTotalCount($collection->getSize());

        // return result
        return $searchResults;
    }

    /**
     * @param $vendorId
     * @return mixed
     */
    public function getAssociatedProductIds($vendorId)
    {
        return json_encode($this->vendorResource->getAssociatedProductIds($vendorId));
    }

    /**
     * @param \Magento\Framework\Api\Search\FilterGroup $group
     * @param \Training\Vendor\Model\ResourceModel\Vendor\Collection $collection
     */
    private function addFilterGroupToCollection(\Magento\Framework\Api\Search\FilterGroup $group, $collection)
    {
        $fields = [];
        $conditions = [];

        foreach($group->getFilters() as $filter) {
            $condition = $filter->getConditionType() ?: 'eq';
            $field = $filter->getField();
            $value = $filter->getValue();
            $fields[] = $field;
            $conditions[] = array($condition => $value);
        }

        $collection->addFieldToFilter($fields, $conditions);
    }

    private function getSortOrderDirection(SortOrder $sortOrder)
    {
        if($sortOrder->getDirection() == SortOrder::SORT_ASC) {
            return SortOrder::SORT_ASC;
        } else {
            return SortOrder::SORT_DESC;
        }
    }
}