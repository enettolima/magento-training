<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 3:19 PM
 */

namespace Training\Vendor\Block;


use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Training\Vendor\Model\ResourceModel\Vendor\CollectionFactory;
use Training\Vendor\Model\Vendor;

class Vendors extends Template
{

    /**
     * @var Registry
     */
    private $registry;

    private $collection;
    /**
     * @var CollectionFactory
     */
    private $vendorCollectionFactory;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        CollectionFactory $vendorCollectionFactory,
        array $data)
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
    }

    public function getVendorName() {
        return $this->registry->registry('vendor_name');
    }

    public function getSortOrder() {
        return $this->registry->registry('sort');
    }

    public function getVendors() {
        if(!$this->collection) {
            $this->collection = $this->vendorCollectionFactory->create();

            if($this->getVendorName()) {
                $this->collection->addFieldToFilter(
                    'vendor_name',
                    ['like' => '%' . $this->getVendorName() . '%']
                );
            }

            if($this->getSortOrder()) {
                $this->collection->setOrder('vendor_name', $this->getSortOrder());
            }

        }

        return $this->collection;
    }

    public function getVendorListUrl() {
        return $this->getUrl('vendors/index/index');
    }

    public function getVendorUrl(Vendor $vendor) {
        return $this->getUrl('vendors/detail/index/', ['id' => $vendor->getId()]);
    }

    public function isChecked($direction = 'asc') {
        if($this->getSortOrder() == $direction) {
            return 'checked="1"';
        } else return null;
    }
}