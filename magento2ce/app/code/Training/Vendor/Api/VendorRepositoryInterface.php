<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 5:31 PM
 */

namespace Training\Vendor\Api;


interface VendorRepositoryInterface
{

    /**
     * @param Data\VendorInterface $vendor
     * @return mixed
     */
    public function save(\Training\Vendor\Api\Data\VendorInterface $vendor);

    /**
     * @param $vendorId
     * @return \Training\Vendor\Api\Data\VendorInterface
     */
    public function getById($vendorId);

    /**
     * @param $vendorId
     * @return mixed
     */
    public function delete($vendorId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\Vendor\Api\Data\VendorSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param $vendorId
     * @return mixed
     */
    public function getAssociatedProductIds($vendorId);
}