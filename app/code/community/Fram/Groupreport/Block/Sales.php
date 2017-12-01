<?php
class Fram_Groupreport_Block_Sales extends Mage_Core_Block_Template
{
    public function getLifetimeSales()
    {
        $store = Mage::app()->getRequest()->getParam('store');
        $customerGroups = Mage::helper('groupreport')->getLifesalesGroup();
        $lifetimeSales = [];
         foreach($customerGroups as $groupId)
        {
            $orderOfGroup = Mage::getModel('sales/order')->getCollection()
                ->addAttributeToFilter('status', array('in',[
                    Mage_Sales_Model_Order::STATE_PROCESSING,
                    Mage_Sales_Model_Order::STATE_COMPLETE,

                ]))
                ->addFieldToFilter('store_id',$store)
                ->addFieldToFilter('customer_group_id',$groupId)
                ->addAttributeToSelect('grand_total')
                ->getColumnValues('grand_total');

            $countOrder = count($orderOfGroup);
            $totalSum = array_sum($orderOfGroup);
            $lifetimeSales[$groupId] =  array(
                'lifetime_sales'=>$totalSum,
                'avg' => $totalSum / $countOrder
            );
        }
        return $lifetimeSales;
    }

    public function getAllCustomerFromGroupId($groupId)
    {
        $collection = Mage::getModel('customer/customer')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addFieldToFilter('store_id',  $store = Mage::app()->getRequest()->getParam('store'))
            ->addFieldToFilter('group_id', $groupId);
        return $collection;
    }


}