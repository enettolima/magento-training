<?php
/**
 * Created by PhpStorm.
 * User: enettolima
 * Date: 6/21/16
 * Time: 11:11 AM
 */

namespace Training\ExchangeRate\Block;


use Magento\Framework\View\Element\Template;
use Training\ExchangeRate\Model\Rate as ExchangeRate;

class Rate extends Template
{
    private $exchangeRate;
    public function __construct(Template\Context $context, ExchangeRate $exchangeRate, array $data)
    {
        parent::__construct($context, $data);
        $this->exchangeRate = $exchangeRate;
    }

    public function getExchangeRate(){
        //

        $exchangeRate = $this->exchangeRate->getExchangeRate();
        return $exchangeRate->rates->EUR;
        //die("Failed");
        //return 'bananas';
    }
}