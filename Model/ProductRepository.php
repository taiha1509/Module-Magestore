<?php


namespace Learning\Magestore\Model;

use Magento\Catalog\Api\Data\ProductInterface;

use Learning\Magestore\Api\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $productRepository;
    protected $searchCriteria;
    protected $filterGroup;
    protected $filterBuilder;
    protected $productStatus;
    protected $productVisibility;

    /**
     * @param \Magento\Catalog\Model\ProductRepository $productRepository
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @param \Magento\Framework\Api\Search\FilterGroup $filterGroup
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder
     * @param \Magento\Catalog\Model\Product\Attribute\Source\Status $productStatus
     * @param \Magento\Catalog\Model\Product\Visibility $productVisibility
     */
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaInterface $criteria,
        \Magento\Framework\Api\Search\FilterGroup $filterGroup,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Catalog\Model\Product\Attribute\Source\Status $productStatus,
        \Magento\Catalog\Model\Product\Visibility $productVisibility
    ) {
        $this->productRepository = $productRepository;
        $this->searchCriteria = $criteria;
        $this->filterGroup = $filterGroup;
        $this->filterBuilder = $filterBuilder;
        $this->productStatus = $productStatus;
        $this->productVisibility = $productVisibility;

        $this->getProductData();
    }

    public function getProductData(){
        $this->filterGroup->setFilters([
            $this->filterBuilder
                ->setField('status')
                ->setConditionType('in')
                ->setValue($this->productStatus->getVisibleStatusIds())
                ->create(),
            $this->filterBuilder
                ->setField('visibility')
                ->setConditionType('in')
                ->setValue($this->productVisibility->getVisibleInSiteIds())
                ->create(),
        ]);

        $this->searchCriteria->setFilterGroups([$this->filterGroup]);
        $products = $this->productRepository->getList($this->searchCriteria);
        $productItems = $products->getItems();

        return $productItems;
    }

    /**
     * @return ProductInterface[]
     */
    public function getList20stProduct()
    {
//        var_dump(1);
//        die();
        $this->filterGroup->setFilters([
            $this->filterBuilder
                ->setField('status')
                ->setConditionType('in')
                ->setValue($this->productStatus->getVisibleStatusIds())
                ->create(),
            $this->filterBuilder
                ->setField('visibility')
                ->setConditionType('in')
                ->setValue($this->productVisibility->getVisibleInSiteIds())
                ->create(),
        ]);
        $this->searchCriteria->setFilterGroups([$this->filterGroup]);
        $this->searchCriteria->setPageSize(20);
        $this->searchCriteria->setCurrentPage(1);
        $products = $this->productRepository->getList($this->searchCriteria);
        $productItems = $products->getItems();
        return $productItems;
    }
}
