<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 5:35 PM
 */

namespace Training\Vendor\Api\Data;


interface VendorInterface
{

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $id
     * @return \Training\Vendor\Api\Data\VendorInterface
     */
    public function setId($id);

    /**
     * @return mixed
     */
    public function getVendorName();

    /**
     * @param $name
     * @return \Training\Vendor\Api\Data\VendorInterface
     */
    public function setVendorName($name);

}