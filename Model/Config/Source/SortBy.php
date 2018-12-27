<?php
/**
 * Mageplaza
 * NOTICE OF LICENSE
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * @category    Mageplaza
 * @package     Mageplaza_InstagramFeed
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\InstagramFeed\Model\Config\Source;


class SortBy implements \Magento\Framework\Option\ArrayInterface
{
    const MOST_RECENT = 'recent';
    const MOST_LIKED   = 'like';
    const MOST_COMMENTED = 'comment';
    const RANDOM = 'random';

    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::MOST_RECENT,
                'label' => __('Most recent')
            ],
            [
                'value' => self::MOST_LIKED,
                'label' => __('Most liked')
            ],
            [
                'value' => self::MOST_COMMENTED,
                'label' => __('Most commented')
            ],
            [
                'value' => self::RANDOM,
                'label' => __('Random')
            ]
        ];
        return $options;

    }
}