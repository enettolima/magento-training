<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 12:32 PM
 */

namespace Training\Vendor\Block\Product;


use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Training\Vendor\Model\ResourceModel\Vendor\CollectionFactory;
use Training\Vendor\Model\ResourceModel\Vendor\Collection;

class VendorList extends Template
{

    /**
     * @var Collection
     */
    private $collection;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var Registry
     */
    private $registry;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        Registry $registry,
        array $data
    )
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->registry = $registry;
    }


    public function hasVendors() {
        return $this->getVendors()->getSize();
    }

    /**
     * @return Collection
     */
    public function getVendors()
    {
        return $this->getCollection();
    }

    /**
     * @return Collection
     */
    private function getCollection()
    {
        if (!$this->collection) {
            $this->collection = $this->collectionFactory
                ->create()
                ->addProductFilter($this->getProductId());
        }

        return $this->collection;

    }

    /**
     * @return mixed
     */
    private function getProductId()
    {
        return $this->getProduct()->getId();
    }

    /**
     * @return ProductInterface
     */
    private function getProduct()
    {
        return $this->registry->registry('current_product');
    }

}