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
 * Class Design
 * @package Mageplaza\InstagramFeed\Model\Config\Source
 */
class Design implements ArrayInterface
{
    const CONFIG = 0;
    const CUSTOM = 1;

    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::CONFIG,
                'label' => __('Use Config')
            ],
            [
                'value' => self::CUSTOM,
                'label' => __('Custom')
            ]
        ];

        return $options;
    }
}
