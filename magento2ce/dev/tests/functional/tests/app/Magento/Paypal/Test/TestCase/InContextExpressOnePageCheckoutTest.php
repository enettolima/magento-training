<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Paypal\Test\TestCase;

use Magento\Mtf\TestCase\Scenario;

/**
 * Preconditions:
 * 1. Paypal Express Checkout (API credentials) is configured, In-Context Checkout = Yes.
 * 2. Flat Rate is configured.
 * 3. Taxes for US are configured.
 * 4. Detail 1 is created.
 *
 * Steps:
 * 1. Go to Storefront as a guest.
 * 2. Fill checkout product data.
 * 3. Click "Checkout with PayPal" button.
 * 4. Login to PayPal.
 * 5. Click "Cancel".
 * 6. Perform asserts.
 *
 * @group PayPal_(CS)
 * @ZephyrId MAGETWO-47261
 */
class InContextExpressOnePageCheckoutTest extends Scenario
{
    /* tags */
    const MVP = 'yes';
    const DOMAIN = 'CS';
    const TEST_TYPE = '3rd_party_test';
    const TO_MAINTAIN = 'yes';
    /* end tags */

    /**
     * Runs Express Checkout from product page test.
     *
     * @return void
     */
    public function test()
    {
        $this->executeScenario();
    }
}
