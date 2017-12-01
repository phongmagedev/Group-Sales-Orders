<?php
class Fram_Groupreport_Block_Lastorders extends Mage_Core_Block_Template
{
    public function getLastGroupOrderCollection()
    {
        $collection = Mage::getResourceModel('reports/order_collection')
            ->addItemCountExpr()
            ->addFieldToFilter('store_id',Mage::app()->getRequest()->getParam('store'))
            ->joinCustomerName('customer')
            ->orderByCreatedAt();
        return $collection;
    }
}