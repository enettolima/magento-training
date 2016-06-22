<?php
/**
 * Created by PhpStorm.
 * User: enettolima
 * Date: 6/20/16
 * Time: 3:51 PM
 */

namespace Training\AutoLogin\Controller\Index;


use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

use Magento\Checkout\Model\Cart;
use Magento\Checkout\Helper\Cart as CartHelper;


class Index extends Action
{
    private $customerAccountManagement;
    private $session;
    private $productRepository;
    private $cart;
    private $cartHelper;

    public function __construct(Context $context,
        Session $session,
        AccountManagementInterface $customerAccountManagement,
        ProductRepositoryInterface $productRepository,
        Cart $cart,
        CartHelper $cartHelper

    )
    {
        parent::__construct($context);
        $this->session = $session;
        $this->customerAccountManagement = $customerAccountManagement;
        $this->productRepository = $productRepository;
        $this->cart = $cart;
        $this->cartHelper = $cartHelper;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $productId = $this->getRequest()->getParam('product_id');
        $username = $this->getRequest()->getParam('username');
        $password = $this->getRequest()->getParam('password');
        $this->getResponse()->setBody('Order is '.$productId.' - username is '.$username.' pass: '.$password);

        $objectManager = ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        if(!$customerSession->isLoggedIn()) {
            // customer login action
            $login = $this->getRequest()->getPost('login');
            if (!empty($username) && !empty($password)) {
                try {
                    $customer = $this->customerAccountManagement->authenticate($username, $password);
                    $this->session->setCustomerDataAsLoggedIn($customer);
                    $this->session->regenerateId();

                    //Add product to cart
                    $product = $this->productRepository->get($productId);
                    $params = ['qty' => 1];
                    $this->cart->addProduct($product, $params);
                    $this->cart->save();

                    /** @var \Magento\Framework\Controller\Result\Redirect $result */
                    $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                    $cartUrl = $this->cartHelper->getCartUrl();
                    $result->setUrl($cartUrl);
                    return $result;
                } catch (\Exception $e){
                    $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
                    $result->setContents($e->getMessage());
                }
            }
            return $result;
        }
    }
}