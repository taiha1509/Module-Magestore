<?php
namespace Learning\Magestore\Model;

use Learning\Magestore\Api\CustomerRepositoryInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Setup\Exception;

class CustomerRepository implements CustomerRepositoryInterface
{

    protected $customer;
    protected $customerResource;

    public function __construct(
        \Learning\Magestore\Model\CustomerFactory $customerFactory,
        \Learning\Magestore\Model\ResourceModel\Customer $customerResource
    )
    {
        $this->customer = $customerFactory;
        $this->customerResource = $customerResource;
    }

    /**
     * {@inheritdoc}
     *
     */
    public function getById($id)
    {
        $cs = $this->customer->create();
        $cs->load($id);
        if (!$cs->getId()) {
            throw new NoSuchEntityException(
                __("The product that was requested doesn't exist. Verify the product and try again.")
            );
        }
        return $cs;
    }

    /**
     * @param int $id
     * @return bool|void
     */
    public function deleteCustomer($id)
    {

        $cs = $this->customer->create();
        $cs->load($id);
        if (!$cs->getData()) {
            throw new Exception(
                "not found customer with this id"
            );
        }

        try {
            $csResource = $this->customerResource;
            $csResource->delete($cs);
            return true;
        } catch (Exception $e) {
            throw new Exception(
                "cannot delete this customer"
            );
        }
        return false;
    }

    /**
     *
     * @param \Learning\Magestore\Api\Data\CustomerInterface $customer
     * @return \Learning\Magestore\Api\Data\CustomerInterface|void
     */
    public function editCustomer($customer)
    {

        $cs = $this->customer->create();
        $cs->load($customer->getId());
        if (!$cs->getData()) {
            throwException(
                "not found customer with this id"
            );
        }

        try {
            $this->deleteCustomer($customer->getId());
            $this->addCustomer($customer);
            var_dump($customer->getData());
            die();
        } catch (Exception $e) {
            throwException(
                "connot edit"
            );
        }
    }

    /**
     * @param \Learning\Magestore\Api\Data\CustomerInterface $customer
     * @return \Learning\Magestore\Api\Data\CustomerInterface
     */
    public function addCustomer($customer)
    {
//        if (!$customer->getId()) {
//            throwException(
//                "customer is empty"
//            );
//        }
        $csResource = $this->customerResource;
        try {
            $csResource->save($customer);
        } catch (AlreadyExistsException $e) {
            var_dump($e->getMessage());
            die();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die();
        }
        return $customer;
    }

    /**
     * @param array $customers
     * @return array|void
     * @throws Exception
     */
    public function addManyCustomer($customers)
    {
        $cs = $this->customer->create();

        foreach ($customers as $cus) {
            if ($this->isIdExist($cus->geId())) {
                throw new Exception(
                    "array customers is not valid"
                );
            }
        }

        foreach ($customers as $cus) {
            $this->addCustomer($cus);
        }

        return $customers;
    }

    /**
     * @param int id
     * @return bool
     */
    public function isIdExist($id)
    {
        $cs = $this->customer->create();
        if ($cs->load($id)->getId() == $id) {
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->customer->create()->getCollection()->getData();
    }
}
