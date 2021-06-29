<?php
namespace AndersonVincoletto\AddToCartLink\Block\Adminhtml\Link\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends AbstractButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save Link'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
