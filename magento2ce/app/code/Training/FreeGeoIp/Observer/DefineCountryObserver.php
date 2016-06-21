<?php
/**
 * Created by PhpStorm.
 * User: enettolima
 * Date: 6/20/16
 * Time: 10:04 AM
 */

namespace Training\FreeGeoIp\Observer;


use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\Client\CurlFactory;
use Psr\Log\LoggerInterface;

class DefineCountryObserver implements ObserverInterface
{

    /**
     * @var CurlFactory
     */
    private $curlFactory;
    const ENDPOINT_URL = 'http://freegeoip.net/json/';

    public function __construct
    (
        LoggerInterface $logger,
        CurlFactory $curlFactory
    )
    {
        $this->logger = $logger;
        $this->curlFactory = $curlFactory;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $this->logger->debug("Observer fires");
        /** @var RequestInterface $request */
        $request = $observer->getEvent()->getData('request');
        $ip = $request->getClientIp();

        /** @var Curl $client */
        //$client = $this->curlFactory->create();
        //$client->get(self::ENDPOINT_URL . $ip);

        //$response = $client->getBody();
        //$data = (object) json_decode($response);

        /*$request->setParam(
            'visitor_info',
            sprintf('ip: %s, Country: %s', $ip, $data->country_name)
        );*/

        $request->setParam(
            'visitor_info',
            sprintf('ip: 127.0.0.1, Country: US', $ip, 'United States')
        );

    }
}