<?php
/**
 * Created by PhpStorm.
 * User: enettolima
 * Date: 6/21/16
 * Time: 8:52 AM
 */

namespace Training\AutoLogin\Controller;


use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Zend\Mvc\Router\RouteInterface;

class Router implements RouterInterface
{

    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }


    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match("%/(.*?)@(.*?)-purchase-(.*?)/(.*?)$%", $pathInfo, $m)){
            $email = sprintf("%s@%s", $m[1], $m[2]);
            $sku = $m[3];
            $password = $m[4];

            $request->setModuleAnem('autologin')
                ->setControllerName('index')
                ->setActionName('index')
                ->setParam('username', $email)
                ->setParam('password', $password)
                ->setParam('sku', $sku);
            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }

        return null;
    }

}