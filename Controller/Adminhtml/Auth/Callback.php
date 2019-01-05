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

namespace Mageplaza\InstagramFeed\Controller\Adminhtml\Auth;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;
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
     * Callback constructor.
     *
     * @param Context $context
     * @param RawFactory $resultRawFactory
     * @param LoggerInterface $logger
     * @param Data $helperData
     * @param SaveData $saveData
     */
    public function __construct(
        Context $context,
        RawFactory $resultRawFactory,
        LoggerInterface $logger,
        Data $helperData,
        SaveData $saveData
    )
    {
        $this->resultRawFactory = $resultRawFactory;
        $this->helperData       = $helperData;
        $this->logger           = $logger;
        $this->config           = $saveData;

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
     * Return javascript to redirect when login success
     *
     * @param null $content
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function _appendJs($content = null)
    {
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultRawFactory->create();

        return $resultRaw->setContents($content);
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
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getToken($id, $secret, $code)
    {
        $param = [
            'client_id'     => $id,
            'client_secret' => $secret,
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => $this->helperData->getAuthUrl(),
            'code'          => $code
        ];

        $url = 'https://api.instagram.com/oauth/access_token';

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, count($param));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);

        $result = curl_exec($ch);

        curl_close($ch);
        $result = json_decode($result, true);

        return $result;
    }
}