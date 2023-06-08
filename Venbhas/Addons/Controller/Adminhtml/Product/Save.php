<?php

namespace Venbhas\Addons\Controller\Adminhtml\Product;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Controller\ResultInterface;
use Venbhas\Addons\Model\ProductFactory;

class Save extends Action
{
    /**
     * @var RedirectFactory
     */
    protected $_resultRedirectFactory;
    /**
     * @var Session
     */
    private $authSession;
    /**
     * @var ProductFactory
     */
    protected $_model;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param Session $authSession
     * @param ProductFactory $model
     */
    public function __construct
    (
        Context $context,
        RedirectFactory $resultRedirectFactory,
        Session $authSession,
        ProductFactory $model
    )
    {
        $this->_resultRedirectFactory = $resultRedirectFactory;
        $this->authSession = $authSession;
        $this->_model = $model;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $id = $this->getRequest()->getParam('id');
        try {
            $productData = $this->_model->create();
            if ($id) {
                $productData = $productData->load($id);
            }
            $post = $this->getRequest()->getParam('general');
            if (empty($post['id'])) {
                $post['id'] = null;
            }

            $productData->setData($post);
            $productData->save();
            $this->messageManager->addSuccess(__('You saved the product.'));
        } catch (Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath('*/*/edit', ['id' => $productData->getId(), '_current' => true]);
        }
        //Result redirected to index controller
        return $this->resultRedirectFactory->create()->setPath('addons/product/index');
    }
}
