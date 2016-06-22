<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Reports\Model\Product\Index;

/**
 * Catalog Viewed Detail Index
 *
 * @method \Magento\Reports\Model\ResourceModel\Product\Index\Viewed _getResource()
 * @method \Magento\Reports\Model\ResourceModel\Product\Index\Viewed getResource()
 * @method \Magento\Reports\Model\Detail\Index\Viewed setVisitorId(int $value)
 * @method \Magento\Reports\Model\Detail\Index\Viewed setCustomerId(int $value)
 * @method int getProductId()
 * @method \Magento\Reports\Model\Detail\Index\Viewed setProductId(int $value)
 * @method \Magento\Reports\Model\Detail\Index\Viewed setStoreId(int $value)
 * @method string getAddedAt()
 * @method \Magento\Reports\Model\Detail\Index\Viewed setAddedAt(string $value)
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Viewed extends \Magento\Reports\Model\Product\Index\AbstractIndex
{
    /**
     * Cache key name for Count of product index
     *
     * @var string
     */
    protected $_countCacheKey = 'product_index_viewed_count';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magento\Reports\Model\ResourceModel\Product\Index\Viewed');
    }

    /**
     * Retrieve Exclude Detail Ids List for Collection
     *
     * @return array
     */
    public function getExcludeProductIds()
    {
        $productIds = [];

        if ($this->_registry->registry('current_product')) {
            $productIds[] = $this->_registry->registry('current_product')->getId();
        }

        return $productIds;
    }
}
