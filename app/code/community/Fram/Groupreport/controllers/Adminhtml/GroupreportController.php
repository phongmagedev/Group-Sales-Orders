<?php
class Fram_Groupreport_Adminhtml_GroupreportController extends Mage_Adminhtml_Controller_Action
{
    public function separatedAction()
    {
        $this->_title($this->__('Orders Of '.Mage::helper('groupreport')->getNameOfSeparatedGroup()));
        $this->loadLayout()
        ->_setActiveMenu('sales/order');
        $this->renderLayout();
        return $this;
    }
    public function anotherAction()
    {
        $this->_title($this->__('Orders Of '.Mage::helper('groupreport')->getNameOfAnotherGroup()));
        $this->loadLayout()
            ->_setActiveMenu('sales/order');
        $this->renderLayout();
        return $this;
    }

}