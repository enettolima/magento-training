<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 5:38 PM
 */

namespace Training\Vendor\Api\Data;


interface VendorSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Training\Vendor\Api\Data\VendorInterface[]
     */
    public function getItems();

    /**
     * @param \Training\Vendor\Api\Data\VendorInterface[] $items
     * @return \Training\Vendor\Api\Data\VendorSearchResultsInterface[]
     */
    public function setItems(array $items);

}