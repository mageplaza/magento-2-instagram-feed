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
define([
    "jquery",
    "mage/translate"
], function ($,$t) {
    "use strict";
    $.widget('mageplaza.instagram', {
        options: {
            token: '',
            count: '',
            sort: '',
            image_resolution: '',
        },
        _create: function () {
            this._ajaxSubmit()
        },

        _ajaxSubmit: function () {
            var self = this;
            $.ajax({
                url: "https://api.instagram.com/v1/users/self/media/recent/",
                data: {
                    access_token: this.options.token,
                    count: this.options.count
                },
                dataType: 'json',
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    var x;
                    var Imageurl;
                    var id = '#mpinstagramfeed-photos-'+ self.options.id;
                    switch(self.options.sort) {
                        case 'like':
                            data.data.sort(function(a,b){return b.likes.count - a.likes.count});
                            break;
                        case 'comment':
                            data.data.sort(function(a,b){return b.comments.count - a.comments.count});
                            break;
                        case 'random':
                            data.data.sort(function(){return Math.random() - Math.random()});
                            break;
                        default:
                            data.data.sort(function(a,b){return b.created_time - a.created_time });
                    }

                    for( x in data.data ){
                        switch(self.options.image_resolution) {
                            case 'low':
                                Imageurl = data.data[x].images.low_resolution.url;
                                break;
                            case 'standard':
                                Imageurl = data.data[x].images.standard_resolution.url;
                                break;
                            default:
                                Imageurl = data.data[x].images.thumbnail.url;
                        }
                        $(id).append('<div class="mpinstagramfeed-photo"><a class="mpinstagramfeed-post-url" href="'+data.data[x].link+'" target="_blank"><i class="fa fa-heart">'+data.data[x].likes.count+'</i><i class="fa fa-comment">'+data.data[x].comments.count+'</i><img class="mpinstagramfeed-image" src="'+Imageurl+'"></a></div>');
                        // data.data[x].images.low_resolution.url - URL of image, 306х306
                        // data.data[x].images.thumbnail.url - URL of image 150х150
                        // data.data[x].images.standard_resolution.url - URL of image 612х612
                        // data.data[x].link - Instagram post URL
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    });

    return $.mageplaza.instagram;
});