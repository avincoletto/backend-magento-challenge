<?php
namespace AndersonVincoletto\AddToCartLink\Controller\Product;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Model\Product;
use Magento\Checkout\Model\Cart;
use AndersonVincoletto\AddToCartLink\Model\LinkFactory;

class Index extends Action
{

    protected $pageFactory;
    protected $linkFactory;
    protected $cart;
    protected $product;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Product $product,
        Cart $cart,
        LinkFactory $linkFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->linkFactory = $linkFactory;
        $this->cart = $cart;
        $this->product = $product;

        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $params = [];
            $params['qty'] = '1';
            $linkId = $this->getRequest()->getParam('link_id');

            $link = $this->linkFactory->create()->load($linkId);

            if ($link->getId()) {
                $products = explode(',', $link->getProducts());

                foreach($products as $pId) {
                    $_product = $this->product->load($pId);

                    if ($_product) {
                        $this->cart->addProduct($_product, $params);
                        $this->cart->save();
                    }
                }

                $this->messageManager->addSuccess(__('Added to cart successfully.'));
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addException(
                $e,
                __('%1', $e->getMessage())
            );
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('error.'));
        }

        $this->getResponse()->setRedirect('/checkout/cart/index');
    }
}
