<?php
class Fram_Groupreport_Model_System_Config_Source_Customer_Group extends Mage_Adminhtml_Model_System_Config_Source_Customer_Group
{
    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('customer/group_collection')
                ->loadData()->toOptionArray();
            array_unshift($this->_options, array('value'=> '', 'label'=> Mage::helper('adminhtml')->__('-- Please Select --')));
        }
        return $this->_options;
    }
}