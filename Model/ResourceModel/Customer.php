<?php
namespace Learning\Magestore\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Customer Extends AbstractDb{
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('m2_Customer', 'id');
    }
}
