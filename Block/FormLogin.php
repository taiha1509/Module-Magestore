<?php
namespace Learning\Magestore\Block;
class FormLogin extends \Magento\Framework\View\Element\Template
{
    protected $_customerFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Learning\Magestore\Model\CustomerFactory $customerFactory
    )
    {
        $this->_customerFactory = $customerFactory;
        parent::__construct($context);
    }

    public function getCustomerCollection(){
        $customer = $this->_customerFactory->create();
        return $customer->getCollection();
    }

    public function sayHello()
    {
        return __('Hello World');
    }
}
