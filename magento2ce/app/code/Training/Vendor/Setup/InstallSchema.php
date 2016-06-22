<?php

namespace Training\Vendor\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'training_vendor'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('training_vendor'))
            ->addColumn(
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Vendor Id'
            )
            ->addColumn(
                'vendor_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                32,
                ['nullable' => false, 'default' => 'simple'],
                'Vendor Name'
            )
            ->setComment('Training Vendor Table');
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'training_vendor4product'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('training_vendor2product'))
            ->addColumn(
                'vendor2product_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Vendor2Product Id'
            )
            ->addColumn(
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true],
                'Vendor ID'

            )
            ->addColumn(
                'product_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true],
                'Detail ID'

            )
            ->addIndex(
                $installer->getIdxName('training_vendor2product', ['vendor_id']),
                ['vendor_id']
            )
            ->addIndex(
                $installer->getIdxName('training_vendor2product', ['product_id']),
                ['product_id']
            )
            ->addForeignKey(
                $installer->getFkName(
                    'training_vendor2product',
                    'vendor_id',
                    'training_vendor',
                    'vendor_id'
                ),
                'vendor_id',
                $installer->getTable('training_vendor'),
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $installer->getFkName(
                    'training_vendor2product',
                    'product_id',
                    'catalog_product_entity',
                    'entity_id'
                ),
                'product_id',
                $installer->getTable('catalog_product_entity'),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Training Vendor2Product Table');
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}