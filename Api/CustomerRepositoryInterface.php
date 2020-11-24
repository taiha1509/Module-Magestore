<?php

namespace Learning\Magestore\Api;


Interface CustomerRepositoryInterface{
    /**
     * get customer by id
     * @param int $id
     * @return \Learning\Magestore\Api\Data\CustomerInterface
     */
    public function getById($id);

    /**
     * delete a customer
     * @param int $id
     * @return bool
     */
    public function deleteCustomer($id);

    /**
     * change info a customer
     * @param \Learning\Magestore\Api\Data\CustomerInterface $customer
     * @return \Learning\Magestore\Api\Data\CustomerInterface
     */
    public function editCustomer($customer);

    /**
     * add new customer to database
     * @param \Learning\Magestore\Api\Data\CustomerInterface $customer
     * @return \Learning\Magestore\Api\Data\CustomerInterface
     */
    public function addCustomer($customer);

    /**
     * add many customer
     * @param array $customers
     * @return array
     */
    public function addManyCustomer($customers);

    /**
     * @return array
     */
    public function getAll();
}
