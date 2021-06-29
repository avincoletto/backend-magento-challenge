<?php
namespace AndersonVincoletto\AddToCartLink\Block\Adminhtml\Link\Edit;

use Magento\Search\Controller\RegistryConstants;

abstract class AbstractButton
{
    protected $urlBuilder;
    protected $registry;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    public function getId()
    {
        $link = $this->registry->registry('link');

        return $link ? $link->getId() : null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
