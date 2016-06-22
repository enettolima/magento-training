<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Bundle\Model\Product;

/**
 * Test class for \Magento\Bundle\Model\Detail\Type (bundle product type)
 */
class TypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Full reindex
     *
     * @var \Magento\Framework\Indexer\IndexerInterface
     */
    protected $indexer;

    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $resource;

    /**
     * Connection adapter
     *
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected $connectionMock;

    protected function setUp()
    {
        $this->objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();

        /** @var \Magento\Framework\Indexer\IndexerRegistry $indexerRegistry */
        $indexerRegistry = $this->objectManager->create('\Magento\Framework\Indexer\IndexerRegistry');
        $this->indexer =  $indexerRegistry->get('catalogsearch_fulltext');

        $this->resource = $this->objectManager->get('Magento\Framework\App\ResourceConnection');
        $this->connectionMock = $this->resource->getConnection();
    }

    /**
     * @magentoDataFixture Magento/Bundle/_files/product.php
     * @covers \Magento\Indexer\Model\Indexer::reindexAll
     * @covers \Magento\Bundle\Model\Product\Type::getSearchableData
     */
    public function testPrepareProductIndexForBundleProduct()
    {
        $this->indexer->reindexAll();

        $select = $this->connectionMock->select()->from($this->resource->getTableName('catalogsearch_fulltext_scope1'))
            ->where('`data_index` LIKE ?', '%' . 'Bundle Detail Items' . '%');

        $result = $this->connectionMock->fetchAll($select);
        $this->assertCount(1, $result);
    }

    /**
     * @magentoDataFixture Magento/Bundle/_files/product_with_multiple_options.php
     * @covers \Magento\Bundle\Model\Product\Type::getOptionsCollection
     */
    public function testGetOptionsCollection()
    {
        $productRepository = $this->objectManager->create('Magento\Catalog\Api\ProductRepositoryInterface');
        /** @var \Magento\Catalog\Model\Product $bundleProduct */
        $bundleProduct = $productRepository->get('bundle-product');
        $bundleType = $bundleProduct->getTypeInstance();
        /** @var \Magento\Bundle\Model\Product\Type $bundleType */
        $options = $bundleType->getOptionsCollection($bundleProduct);
        $this->assertCount(5, $options->getItems());
    }
}
