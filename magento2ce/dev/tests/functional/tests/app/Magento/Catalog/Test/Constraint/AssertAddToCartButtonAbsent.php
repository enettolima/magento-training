<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Catalog\Test\Constraint;

use Magento\Catalog\Test\Fixture\Category;
use Magento\Catalog\Test\Page\Category\CatalogCategoryView;
use Magento\Catalog\Test\Page\Product\CatalogProductView;
use Magento\Cms\Test\Page\CmsIndex;
use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\Mtf\Fixture\InjectableFixture;

/**
 * Checks the button on the category/product pages.
 */
class AssertAddToCartButtonAbsent extends AbstractConstraint
{
    /**
     * Assert that "Add to cart" button is not display on page.
     *
     * @param InjectableFixture $product
     * @param CmsIndex $cmsIndex
     * @param CatalogCategoryView $catalogCategoryView
     * @param CatalogProductView $catalogProductView
     * @param Category $category [optional]
     *
     * @return void
     */
    public function processAssert(
        InjectableFixture $product,
        CmsIndex $cmsIndex,
        CatalogCategoryView $catalogCategoryView,
        CatalogProductView $catalogProductView,
        Category $category = null
    ) {
        $cmsIndex->open();
        $categoryName = $category === null ? $product->getCategoryIds()[0] : $category->getName();
        $cmsIndex->getTopmenu()->selectCategoryByName($categoryName);

        $isProductVisible = $catalogCategoryView->getListProductBlock()->getProductItem($product)->isVisible();
        while (!$isProductVisible && $catalogCategoryView->getBottomToolbar()->nextPage()) {
            $isProductVisible = $catalogCategoryView->getListProductBlock()->getProductItem($product)->isVisible();
        }
        \PHPUnit_Framework_Assert::assertTrue($isProductVisible, 'Detail is absent on category page.');

        \PHPUnit_Framework_Assert::assertFalse(
            $catalogCategoryView->getListProductBlock()->getProductItem($product)->isVisibleAddToCardButton(),
            "Button 'Add to Card' is present on Category page."
        );

        $catalogCategoryView->getListProductBlock()->getProductItem($product)->open();
        \PHPUnit_Framework_Assert::assertFalse(
            $catalogProductView->getViewBlock()->isVisibleAddToCardButton(),
            "Button 'Add to Card' is present on Detail page."
        );
    }

    /**
     * Text absent button "Add to Cart" on the category/product pages.
     *
     * @return string
     */
    public function toString()
    {
        return "Button 'Add to Card' is absent on Category page and Detail Page.";
    }
}
