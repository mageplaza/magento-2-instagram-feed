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

/**
 * Class Image
 * @package Mageplaza\InstagramFeed\Model\Config\Source
 */
class Image implements \Magento\Framework\Option\ArrayInterface
{
    const THUMBNAIL = 'thumbnail';
    const LOW       = 'low';
    const STANDARD  = 'standard';

    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::THUMBNAIL,
                'label' => __('Thumbnail')
            ],
            [
                'value' => self::LOW,
                'label' => __('Low')
            ],
            [
                'value' => self::STANDARD,
                'label' => __('Standard')
            ]
        ];

        return $options;
    }
}
