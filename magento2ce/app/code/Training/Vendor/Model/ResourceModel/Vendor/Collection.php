<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 9:55 AM
 */

namespace Training\Vendor\Model\ResourceModel\Vendor;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(
            'Training\Vendor\Model\Vendor',
            'Training\Vendor\Model\ResourceModel\Vendor'
        );
    }

    public function addProductFilter($productId)
    {
        $this->getSelect()
            ->join(
                ['v2p' => $this->getTable('training_vendor2product')],
                'main_table.vendor_id = v2p.vendor_id')
            ->where('v2p.product_id =?', $productId);

        return $this;
    }
}