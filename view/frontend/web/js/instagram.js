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
    'Mageplaza_InstagramFeed/js/lib/shuffle.min',
    'mageplaza/core/jquery/popup'
], function ($,Shuffle) {
    "use strict";
    $.widget('mageplaza.instagram', {
        options: {
            id: '',
            token: '',
            count: '',
            sort: '',
            image_resolution: '',
            lauout: '',
            show_like_comment: 0,
            show_popup: 0
        },
        _create: function () {
            this._ajaxSubmit();
        },

        showPopup: function(id) {
            $(id).magnificPopup({
                delegate: '.mpinstagramfeed-photo a',
                type: 'image',
                gallery:{enabled:true},
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true,
                    duration: 300 // don't foget to change the duration also in CSS
                }
            });
        },

        _ajaxSubmit: function () {
            var self = this;
            var id = '#mpinstagramfeed-photos-'+ this.options.id;
            $.ajax({
                url: "https://api.instagram.com/v1/users/self/media/recent/",
                data: {
                    access_token: this.options.token,
                    count: this.options.count
                },
                dataType: 'json',
                type: 'GET',
                success: function (data) {
                    var x;
                    var Imageurl;
                    var items = data.data;
                    switch(self.options.sort) {
                        case 'like':
                            items.sort(function(a,b){return b.likes.count - a.likes.count});
                            break;
                        case 'comment':
                            items.sort(function(a,b){return b.comments.count - a.comments.count});
                            break;
                        case 'random':
                            items.sort(function(){return Math.random() - Math.random()});
                            break;
                        default:
                            items.sort(function(a,b){return b.created_time - a.created_time });
                    }

                    for( x in items ){
                        var item = data.data[x];
                        switch(self.options.image_resolution) {
                            case 'low':
                                Imageurl = item.images.low_resolution.url;
                                break;
                            case 'standard':
                                Imageurl = item.images.standard_resolution.url;
                                break;
                            default:
                                Imageurl = item.images.thumbnail.url;
                        }
                        if (self.options.show_popup == 1) {
                            $(id).append('<div class="mpinstagramfeed-photo">' +
                                '<a class="mpinstagramfeed-post-url" href="'+item.images.standard_resolution.url+'" target="_blank">' +
                                '<i class="fa-heart">'+item.likes.count+'</i>' +
                                '<i class="fa-comment">'+item.comments.count+'</i>' +
                                '<img class="mpinstagramfeed-image" src="'+Imageurl+'">' +
                                '</a></div>');
                        }
                        else {
                            $(id).append('<div class="mpinstagramfeed-photo">' +
                                '<a class="mpinstagramfeed-post-url" href="'+item.link+'" target="_blank">' +
                                '<i class="fa-heart">'+item.likes.count+'</i>' +
                                '<i class="fa-comment">'+item.comments.count+'</i>' +
                                '<img class="mpinstagramfeed-image" src="'+Imageurl+'">' +
                                '</a></div>');
                        }
                    }
                    if (self.options.show_like_comment == 1) {
                        $('.mpinstagramfeed-photo i').addClass('fa');
                    }
                    // use shuffle after load images
                    if (self.options.layout == 'optimized') {
                        self.demo(id);
                    }
                    if (self.options.show_popup == 1) {
                        self.showPopup(id);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        },

        demo: function (id) {
            var element = document.querySelector(id);

            this.shuffle = new Shuffle(element, {
                itemSelector: '.mpinstagramfeed-photo',
                useTransforms: true,
                buffer: 1,
            });
        }
    });

    return $.mageplaza.instagram;
});