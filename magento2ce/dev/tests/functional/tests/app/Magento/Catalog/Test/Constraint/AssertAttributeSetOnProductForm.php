<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Catalog\Test\Constraint;

use Magento\Catalog\Test\Fixture\CatalogAttributeSet;
use Magento\Catalog\Test\Fixture\CatalogProductAttribute;
use Magento\Catalog\Test\Fixture\CatalogProductSimple;
use Magento\Catalog\Test\Page\Adminhtml\CatalogProductEdit;
use Magento\Catalog\Test\Page\Adminhtml\CatalogProductIndex;
use Magento\Catalog\Test\Page\Adminhtml\CatalogProductNew;
use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\Mtf\Fixture\FixtureFactory;

/**
 * Class AssertAttributeSetOnProductForm
 * Check Attribute Set and Detail Attribute on Detail form
 */
class AssertAttributeSetOnProductForm extends AbstractConstraint
{
    /**
     * Assert that created attribute set:
     * 1. Displays in attribute set suggest container dropdown
     * 2. Can be used for new created product.
     *
     * @param FixtureFactory $fixtureFactory
     * @param CatalogProductEdit $productEdit
     * @param CatalogProductIndex $productGrid
     * @param CatalogAttributeSet $attributeSet
     * @param CatalogAttributeSet $attributeSetOriginal
     * @param CatalogProductNew $newProductPage
     * @param CatalogProductAttribute $productAttribute
     * @return void
     */
    public function processAssert(
        FixtureFactory $fixtureFactory,
        CatalogProductEdit $productEdit,
        CatalogProductIndex $productGrid,
        CatalogAttributeSet $attributeSet,
        CatalogProductNew $newProductPage,
        CatalogProductAttribute $productAttribute,
        CatalogAttributeSet $attributeSetOriginal = null
    ) {
        $productGrid->open();
        $productGrid->getGridPageActionBlock()->addProduct('simple');
        $productBlockForm = $newProductPage->getProductForm();

        /**@var CatalogProductSimple $catalogProductSimple */
        $productSimple = $fixtureFactory->createByCode(
            'catalogProductSimple',
            [
                'dataset' => 'default',
                'data' => [
                    'attribute_set_id' => ['attribute_set' => $attributeSet],
                ],
            ]
        );
        $productBlockForm->fill($productSimple);
        $newProductPage->getFormPageActions()->save();

        $formData = $productEdit->getProductForm()->getData($productSimple);
        $formAttributeSet = $formData['attribute_set_id'];
        \PHPUnit_Framework_Assert::assertEquals(
            $attributeSet->getAttributeSetName(),
            $formAttributeSet,
            'Attribute Set not found on Detail form.'
            . "\nExpected: " . $attributeSet->getAttributeSetName()
            . "\nActual: " . $formAttributeSet
        );

        if ($attributeSetOriginal === null) {
            $productEdit->getProductForm()->openSection('product-details');

            \PHPUnit_Framework_Assert::assertTrue(
                $productEdit->getProductForm()->checkAttributeLabel($productAttribute),
                "Detail Attribute is absent on Detail form."
            );
        }
    }

    /**
     * Text of Detail Attribute and Attribute Set are present on the Detail form.
     *
     * @return string
     */
    public function toString()
    {
        return 'Detail Attribute and Attribute Set are present on the Detail form.';
    }
}
