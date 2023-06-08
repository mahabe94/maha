<?php

namespace Venbhas\Addons\Controller\Adminhtml\Product;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{
    protected $_resultPage;
    /**
     * @var bool|PageFactory
     */
    protected $_resultPageFactory = false;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        //Call page factory to render layout and page content
        $resultPage = $this->_resultPageFactory->create();
        /**
         * Set active menu item
         */
        $resultPage->setActiveMenu('Venbhas_Addons::products');
        $resultPage->getConfig()->getTitle()->prepend((__('Addons')));
        //Add bread crumb
        $resultPage->addBreadcrumb(__('Venbhas'), __('Venbhas'));
        $resultPage->addBreadcrumb(__('Addons'), __('Addons'));
        return $resultPage;
    }

    /*
     * Check permission via ACL resource
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Venbhas_Addons::products');
    }

}
