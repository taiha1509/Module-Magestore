<?php

namespace Learning\Magestore\Api;
use Magento\Catalog\Api\Data\ProductInterface;

interface ProductRepositoryInterface
{
    /**
     * @return ProductInterface[]
     */
    public function getList20stProduct();
}
