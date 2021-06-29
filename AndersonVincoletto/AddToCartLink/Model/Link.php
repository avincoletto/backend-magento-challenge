<?php
namespace AndersonVincoletto\AddToCartLink\Model;

use AndersonVincoletto\AddToCartLink\Model\ResourceModel\Link as LinkResourceModel;

class Link extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(LinkResourceModel::class);
    }
}
