<?php
namespace Learning\Magestore\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class HandlerAfterAddToCart implements ObserverInterface {
    protected $redirect;
    protected $customerSession;
    protected $_logger;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Customer\Model\Session $customerSession

    ) {
//        var_dump('abc');
//        die();
        $this->redirect = $context->getRedirect();
        $this->customerSession = $customerSession;
        $this->_logger = $logger;

    }
    public function execute(Observer $observer)
    {
        // logout customer after place order success
        $customerId = $this->customerSession->getId();
        $this->_logger->info('info1234');
        if($customerId) {
            $this->customerSession->logout()
                ->setBeforeAuthUrl($this->redirect->getRefererUrl())
                ->setLastCustomerId($customerId);
            return "Customer logout successfully";
        } else {
            return "Customer is not login";
        }
    }
}
