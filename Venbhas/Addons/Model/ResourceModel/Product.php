<?php

namespace Venbhas\Addons\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Product extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('addon_products', 'id');
    }
}
