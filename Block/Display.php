<?php
namespace Learning\Magestore\Block;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\Search\SearchCriteriaInterfaceFactory;

class Display extends \Magento\Framework\View\Element\Template
{
    protected $_customerFactory;

    protected $productRepository;

    protected $searchCriteria;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Learning\Magestore\Model\CustomerFactory $customerFactory,
        ProductRepository $productRepository,
        SearchCriteriaInterfaceFactory $searchCriteria
        )
    {
        $this->productRepository = $productRepository;
        $this->_customerFactory = $customerFactory;
        $this->searchCriteria = $searchCriteria;

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

    public function getListProduct(){
        $searchCriteria = $this->searchCriteria->create();
        $searchCriteria
            ->setPageSize(20)
            ->setCurrentPage(2);
        $rs =  $this->productRepository->getList($searchCriteria)->getItems();
        return $rs;
    }

}
