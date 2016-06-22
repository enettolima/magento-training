<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 3:20 PM
 */

namespace Training\Vendor\Block\Vendors;


use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class Details extends Template
{

    /**
     * @var Registry
     */
    private $registry;

    public function __construct(
        Template\Context $context, 
        Registry $registry,
        array $data)
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
    }
    
    public function getVendor() {
        return $this->registry->registry('current_vendor');
    }
    
    public function getVendorName() {
        return $this->getVendor()->getVendorName();
    }

}