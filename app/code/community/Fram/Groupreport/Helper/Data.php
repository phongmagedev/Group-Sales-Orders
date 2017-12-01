<?php
class Fram_Groupreport_Helper_Data extends Mage_Core_Helper_Abstract
{

    protected $storeCode;

    public function __construct()
    {
        $this->storeCode = Mage::app()->getRequest()->getParam('store');
    }

    CONST ENABLE_MODULE = 'fram_groupreport/config/enable';
    CONST CUSTOMER_GROUP = 'fram_groupreport/config/customer_group';
    CONST LIMIT_LAST_ORDERS = 'fram_groupreport/config/limit_last_orders';
    CONST REMOVE_DEFAULT_LAST_ORDERS = 'fram_groupreport/config/remove_default_last_orders';

    CONST ENABLE_LIFESALES = 'fram_groupreport/lifesales/enable';
    CONST LIFESALES_GROUP = 'fram_groupreport/lifesales/customer_group';
    CONST REMOVE_DEFAULT_LIFESALES = 'fram_groupreport/config/remove_default_lifesales';

    CONST ENABLE_SEPARATE_ORDER = 'fram_groupreport/separated_orders/enable';
    CONST GROUP_SEPARATED = 'fram_groupreport/separated_orders/customer_group';
    CONST NAME_GROUP_SEPARATED = 'fram_groupreport/separated_orders/name_separated_group';
    CONST NAME_ANOTHER_SEPARATED = 'fram_groupreport/separated_orders/name_another_group';

    public function isEnable()
    {
        return Mage::getStoreConfig(self::ENABLE_MODULE,$this->storeCode);
    }

    public function checkSaparatedGroup()
    {
        return explode(',',Mage::getStoreConfig(self::CUSTOMER_GROUP, $this->storeCode));
    }

    public function getCustomerGroupNameById($customerGroupId)
    {
        $groupname = Mage::getModel('customer/group')->load($customerGroupId)->getCustomerGroupCode();
        return $groupname;
    }

    public function getLimitLastOrder()
    {
        return Mage::getStoreConfig(self::LIMIT_LAST_ORDERS,$this->storeCode);
    }

    public function isRemoveDefaultLastOrders()
    {
        return Mage::getStoreConfig(self::REMOVE_DEFAULT_LAST_ORDERS,$this->storeCode);
    }

    public function isLifesalesEnable()
    {
        return Mage::getStoreConfig(self::ENABLE_LIFESALES,$this->storeCode);
    }

    public function getLifesalesGroup()
    {
        return explode(',',Mage::getStoreConfig(self::LIFESALES_GROUP, $this->storeCode));
    }

    public function isRemovedDefaultLifesales()
    {
        return Mage::getStoreConfig(self::REMOVE_DEFAULT_LIFESALES,$this->storeCode);
    }

    public function isEnableSeparatedOrder()
    {
        return Mage::getStoreConfig(self::ENABLE_SEPARATE_ORDER,$this->storeCode);
    }
    public function groupSeparatedOrder()
    {
        return Mage::getStoreConfig(self::GROUP_SEPARATED,$this->storeCode);
    }

    public function getNameOfSeparatedGroup()
    {
        return Mage::getStoreConfig(self::NAME_GROUP_SEPARATED,$this->storeCode);
    }
    public function getNameOfAnotherGroup()
    {
        return Mage::getStoreConfig(self::NAME_ANOTHER_SEPARATED,$this->storeCode);
    }
}