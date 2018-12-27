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
 * @package     Mageplaza_FacebookPlugin
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */
namespace Mageplaza\InstagramFeed\Block;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Mageplaza\InstagramFeed\Helper\Data;
use Mageplaza\FacebookPlugin\Model\Config\Source\Options;

class Widget extends Template implements BlockInterface
{
    protected $_template = "instagram.phtml";

    protected $helperData;

    public function __construct(
        Template\Context $context,
        Data $helperData,
        array $data = []
    )
    {
        $this->helperData = $helperData;

        parent::__construct($context, $data);
    }

    /**
     * Retrieve all options for Instagram feed
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getAllOptions() {
        $option = $this->getData('design');
        if ($option == Options::CONFIG) {
            $this->setData(array_merge($this->helperData->getDisplayConfig($this->getStoreId()),$this->getData()));
        }
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getAccessToken()
    {
        $token = $this->helperData->getConfigGeneral('access_token',$this->getStoreId());

        return $token;
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStoreId()
    {
        $storeId = $this->_storeManager->getStore()->getId();

        return $storeId;
    }
}