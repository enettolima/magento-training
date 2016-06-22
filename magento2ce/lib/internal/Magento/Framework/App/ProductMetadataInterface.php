<?php
/**
 * Magento application product metadata
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\App;

interface ProductMetadataInterface
{
    /**
     * Get Detail version
     *
     * @return string
     */
    public function getVersion();

    /**
     * Get Detail edition
     *
     * @return string
     */
    public function getEdition();

    /**
     * Get Detail name
     *
     * @return string
     */
    public function getName();
}
