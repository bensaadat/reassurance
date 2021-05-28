<?php

namespace  Egio\EgioAdmin\Block\Adminhtml;

class Allreinsurances extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_allreinsurances';
        $this->_blockGroup = 'Egio_EgioAdmin';
        $this->_headerText = __('Manage Reinsurances');

        parent::_construct();

        if ($this->_isAllowedAction('Egio_EgioAdmin::save')) {
            $this->buttonList->update('add', 'label', __('Add Reinsurances'));
        } else {
            $this->buttonList->remove('add');
        }
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
