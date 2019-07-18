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

namespace Mageplaza\InstagramFeed\Model\Config;

use DOMNode;
use LogicException;

/**
 * Class Converter
 * @package Mageplaza\InstagramFeed\Model\Config
 */
class Converter extends \Magento\Widget\Model\Config\Converter
{
    /**
     * Convert dom Depends node to Magento array
     *
     * @param DOMNode $source
     *
     * @return array
     * @throws LogicException
     */
    protected function _convertDepends($source)
    {
        $depends = [];
        foreach ($source->childNodes as $childNode) {
            if ($childNode->nodeName === '#text') {
                continue;
            }
            if ($childNode->nodeName !== 'parameter') {
                throw new LogicException(
                    sprintf("Only 'parameter' node can be child of 'depends' node, %s found", $childNode->nodeName)
                );
            }
            $parameterAttributes = $childNode->attributes;
            $dependencyName = $parameterAttributes->getNamedItem('name')->nodeValue;
            $dependencyValue = $parameterAttributes->getNamedItem('value')->nodeValue;

            if (!isset($depends[$dependencyName])) {
                $depends[$dependencyName] = [
                    'value' => $dependencyValue,
                ];

                continue;
            }
            if (!isset($depends[$dependencyName]['values'])) {
                $depends[$dependencyName]['values'] = [$depends[$dependencyName]['value']];
                unset($depends[$dependencyName]['value']);
            }

            $depends[$dependencyName]['values'][] = $dependencyValue;
        }

        return $depends;
    }
}
