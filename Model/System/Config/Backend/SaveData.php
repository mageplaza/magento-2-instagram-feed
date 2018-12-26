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


use Mageplaza\InstagramFeed\Helper\Data;

class SaveData
{
    protected $_logger;
    protected $_storeManager;
    protected $_configWriter;
    protected $helperData;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Mageplaza\InstagramFeed\Helper\Data $helperData
    ){
        $this->_logger = $logger;
        $this->_configWriter = $configWriter;
        $this->_storeManager = $storeManager;
        $this->helperData = $helperData;
    }

    public function setConfig($value)
    {
        //for all websites
        $websites = $this->_storeManager->getWebsites();
        $scope = "websites";
        foreach($websites as $website) {
            echo $website->getId().":\n";

            $this->_configWriter->save('mpinstagramfeed/general/access_token', $this->helperData->token, $scope, $website->getId());
        }

        return $this;
    }
}