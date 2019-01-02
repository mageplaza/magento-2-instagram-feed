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
use Mageplaza\InstagramFeed\Model\Config\Source\Design;
use Mageplaza\InstagramFeed\Model\Config\Source\Image;

class Widget extends Template implements BlockInterface
{
    protected $_template = "instagram.phtml";

    public $widgetId;

    /**
     * @var Data
     */
    protected $helperData;

    public function __construct(
        Template\Context $context,
        Data $helperData,
        array $data = []
    )
    {
        $this->helperData = $helperData;
        $this->widgetId = uniqid();
        parent::__construct($context, $data);
    }

    public function isEnable()
    {
       return $this->helperData->isEnabled();
    }

    /**
     * Retrieve all options for Instagram feed
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getAllOptions()
    {
        $option = $this->getData('design');
        if ($option == Design::CONFIG) {
            $this->setData(array_merge($this->helperData->getDisplayConfig($this->getStoreId()),$this->getData()));
        }

        return $this;
    }

    /**
     * Get width image by image_resolution for optimized layout
     * @param $type
     *
     * @return int
     */
    public function getWidthImage($type)
    {
        switch ($type) {
            case Image::THUMBNAIL :
                $width = 150;
                break;
            case Image::LOW :
                $width = 306;
                break;
            case Image::STANDARD :
                $width = 612;
                break;
            default : $width = 150;
        }

        return $width;
    }

    /**
     * @param $layout
     *
     * @return int|mixed|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getNumberRow($layout)
    {
        $options = $this->getAllOptions();
        switch ($layout) {
            case \Mageplaza\InstagramFeed\Model\Config\Source\Layout::MULTIPLE:
                $number_row = !empty($this->getData('number_row')) ? $this->getData('number_row') : 2;
                break;
            case  \Mageplaza\InstagramFeed\Model\Config\Source\Layout::OPTIMIZED:
                $number_row = null;
                break;
            default:
                $number_row = 1;
        };

        return $number_row;
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