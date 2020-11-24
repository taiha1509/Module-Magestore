<?php
namespace Learning\Magestore\Model;
use Learning\Magestore\Api\Data\CustomerInterface;
use Magento\Framework\Model\AbstractModel;

class Customer extends AbstractModel implements CustomerInterface
{
    const NAME = 'name';
    const ID = 'id';

    public function _construct(
    )
    {
        $this->_init('Learning\Magestore\Model\ResourceModel\Customer');
    }

    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }
}

