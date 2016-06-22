<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 2:31 PM
 */

namespace Training\Vendor\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;

class Index extends Action
{

    /**
     * @var Registry
     */
    private $registry;

    public function __construct(
        Context $context,
        Registry $registry
    )
    {
        parent::__construct($context);
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
        /** @var \Magento\Framework\View\Result\Page $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->getConfig()->getTitle()->set(__('Vendors List'));

        $nameFilter = $this->getRequest()->getParam('vendor_name');
        $sort = $this->getRequest()->getParam('sort');

        $this->registry->register('vendor_name', $nameFilter);
        $this->registry->register('sort', $sort);

        return $result;

    }
}