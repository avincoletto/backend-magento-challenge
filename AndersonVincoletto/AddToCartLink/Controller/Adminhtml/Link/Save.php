<?php
namespace AndersonVincoletto\AddToCartLink\Controller\Adminhtml\Link;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Session;
use AndersonVincoletto\AddToCartLink\Model\Link;

class Save extends Action
{
    protected $linkFactory;
    protected $adminSession;

    public function __construct(
        Context $context,
        Link $linkFactory,
        Session $adminSession
    ) {
        parent::__construct($context);
        $this->linkFactory = $linkFactory;
        $this->adminSession = $adminSession;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $link_id = $this->getRequest()->getParam('id');

            if ($link_id) {
                $this->linkFactory->load($link_id);
            }

            $this->linkFactory->setData($data);

            try {
                $this->linkFactory->save();
                $this->messageManager->addSuccess(__('Link saved successfully.'));
                $this->adminSession->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath(
                            '*/*/edit',
                            [
                                'id' => $this->linkFactory->getId(),
                                '_current' => true
                            ]
                        );
                    }
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the link.'));
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
