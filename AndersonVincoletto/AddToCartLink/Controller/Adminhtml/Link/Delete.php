<?php
namespace AndersonVincoletto\AddToCartLink\Controller\Adminhtml\Link;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use AndersonVincoletto\AddToCartLink\Model\Link;

class Delete extends Action
{
    protected $linkFactory;

    public function __construct(
        Context $context,
        Link $linkFactory
    ) {
        parent::__construct($context);
        $this->linkFactory = $linkFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AndersonVincoletto_AddToCartLink::link_delete');
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            try {
                $model = $this->linkFactory;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Link deleted successfully.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        $this->messageManager->addError(__('Link does not exist.'));

        return $resultRedirect->setPath('*/*/');
    }
}
