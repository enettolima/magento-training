<?php
/**
 * Created by PhpStorm.
 * User: enettolima
 * Date: 6/21/16
 * Time: 10:12 AM
 */

namespace Training\Custom404Page\Router;


use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Router\NoRouteHandlerInterface;

class Handler implements NoRouteHandlerInterface
{

    /**
     * Check and process no route request
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     */
    public function process(\Magento\Framework\App\RequestInterface $request)
    {
        if($this->isProductPageRequest($request)){
            $request->setModuleName('whoopsnoroute')
                ->setControllerName('product')
                ->setActionName('index');
            return true;
        }

        if($this->isCategoryPageRequest($request)){
            $request->setModuleName('whoopsnoroute')
                ->setControllerName('category')
                ->setActionName('index');
            return true;
        }

        return false;
    }

    private function isProductPageRequest(RequestInterface $request){
        if($request->getModuleName() == 'catalog'
            && $request->getControllerName() == 'product'){
            return true;
        }else{
            return false;
        }

    }

    private function isCategoryPageRequest(RequestInterface $request){
        if($request->getModuleName() == 'catalog'
            && $request->getControllerName() == 'category'){
            return true;
        }else{
            return false;
        }
    }
}