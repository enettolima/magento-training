<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 9:48 AM
 */

namespace Training\Vendor\Model;


use Magento\Framework\Model\AbstractModel;

class Vendor extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Training\Vendor\Model\ResourceModel\Vendor');
    }
}