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

namespace Mageplaza\InstagramFeed\Model\System\Config\Backend;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Store\Model\StoreManagerInterface;
/**
 * Class SaveData
 * @package Mageplaza\InstagramFeed\Model\System\Config\Backend
 */
class SaveData
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\App\Config\Storage\WriterInterface
     */
    protected $_configWriter;

    /**
     * SaveData constructor.
     *
     * @param LoggerInterface $logger
     * @param WriterInterface $configWriter
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        LoggerInterface $logger,
        WriterInterface $configWriter,
        StoreManagerInterface $storeManager
    ){
        $this->_logger = $logger;
        $this->_configWriter = $configWriter;
        $this->_storeManager = $storeManager;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setConfig($value)
    {
        //for all websites
        $websites = $this->_storeManager->getWebsites();
        $scope = "websites";
        foreach($websites as $website) {
            $this->_configWriter->save('mpinstagramfeed/general/access_token', $value, $scope, $website->getId());
        }

        return $this;
    }
}