<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_InstagramFeed
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\InstagramFeed\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Layout
 * @package Mageplaza\InstagramFeed\Model\Config\Source
 */
class Layout implements ArrayInterface
{
    const SINGLE = 'single';
    const MULTIPLE = 'multiple';
    const OPTIMIZED = 'optimized';

    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::SINGLE,
                'label' => __('Single Row')
            ],
            [
                'value' => self::MULTIPLE,
                'label' => __('Multiple Rows')
            ],
            [
                'value' => self::OPTIMIZED,
                'label' => __('Optimized image')
            ]
        ];

        return $options;
    }
}
