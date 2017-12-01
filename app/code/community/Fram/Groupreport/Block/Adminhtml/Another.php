<?php
class Fram_Groupreport_Block_Adminhtml_Another extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'groupreport';
        $this->_controller = 'adminhtml_another';
        $this->_headerText = $this->__('Orders Of '.Mage::helper('groupreport')->getNameOfAnotherGroup());
        $this->removeButton('add');
    }
}