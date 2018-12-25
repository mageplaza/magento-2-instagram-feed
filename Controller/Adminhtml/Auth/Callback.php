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

class Callback extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    protected $resultRawFactory;

    protected $apiObject;

    public function __construct(
        Context $context,
        RawFactory $resultRawFactory
    )
    {
        parent::__construct($context);
        $this->resultRawFactory = $resultRawFactory;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {

        if ($this->checkRequest('hauth_start', false) && (
                $this->checkRequest('error_reason', 'user_denied')
                && $this->checkRequest('error', 'access_denied')
                && $this->checkRequest('error_code', '200')
            )) {
            return $this->_appendJs(sprintf("<script>window.close();</script>"));
        }

        \Hybrid_Endpoint::process();
    }

    /**
     * Return javascript to redirect when login success
     *
     * @param null $content
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function _appendJs($content = null)
    {
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultRawFactory->create();

        return $resultRaw->setContents($content ?: sprintf("<script>window.opener.socialCallback('%s', window);</script>"));
    }

    /**
     * @param $key
     * @param null $value
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