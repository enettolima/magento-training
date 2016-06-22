<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 9:50 AM
 */

namespace Training\Vendor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Vendor extends AbstractDb
{

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('training_vendor', 'vendor_id');
    }
    
    public function addRelations(array $data) {
        $this->getConnection()
            ->insertMultiple('training_vendor2product', $data);
    }

    public function getAssociatedProductIds($vendorId) {
        $select = $this->getConnection()->select();

        $select->from(
            ['v2p' => $this->getTable('training_vendor2product')],
            'product_id'
        )->where('v2p.vendor_id=?', $vendorId);

        return $this->getConnection()->fetchCol($select);
    }
}