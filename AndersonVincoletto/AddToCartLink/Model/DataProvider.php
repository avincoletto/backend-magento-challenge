<?php
namespace AndersonVincoletto\AddToCartLink\Model;

use AndersonVincoletto\AddToCartLink\Model\ResourceModel\Link\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $linkCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $linkCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $link) {
            $this->loadedData[$link->getId()] = $link->getData();
        }

        return $this->loadedData;
    }
}
