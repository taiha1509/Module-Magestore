<?php
namespace Learning\Magestore\Setup;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Learning\Magestore\Model\CustomerFactory;

class UpgradeData implements UpgradeDataInterface {

    protected $customerFactory;

    public function __construct(CustomerFactory $_customerFactory)
    {
        $this->customerFactory = $_customerFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if(version_compare($context->getVersion(), '0.0.2', '>')){
            if($setup->tableExists('m2_Customer')){
                $data = [
                    [
                        'id' => 1,
                        'name' => 'taiha'
                    ],
                    [
                        'id' => 2,
                        'name' => 'rogers'
                    ],
                    [
                        'id' => 3,
                        'name' => 'bruce'
                    ]
                ];

                $conn = $setup -> getConnection();
                $table = $conn -> getTables('m2_Customer');

                # insert using DB adarpter class
                # $conn->insert($table, $data); // if data is not an array
                $conn->insertMultiple($table, $data);

                #insert data using module model's class
//                $customer = $this->customerFactory->create();
//                $customer->addData($data)->save();
            }
        }
        $setup->endSetup();
    }
}
