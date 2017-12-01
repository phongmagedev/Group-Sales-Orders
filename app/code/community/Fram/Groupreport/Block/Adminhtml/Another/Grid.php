<?php
class Fram_Groupreport_Block_Adminhtml_Another_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
    protected  $store;
    public function __construct()
    {
        parent::__construct();
        $this->setId('order_id');
        $this->setDefaultSort('increment_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
        $this->store = Mage::app()->getRequest()->getParam('store');
        $this->setPagerVisibility(false);

    }
    public function getMainButtonsHtml()
    {
        return null;
    }
    public function _prepareMassaction()
    {
        return null;
    }
    protected function _getCollectionClass()
    {
        return 'sales/order_grid_collection';
    }
    protected function _prepareCollection()
    {

        $groupId = Mage::helper('groupreport')->groupSeparatedOrder();
        if($this->store)
        {
            $collection = Mage::getModel('sales/order')
                ->getCollection()
                ->addFieldToFilter('store_id',$this->store)
                ->addAttributeToFilter('customer_group_id',array('neq'=>$groupId))
                ->setPageSize(35)
                ->setOrder('increment_id', 'DESC');
        }else
        {
            $collection = Mage::getModel('sales/order')
                ->getCollection()
                ->addAttributeToFilter('customer_group_id',array('neq'=>$groupId))
                ->setPageSize(35)
                ->setOrder('increment_id', 'DESC');
        }

        $this->setCollection($collection);


    }
    protected function _prepareColumns()
    {
        $this->addColumn('real_order_id', array(
            'header'=> Mage::helper('sales')->__('Order #'),
            'width' => '80px',
            'type'  => 'text',
            'index' => 'increment_id',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'    => Mage::helper('sales')->__('Purchased From (Store)'),
                'index'     => 'store_id',
                'type'      => 'store',
                'store_view'=> true,
                'display_deleted' => true,
            ));
        }

        $this->addColumn('created_at', array(
            'header' => Mage::helper('sales')->__('Purchased On'),
            'index' => 'created_at',
            'type' => 'datetime',
            'width' => '100px',
        ));
        $this->addColumn('customer_firstname', array(
            'header' => Mage::helper('sales')->__('Name Of ').Mage::helper('groupreport')->getNameOfAnotherGroup(),
        'index' => 'customer_firstname',
        'type' => 'text',
         ));

        $this->addColumn('customer_email', array(
            'header' => Mage::helper('sales')->__('Customer Email'),
            'index' => 'customer_email',
            'type' => 'text',
            'width' => '100px',
        ));
        $this->addColumn('base_grand_total', array(
            'header' => Mage::helper('sales')->__('G.T. (Base)'),
            'index' => 'base_grand_total',
            'type'  => 'currency',
            'currency' => 'base_currency_code',
        ));

        $this->addColumn('grand_total', array(
            'header' => Mage::helper('sales')->__('G.T. (Purchased)'),
            'index' => 'grand_total',
            'type'  => 'currency',
            'currency' => 'order_currency_code',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('sales')->__('Status'),
            'index' => 'status',
            'type'  => 'options',
            'width' => '70px',
            'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
        ));

        if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/view')) {
            $this->addColumn('action',
                array(
                    'header'    => Mage::helper('sales')->__('Action'),
                    'width'     => '50px',
                    'type'      => 'action',
                    'getter'     => 'getId',
                    'actions'   => array(
                        array(
                            'caption' => Mage::helper('sales')->__('View'),
                            'url'     => array('base'=>'*/sales_order/view'),
                            'field'   => 'order_id'
                        )
                    ),
                    'filter'    => false,
                    'sortable'  => false,
                    'index'     => 'stores',
                    'is_system' => true,
                ));
        }
    }
}