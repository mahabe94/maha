<?php

namespace Venbhas\Addons\Model;

use Magento\Framework\Model\AbstractModel;

class Product extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Venbhas\Addons\Model\ResourceModel\Product');
    }
}
