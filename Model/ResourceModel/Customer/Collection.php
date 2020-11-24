<?php
namespace Learning\Magestore\Model\ResourceModel\Customer;

use Learning\Magestore\Model\Customer;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Customer::class, \Learning\Magestore\Model\ResourceModel\Customer::class);
    }
}
