<?php
namespace AndersonVincoletto\AddToCartLink\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Link extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('deviget_links', 'entity_id');
    }
}
