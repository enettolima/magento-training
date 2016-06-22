<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 2:32 PM
 */

namespace Training\Vendor\Controller\Detail;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;
use Training\Vendor\Model\VendorFactory;

class Index extends Action
{

    /**
     * @var VendorFactory
     */
    private $vendorFactory;
    /**
     * @var Registry
     */
    private $registry;

    public function __construct(
        Context $context,
        VendorFactory $vendorFactory,
        Registry $registry
)
    {
        parent::__construct($context);
        $this->vendorFactory = $vendorFactory;
        $this->registry = $registry;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $vendor = $this->vendorFactory->create();

        $vendorId = $this->getRequest()->getParam('id');

        $vendor->load($vendorId);

        if($vendor->getId()) {
            $this->registry->register('current_vendor', $vendor);
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        } else {
            $result = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
            $result->forward('noroute');
        }

        return $result;
    }
}