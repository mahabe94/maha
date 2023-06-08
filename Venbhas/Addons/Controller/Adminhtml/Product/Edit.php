<?php

namespace Venbhas\Addons\Controller\Adminhtml\Product;

use Magento\Framework\View\Result\Page;
use Venbhas\Addons\Model\ProductFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Magento\Backend\App\Action;

class Edit extends Action
{
    protected $_resultPage;
    /**
     * @var bool|PageFactory
     */
    protected $_resultPageFactory = false;
    /**
     * @var Registry
     */
    protected $_coreRegistry;
    /**
     * @var ProductFactory
     */
    protected $_model;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $coreRegistry
     * @param ProductFactory $model
     */
    public function __construct
    (
        Context        $context,
        PageFactory    $resultPageFactory,
        Registry       $coreRegistry,
        ProductFactory $model
    )
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_model = $model;
    }

    /**
     * @return Page
     * \Magento\Framework\Controller\ResultInterface|
     * \Magento\Framework\View\Result\Page
     */
    public function execute(): Page
    {
        $id = $this->getRequest()->getParam('id');
        $post = $this->_model->create();
        if ($id) {
            $post = $post->load($id);
            if ($post->getId()) {
                $this->_coreRegistry->register('addon_product', $post);
            }
        }
        $resultPage = $this->getResultPage();
        $resultPage->getConfig()->getTitle()->prepend($post->getId() ?
            $post->getProductName() : __('New Product'));
        return $resultPage;
    }

    /**
     * @return Page
     */
    public function getResultPage(): Page
    {
        $this->_resultPage = $this->_resultPageFactory->create();
        return $this->_resultPage;
    }

}
