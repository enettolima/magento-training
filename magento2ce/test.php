<?php

require_once 'app/bootstrap.php';

$app = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);

$class = $app->getObjectManager()->create('Training\Vendor\Model\VendorFactory');

echo 'finished';