<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\ProductVideo\Test\Constraint;

use Magento\Cms\Test\Page\CmsIndex;
use Magento\Mtf\Fixture\InjectableFixture;
use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\Catalog\Test\Page\Category\CatalogCategoryView;

/**
 * Assert that video is absent on category page.
 */
class AssertNoVideoCategoryView extends AbstractConstraint
{

    /**
     * Assert that video is absent on category page on Store front.
     *
     * @param CmsIndex $cmsIndex
     * @param CatalogCategoryView $catalogCategoryView
     * @param InjectableFixture $product
     */
    public function processAssert(
        CmsIndex $cmsIndex,
        CatalogCategoryView $catalogCategoryView,
        InjectableFixture $product
    ) {
        $cmsIndex->open();
        $cmsIndex->getTopmenu()->selectCategoryByName($product->getCategoryIds()[0]);
        $src = $catalogCategoryView->getListProductBlock()->getProductItem($product)->getBaseImageSource();
        \PHPUnit_Framework_Assert::assertTrue(
            strpos($src, '/placeholder/') !== false,
            'Detail image is displayed on category view when it should not.'
        );
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'No product images is displayed on category view.';
    }
}
