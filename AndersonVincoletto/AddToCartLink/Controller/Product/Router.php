<?php
namespace AndersonVincoletto\AddToCartLink\Controller\Product;

use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Action\Forward;
use AndersonVincoletto\AddToCartLink\Model\LinkFactory;

class Router implements RouterInterface
{
    protected $actionFactory;
    protected $linkFactory;
    protected $_response;

    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response,
        LinkFactory $linkFactory
    ) {
        $this->actionFactory = $actionFactory;
        $this->linkFactory = $linkFactory;
        $this->_response = $response;
    }

    public function match(RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');

        if ($request->getModuleName() == 'deviget') {
            return null;
        }

        if(strpos($identifier, 'addtocart') !== false) {
            $urlParts = explode('/', $identifier);

            if (count($urlParts) == 3) {
                $link = $this->linkFactory->create()->load($urlParts[2], 'slug');

                if ($link->getId()) {
                    $request
                        ->setModuleName('deviget')
                        ->setControllerName('product')
                        ->setActionName('index')
                        ->setParam('link_id', $link->getId());

                    return $this->actionFactory->create(
                            Forward::class,
                            ['request' => $request]
                        );
                }
            }
        }

        return null;
    }
}
