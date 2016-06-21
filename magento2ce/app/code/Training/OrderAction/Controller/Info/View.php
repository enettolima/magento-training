<?php
/**
 * Created by PhpStorm.
 * User: enettolima
 * Date: 6/20/16
 * Time: 2:45 PM
 */

namespace Training\OrderAction\Controller\Info;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\App\Action\Context;


class View extends Action
{

    public function __construct(Context $context, OrderRepositoryInterface $orderRepository)
    {
        parent::__construct($context);
        $this->orderRepository = $orderRepository;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        //$this->getResponse()->setBody('it works!');
        $orderId = $this->getRequest()->getParam('order_id');

        try{
            //$orderId = $this->getRequest()->getParam($orderId);
            $isJson = $this->getRequest()->getParam('json',false);
            $order = $this->orderRepository->get($orderId);
            $orderData = $this->buildOrderData();
            $orderData = [
                'total' => $order->getGranTotal(),
                'total_invoiced' => $order->getTotalInvoiced(),
                'status' => $order->getStatus(),
                'items' => array_map(function (OrderItemInterface $item){
                    return [
                        'sku' => $item->getSku(),
                        'item_id' => $item->getQuoteItemId(),
                        'price' => $item->getPrice(),
                        'qty' => $item->getQtyOrdered()
                    ];
                }, $order->getItems())
            ];

            if($isJson){
                /** @var \Magento\Framework\Controller\Result\Json $result */
                $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
                $result->setData($orderData);
            }else{
                /** @var \Magento\Framework\Controller\Result\Json $result */
                $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
                $result->setData($orderData);
            }
        } catch (\Exception $e){
            $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
            $result->setContents($e->getMessage());
        }
        return $result;
    }
}