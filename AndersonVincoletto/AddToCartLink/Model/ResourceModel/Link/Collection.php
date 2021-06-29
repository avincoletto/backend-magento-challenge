<?php
namespace AndersonVincoletto\AddToCartLink\Model\ResourceModel\Link;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use AndersonVincoletto\AddToCartLink\Model\Link as LinkModel;
use AndersonVincoletto\AddToCartLink\Model\ResourceModel\Link as LinkResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            LinkModel::class,
            LinkResourceModel::class
        );
    }
}
