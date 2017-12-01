<?php
class Fram_Groupreport_Block_Adminhtml_Separated extends  Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'groupreport';
        $this->_controller = 'adminhtml_separated';
        $this->_headerText = $this->__('Orders Of '.Mage::helper('groupreport')->getNameOfSeparatedGroup());
        $this->removeButton('add');
    }
    
}