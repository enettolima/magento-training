<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 3:20 PM
 */

namespace Training\Vendor\Block\Vendors;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class Products extends Template
{

    /**
     * @var Registry
     */
    private $registry;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data)
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getVendor()
    {
        return $this->registry->registry('current_vendor');
    }

    public function getProducts()
    {
        $productIds = $this->getVendor()
            ->getResource()
            ->getAssociatedProductIds($this->getVendor()->getId());

        $this->searchCriteriaBuilder->addFilter('entity_id', $productIds, 'in');
        $result = $this->productRepository->getList(
            $this->searchCriteriaBuilder->create()
        );

        return $result->getItems();
    }
}