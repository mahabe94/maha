<?php

namespace Venbhas\Addons\Model\ResourceModel\Product;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * @var string
     */
    protected $_eventPrefix = 'addons_product_grid_collection';
    /**
     * @var string
     */
    protected $_eventObject = 'product_grid_collection';

    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init('Venbhas\Addons\Model\Product',
            'Venbhas\Addons\Model\ResourceModel\Product');
    }

}
