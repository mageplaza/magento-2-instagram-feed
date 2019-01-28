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

namespace Mageplaza\InstagramFeed\Controller\Adminhtml\Auth;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\HTTP\Adapter\CurlFactory;
use Mageplaza\InstagramFeed\Helper\Data;
use Mageplaza\InstagramFeed\Model\System\Config\Backend\SaveData;
use Psr\Log\LoggerInterface;

/**
 * Class Callback
 * @package Mageplaza\InstagramFeed\Controller\Adminhtml\Auth
 */
class Callback extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    protected $resultRawFactory;

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var SaveData
     */
    protected $config;

    /**
     * @var CurlFactory
     */
    protected $curlFactory;

    /**
     * Callback constructor.
     *
     * @param Context $context
     * @param RawFactory $resultRawFactory
     * @param LoggerInterface $logger
     * @param Data $helperData
     * @param CurlFactory $curlFactory
     * @param SaveData $saveData
     */
    public function __construct(
        Context $context,
        RawFactory $resultRawFactory,
        LoggerInterface $logger,
        Data $helperData,
        CurlFactory $curlFactory,
        SaveData $saveData
    ) {
        $this->resultRawFactory = $resultRawFactory;
        $this->helperData = $helperData;
        $this->logger = $logger;
        $this->config = $saveData;
        $this->curlFactory = $curlFactory;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = ['status' => false];
        $params = $this->getRequest()->getParams();
        if ($params && $params['client_id'] && $params['client_secret'] && $params['code']) {
            try {
                $token = $this->getToken($params['client_id'], $params['client_secret'], $params['code']);
                if (isset($token['access_token'])) {
                    $this->config->setConfig($token['access_token']);
                    $result = [
                        'status'  => true,
                        'content' => __('Get access_token successfully!')
                    ];
                }
                if (isset($token['error_message'])) {
                    $result = [
                        'status'  => false,
                        'content' => $token['error_message']
                    ];
                }
            } catch (\Exception $e) {
                $result['content'] = $e->getMessage();
                $this->logger->critical($e);
            }
        } else {
            $result['content'] = __('Please fill your client information.');
        }

        return $this->getResponse()->representJson(Data::jsonEncode($result));
    }

    /**
     * @param $key
     * @param null $value
     *
     * @return bool|mixed
     */
    public function checkRequest($key, $value = null)
    {
        $param = $this->getRequest()->getParam($key, false);

        if ($value) {
            return $param == $value;
        }

        return $param;
    }

    /**
     * @param $id
     * @param $secret
     * @param $code
     *
     * @return array|mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getToken($id, $secret, $code)
    {
        $result = [];
        $params = [
            'client_id'     => $id,
            'client_secret' => $secret,
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => $this->helperData->getAuthUrl(),
            'code'          => $code
        ];

        $url = 'https://api.instagram.com/oauth/access_token';

        $curl = $this->curlFactory->create();
        $curl->write(\Zend_Http_Client::POST, $url, '1.1', [], http_build_query($params, null, '&'));

        try {
            $resultCurl = $curl->read();
            if (!empty($resultCurl)) {
                $responseBody = \Zend_Http_Response::extractBody($resultCurl);
                $result += Data::jsonDecode($responseBody);
            }
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
        }

        $curl->close();

        return $result;
    }
}
