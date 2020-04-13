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

namespace Mageplaza\InstagramFeed\Helper;

use Mageplaza\Core\Helper\AbstractData;

/**
 * Class Data
 * @package Mageplaza\InstagramFeed\Helper
 */
class Data extends AbstractData
{
    /**
     * @type string
     */
    const CONFIG_MODULE_PATH = 'mpinstagramfeed';

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getAccessToken($storeId = null)
    {
        return $this->getConfigGeneral('access_token', $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getDisplayConfig($storeId = null)
    {
        return $this->getModuleConfig('display', $storeId);
    }
}
