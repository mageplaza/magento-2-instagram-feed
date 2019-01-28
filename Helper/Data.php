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

use Magento\Framework\App\Helper\Context;
use Magento\Framework\ObjectManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
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
    public function getClientId($storeId = null)
    {
        return $this->getConfigGeneral('client_id', $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getClientSecret($storeId = null)
    {
        return $this->getConfigGeneral('client_secret', $storeId);
    }

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
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getAuthUrl()
    {
        $storeId = $this->getScopeUrl();
        /** @var \Magento\Store\Model\Store $store */
        $store = $this->storeManager->getStore($storeId);

        $authUrl = $this->_getUrl('mpinstagramfeed/auth/callback', [
            '_nosid'  => true,
            '_scope'  => $storeId,
            '_secure' => $store->isUrlSecure()
        ]);

        return $authUrl;
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getScopeUrl()
    {
        $scope = $this->_request->getParam(ScopeInterface::SCOPE_STORE) ?: $this->storeManager->getStore()->getId();
        $website = $this->_request->getParam(ScopeInterface::SCOPE_WEBSITE);
        if ($website) {
            $scope = $this->storeManager->getWebsite($website)->getDefaultStore()->getId();
        }

        return $scope;
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
