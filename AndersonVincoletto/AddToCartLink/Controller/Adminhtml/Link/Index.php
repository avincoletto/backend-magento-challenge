<?php

namespace AndersonVincoletto\AddToCartLink\Controller\Adminhtml\Link;

class Index extends \Magento\Backend\App\Action
{
	protected $pageFactory;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory
	) {
		parent::__construct($context);
		$this->pageFactory = $pageFactory;
	}

	public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('AndersonVincoletto_AddToCartLink::link');
        $resultPage->getConfig()->getTitle()->prepend(__('Add To Cart Links'));

        return $resultPage;
    }
}
