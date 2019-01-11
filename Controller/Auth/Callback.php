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

namespace Mageplaza\InstagramFeed\Controller\Auth;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;
use Mageplaza\InstagramFeed\Helper\Data;

/**
 * Class Callback
 * @package Mageplaza\InstagramFeed\Controller\Auth
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
     * Callback constructor.
     *
     * @param Context $context
     * @param RawFactory $resultRawFactory
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        RawFactory $resultRawFactory,
        Data $helperData
    )
    {
        $this->resultRawFactory = $resultRawFactory;
        $this->helperData       = $helperData;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        if ($this->checkRequest('code')) {
            $this->helperData->code = $this->getRequest()->getParam('code');

            print_r('This is your code: ' . $this->helperData->code);
        }
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
}