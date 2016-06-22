<?php
/**
 * Created by PhpStorm.
 * User: enettolima
 * Date: 6/21/16
 * Time: 10:20 AM
 */

namespace Training\Custom404Page\Controller\Category;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;

class Index extends Action
{

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $this->getResponse()->setBody('No category found.');
    }
}