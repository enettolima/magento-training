<?php
/**
 * Created by PhpStorm.
 * User: enettolima
 * Date: 6/21/16
 * Time: 4:09 PM
 */

namespace Training\OrderSuccess\Block;


use Magento\Checkout\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\TestFramework\Event\Magento;

class Info extends Template
{
    private $checkoutSession;
    private $order;
    public function __construct(
        Context $context,
        Session $checkoutSession,
        array $data)
    {
        parent::__construct($context, $data);
        $this->checkoutSession = $checkoutSession;
    }

    private function getOrder(){
        if(!$this->order){
            $this->order = $this->checkoutSession->getLastRealOrder();
        }
        return $this->order;
    }

    public function getOrderStatus(){
        return $this->getOrder()->getStatus();
    }

    public function getOrderTotal(){
        return $this->getOrder()->getGrandTotal();
    }
}