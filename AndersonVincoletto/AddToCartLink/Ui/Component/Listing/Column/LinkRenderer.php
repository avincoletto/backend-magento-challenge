<?php
namespace AndersonVincoletto\AddToCartLink\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Store\Model\StoreManagerInterface;

class LinkRenderer extends Column
{
    const URL_PATH = 'addtocart/product/';
    protected $storeManager;

    public function __construct(
        StoreManagerInterface $storeManager,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        $pattern = '<a href="%s" target="_blank">%s</a>';

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['entity_id'])) {
                    $link = $this->storeManager
                            ->getStore()
                            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB) .
                            static::URL_PATH . $item['slug'];
                    $item[$this->getData('name')] = sprintf($pattern, $link, $link);
                }
            }
        }

        return $dataSource;
    }
}
