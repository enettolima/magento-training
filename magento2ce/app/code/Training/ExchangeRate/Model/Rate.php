<?php
/**
 * Created by PhpStorm.
 * User: enettolima
 * Date: 6/21/16
 * Time: 11:20 AM
 */

namespace Training\ExchangeRate\Model;


use Magento\Framework\HTTP\Client\CurlFactory;

class Rate
{
    const ENDPOINT_URL = 'http://api.fixer.io/latest?base=USD';

    private $curlFactory;
    private $response;
    public function __construct(CurlFactory $curlFactory)
    {
        $this->curlFactory = $curlFactory;
    }

    public function getExchangeRate(){
        if(!$this->response){
            $client = $this->curlFactory->create();
            $client->get(self::ENDPOINT_URL);
            $this->response = (object) json_decode($client->getBody());
        }

        return $this->response;
    }
}