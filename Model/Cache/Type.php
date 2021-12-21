<?php
/*
 * Author: Aleš Cankar (ales.cankar@optiweb.com)
 * Copyright (c) 2021 Optiweb (https://www.optiweb.com)
 */

namespace Mageplaza\InstagramFeed\Model\Cache;

use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\Cache\Frontend\Decorator\TagScope;

class Type extends TagScope
{
    const TYPE_IDENTIFIER = 'instagram_feed';

    const CACHE_TAG = 'INSTAGRAM_FEED';

    const CACHE_LIFETIME = 86400;

    /**
     * @param FrontendPool $cacheFrontendPool
     */
    public function __construct(FrontendPool $cacheFrontendPool)
    {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
    }

}
