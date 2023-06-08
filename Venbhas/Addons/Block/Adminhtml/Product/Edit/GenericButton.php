<?php

namespace Venbhas\Addons\Block\Adminhtml\Product\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

/**
 * Class GenericButton
 */
class GenericButton
{

    /**
     * @var Context
     */
    protected $_context;

    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(Context $context, Registry $registry)
    {
        $this->_context = $context;
        $this->_coreRegistry = $registry;
    }

    /**
     * Return Product ID
     *
     * @return int|null
     */
    public function getId()
    {
        $model = $this->_coreRegistry->registry('addon_product');
        //Loads the model and get collection and id
        if (isset($model) && $model->getId()) {
            // Return id to delete button
            return $model->getId();
        }
        return false;
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = []): string
    {
        return $this->_context->getUrlBuilder()->getUrl($route, $params);
    }

}
