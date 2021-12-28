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

namespace Mageplaza\InstagramFeed\Controller\Feed;

use InvalidArgumentException;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Cache;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json as JsonResult;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Webapi\Exception as HttpException;
use Magento\Setup\Exception;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Mageplaza\InstagramFeed\Model\Cache\Type as CacheType;

class Get extends Action
{
    /** @var JsonFactory */
    protected $_resultJsonFactory;

    /** @var StoreManagerInterface */
    protected $_storeManager;

    /** @var Cache */
    protected $_cache;

    /** @var Cache\State */
    protected $_cacheState;

    /** @var ScopeConfigInterface */
    protected $_scopeConfig;

    /** @var Curl */
    protected $_curl;

    /** @var Json */
    protected $_json;

    /** @var string */
    protected $id;

    const API_URL = 'https://graph.instagram.com/me/media';

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param StoreManagerInterface $_storeManager
     * @param Cache $cache
     * @param Cache\State $cacheState
     * @param ScopeConfigInterface $scopeConfig
     * @param Curl $curl
     * @param Json $json
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        StoreManagerInterface $_storeManager,
        Cache $cache,
        Cache\State $cacheState,
        ScopeConfigInterface $scopeConfig,
        Curl $curl,
        Json $json
    ) {
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->_storeManager = $_storeManager;
        $this->_cache = $cache;
        $this->_cacheState = $cacheState;
        $this->_scopeConfig = $scopeConfig;
        $this->_curl = $curl;
        $this->_json = $json;
        $this->id = $this->getId();
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|JsonResult|ResultInterface
     */
    public function execute()
    {
        $result = $this->_resultJsonFactory->create();
        try {
            // Redirect to 404 if request isn't AJAX or if instagram feed is disabled
            if (
                !$this->getRequest()->isAjax() ||
                !$this->_scopeConfig->getValue('mpinstagramfeed/general/enabled', ScopeInterface::SCOPE_STORE)
            ) {
                return $this->_redirect('noroute');
            }

            if ($this->_cacheState->isEnabled(CacheType::TYPE_IDENTIFIER)) {
                // Return cached Instagram feed if it exists
                if ($feed = $this->_cache->load($this->id)) {
                    return $result->setData($this->_json->unserialize($feed));
                }
            }

            // Retrieve feed from Instagram Graph API
            $this->_curl->get($this->getFeedUrl());

            if ($this->_curl->getStatus() === 200) {
                if ($this->_cacheState->isEnabled(CacheType::TYPE_IDENTIFIER)) {
                    // Save to cache if response was successful and return it
                    $this->save($this->_curl->getBody(), $this->id);
                    return $result->setData($this->_json->unserialize($this->_cache->load($this->id)));
                }
                // If cache type is disabled, just return the curl response
                return $result->setData($this->_json->unserialize($this->_curl->getBody()));
            }

            // Call to Graph API threw an error
            $result->setHttpResponseCode(HttpException::HTTP_BAD_REQUEST);
            return $result->setData($this->_json->unserialize($this->_curl->getBody()));
        } catch (Exception $e) {
            $result->setHttpResponseCode(HttpException::HTTP_BAD_REQUEST);
            return $result->setData(['error' => $e->getMessage()]);
        } catch (InvalidArgumentException $e) {
            $result->setHttpResponseCode(HttpException::HTTP_INTERNAL_ERROR);
            return $result->setData(['error' => $e->getMessage()]);
        }
    }

    /**
     * Get unique cache key
     * @return string
     */
    public function getId()
    {
        try {
            return base64_encode($this->_storeManager->getStore()->getCode() . CacheType::TYPE_IDENTIFIER);
        } catch (NoSuchEntityException $e) {
            return base64_encode(date('Y-m-d') . CacheType::TYPE_IDENTIFIER);
        }
    }

    /**
     * Load cached value if cache type is enabled
     * @param $cacheId
     * @return bool|string
     */
    public function load($cacheId)
    {
        if ($this->_cacheState->isEnabled(CacheType::TYPE_IDENTIFIER)) {
            return $this->_cache->load($cacheId) ?: false;
        }
        return false;
    }

    /**
     * Save data to cache type if enabled
     * @param $data
     * @param $cacheId
     * @return bool
     */
    public function save($data, $cacheId)
    {
        if ($this->_cacheState->isEnabled(CacheType::TYPE_IDENTIFIER)) {
            return $this->_cache->save($data, $cacheId, [CacheType::CACHE_TAG], CacheType::CACHE_LIFETIME);
        }
        return false;
    }

    /**
     * @return string
     */
    protected function getFeedUrl()
    {
        $token = $this->_scopeConfig->getValue('mpinstagramfeed/general/access_token', ScopeInterface::SCOPE_STORE);
        return self::API_URL . '?' . http_build_query([
                'access_token' => $token,
                'fields' => 'id, caption, media_type, media_url, permalink'
            ]);
    }
}
