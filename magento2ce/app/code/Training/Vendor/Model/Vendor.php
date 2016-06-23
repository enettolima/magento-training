<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 9:48 AM
 */

namespace Training\Vendor\Model;


use Magento\Framework\Model\AbstractModel;
use Training\Vendor\Api\Data\VendorInterface;

class Vendor extends AbstractModel implements VendorInterface
{

    protected function _construct()
    {
        $this->_init('Training\Vendor\Model\ResourceModel\Vendor');
    }

    /**
     * @return mixed
     */
    public function getVendorName()
    {
        return $this->getData('vendor_name');
    }

    /**
     * @param $name
     * @return \Training\Vendor\Api\Data\VendorInterface
     */
    public function setVendorName($name)
    {
        $this->setData('vendor_name', $name);
        return $this;
    }
}