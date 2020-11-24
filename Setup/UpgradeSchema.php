<?php
namespace Learning\Magestore\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.0.1', '<')) {
            if (!$setup->tableExists('m2_Customer')) {
                $table = $setup->getConnection()->newTable(
                    $setup->getTable('m2_Customer')
                )
                    ->addColumn(
                        'id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'ID'
                    )
                    ->addColumn(
                        'name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        100,
                        [
                            'nullable'=>false
                        ],
                        'Name'
                    )
                    ->setComment('Customer table');
                $setup->getConnection()->createTable($table);
                $setup->getConnection()->addIndex(
                    $setup->getTable('m2_Customer'),
                    $setup->getIdxName(
                        $setup->getTable('m2_Customer'),
                        ['name'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }
            $setup->endSetup();
        }
    }
}
