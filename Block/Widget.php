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
namespace Mageplaza\InstagramFeed\Block;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Mageplaza\InstagramFeed\Helper\Data;
use Mageplaza\InstagramFeed\Model\Config\Source\Design;
use Mageplaza\InstagramFeed\Model\Config\Source\Image;
use Mageplaza\InstagramFeed\Model\Config\Source\Layout;

/**
 * Class Widget
 * @package Mageplaza\InstagramFeed\Block
 */
class Widget extends Template implements BlockInterface
{
    protected $_template = "instagram.phtml";

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * Widget constructor.
     *
     * @param Template\Context $context
     * @param Data $helperData
     * @param array $data
     */
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
     * @return bool
     */
    public function isEnable()
    {
        return $this->helperData->isEnabled();
    }

    /**
     * Retrieve all options for Instagram feed
     *
     * @return mixed
     */
    public function getAllOptions()
    {
        $option = $this->getData('design');
        if ($option == Design::CONFIG) {
            $this->setData(array_merge($this->helperData->getDisplayConfig($this->getStoreId()), $this->getData()));
        }

        return $this->getData();
    }

    /**
     * Get width image by image_resolution for optimized layout
     *
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
            default :
                $width = 150;
        }

        return $width;
    }

    /**
     * @param string $layoutOpt
     *
     * @return int|mixed|null
     */
    public function getNumberRow($layoutOpt)
    {
        switch ($layoutOpt) {
            case Layout::MULTIPLE:
                $number_row = !empty($this->getData('number_row')) ? $this->getData('number_row') : 2;
                break;
            case  Layout::SINGLE:
                $number_row = 1;
                break;
            default:
                $number_row = null;
        };

        return $number_row;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        $token = $this->helperData->getConfigGeneral('access_token', $this->getStoreId());

        return $token;
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }
}