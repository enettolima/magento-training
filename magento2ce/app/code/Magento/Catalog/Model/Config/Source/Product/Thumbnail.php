<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Catalog\Model\Config\Source\Product;

/**
 * Catalog products per page on Grid mode source
 *
 */
class Thumbnail implements \Magento\Framework\Option\ArrayInterface
{
    const OPTION_USE_PARENT_IMAGE = 'parent';

    const OPTION_USE_OWN_IMAGE = 'itself';

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::OPTION_USE_OWN_IMAGE, 'label' => __('Detail Thumbnail Itself')],
            ['value' => self::OPTION_USE_PARENT_IMAGE, 'label' => __('Parent Detail Thumbnail')]
        ];
    }
}
