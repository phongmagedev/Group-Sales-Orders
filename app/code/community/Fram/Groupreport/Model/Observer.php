<?php
class Fram_Groupreport_Model_Observer
{

    public function addBlock($observer)
    {
        /** @var $_block Mage_Core_Block_Abstract */
        if(!Mage::helper('groupreport')->isEnable())
        {
            return;
        }
        $_block = $observer->getBlock();

        $_type = $_block->getType();

        if ($_type == 'adminhtml/dashboard_orders_grid' && Mage::helper('groupreport')->isEnable()) {

            $_child = clone $_block;

            $_child->setType('groupreport/lastorders');

            $_block->setChild('groupreport', $_child);
            $_block->getLayout()->createBlock('groupreport/lastorders');

            $_block->setTemplate('groupreport/lastorders.phtml');
        }
        if ($_type == 'adminhtml/dashboard_sales' && Mage::helper('groupreport')->isLifesalesEnable()) {

            $_child = clone $_block;

            $_child->setType('groupreport/sales');

            $_block->setChild('sales', $_child);
            $_block->getLayout()->createBlock('groupreport/sales');

            $_block->setTemplate('groupreport/sales.phtml');
        }
    }
    public function updateAdminMenu()
    {
        if(!Mage::helper('groupreport')->isEnableSeparatedOrder())
        {
            return;
        }
        $menu = Mage::getSingleton('admin/config')->getAdminhtmlConfig()
            ->getNode('menu/sales/children/order');

        $separatedGroup = Mage::helper('groupreport')->getNameOfSeparatedGroup();

        $anotherGroup = Mage::helper('groupreport')->getNameOfAnotherGroup();


        $xml = "<children>
                <separated_group>
                    <title>$separatedGroup</title>
                    <sort_order>10</sort_order>
                    <action>adminhtml/groupreport/separated</action>
                </separated_group>
                <another_group>
                    <title>$anotherGroup</title>
                    <sort_order>20</sort_order>
                    <action>adminhtml/groupreport/another</action>
                </another_group>
                </children>";
        $node = new Mage_Core_Model_Config_Element($xml);
        $menu->appendChild($node);
    }
}