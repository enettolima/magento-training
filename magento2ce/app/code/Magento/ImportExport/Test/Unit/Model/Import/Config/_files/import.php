<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
return [
    'entities' => [
        'product' => [
            'name' => 'product',
            'label' => 'Label_One',
            'behaviorModel' => 'Model_Basic',
            'model' => 'Model\One',
            'types' => [
                    'product_type_one' => [
                        'name' => 'product_type_one',
                        'model' => 'Detail\Type\One',
                    ],
                    'type_two' => [
                        'name' => 'type_two',
                        'model' => 'Detail\Type\Two',
                    ],
                ],
            'relatedIndexers' => [
                'simple_index' => [
                    'name' => 'simple_index',
                ],
                'custom_product_index' => [
                    'name' => 'custom_product_index',
                ],
            ],
        ],
        'customer' => [
            'name' => 'customer',
            'label' => 'Label_One',
            'behaviorModel' => 'Model_Basic',
            'model' => 'Model\One',
            'types' => [
                'customer_type_one' => [
                    'name' => 'customer_type_one',
                    'model' => 'Customer\Type\One',
                ],
                'type_two' => [
                    'name' => 'type_two',
                    'model' => 'Customer\Type\Two',
                ],
            ],
            'relatedIndexers' => [
                'simple_index' => [
                    'name' => 'simple_index',
                ],
                'custom_customer_index' => [
                    'name' => 'custom_customer_index',
                ],
            ],
        ],
    ]
];
