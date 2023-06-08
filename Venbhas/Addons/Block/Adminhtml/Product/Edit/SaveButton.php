<?php

namespace Venbhas\Addons\Block\Adminhtml\Product\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save Product'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'on_click' => '',
            'sort_order' => 40,
        ];
    }

    /**
     * @return string
     */
    public function getSaveUrl(): string
    {
        return $this->getUrl('*/*/save', ['id' => $this->getId()]);
    }

}
