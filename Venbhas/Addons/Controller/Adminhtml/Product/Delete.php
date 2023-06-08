<?php

namespace Venbhas\Addons\Controller\Adminhtml\Product;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Venbhas\Addons\Model\ProductFactory;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Delete extends Action
{
    /**
     * @var ProductFactory
     */
    protected $_model;

    /**
     * @var RedirectFactory
     */
    protected $_resultRedirectFactory;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param ProductFactory $productFactory
     */
    public function __construct
    (
        Context              $context,
        RedirectFactory      $resultRedirectFactory,
        ProductFactory       $productFactory
    )
    {
        $this->_model = $productFactory;
        $this->_resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    /**
     * @return Redirect|
     * \Magento\Framework\App\ResponseInterface|
     * \Magento\Framework\Controller\ResultInterface|void
     */
    public function execute(): Redirect
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->_resultRedirectFactory->create();
        $model = $this->_model->create()->load($id);
        /** @var Redirect $resultRedirect */
        if (!($model)) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        if ($id) {
            try {
                $model = $this->_model->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Your Product has been deleted !'));
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/index', array('_current' => true));
            }
        }
        $this->messageManager->addError(__('We can\'t find a Product to delete.'));
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}
