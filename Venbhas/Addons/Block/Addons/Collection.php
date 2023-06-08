<?php

namespace Venbhas\Addons\Block\Addons;

use Magento\Framework\View\Element\Template\Context;
use Venbhas\Addons\Model\Product;
use Magento\Framework\View\Element\Template;

class Collection extends Template
{
    /**
     * @var Product
     */
    protected $_modelConnection;

    const STATUS = 1;

    /**
     * @param Context $context
     * @param Product $modelConnection
     * @param array $data
     */
    public function __construct(Context $context, Product $modelConnection, array $data = [])
    {
        $this->_modelConnection = $modelConnection;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getCategoryProductCollection()
    {
        return $this->_modelConnection->getCollection()->addFieldToFilter('status', self::STATUS);
    }
}
