<?php
namespace Learning\Magestore\Controller\Page;

use Learning\Magestore\Model\ProductRepository;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;

class Index extends Action
{
    protected $_pageFactory;
    protected $_customerFactory;
    protected $logger;
    protected $productRepository;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        \Learning\Magestore\Model\CustomerFactory $customerFactory,
        LoggerInterface $logger,
        ProductRepository $productRepository
    ) {

        $this->logger = $logger;
        $this->_pageFactory = $pageFactory;
        $this->_customerFactory = $customerFactory;
        $this->productRepository = $productRepository;
        return parent::__construct($context);
    }

    public function execute()
    {
//
//        $post = $this->_customerFactory->create();
//        $collection = $post->getCollection();
//        $products = $this->productRepository->getProductData();
//        var_dump($products);
//        die();
//        foreach ($products as $item) {
//            echo '<pre>';
//            print_r($item->getId());
//            echo'</pre>';
//        }
        $resultPage =  $this->_pageFactory->create();

        return $resultPage;
    }
}
