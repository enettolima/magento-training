<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Test class for \Magento\Catalog\Controller\Detail (bundle product type)
 */
namespace Magento\Bundle\Controller;

class ProductTest extends \Magento\TestFramework\TestCase\AbstractController
{
    /**
     * @magentoDataFixture Magento/Bundle/_files/product.php
     */
    public function testViewAction()
    {
        /** @var \Magento\Catalog\Api\ProductRepositoryInterface $productRepository */
        $productRepository = $this->_objectManager->create('Magento\Catalog\Api\ProductRepositoryInterface');
        $product = $productRepository->get('bundle-product');
        $this->dispatch('catalog/product/view/id/' . $product->getEntityId());
        $responseBody = $this->getResponse()->getBody();
        $this->assertContains('Bundle Detail', $responseBody);
        $this->assertContains(
            'In stock',
            $responseBody,
            'Bundle Detail Detailed Page does not contain In Stock field'
        );
        $addToCartCount = substr_count($responseBody, '<span>Add to Cart</span>');
        $this->assertEquals(1, $addToCartCount, '"Add to Cart" button should appear on the page exactly once.');
        $actualLinkCount = substr_count($responseBody, '>Bundle Detail Items<');
        $this->assertEquals(1, $actualLinkCount, 'Bundle product options should appear on the page exactly once.');
        $this->assertNotContains('class="options-container-big"', $responseBody);
        $this->assertSelectCount('#product-options-wrapper', 1, $responseBody);
    }
}
