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
define([
    "jquery",
    "Magento_Ui/js/modal/alert",
    "mage/translate",
    "jquery-ui-modules/widget"
], function ($, alert, $t) {
    "use strict";

    $.widget('mageplaza.auth', {
        options: {
            ajaxUrl: '',
            btn_token: '#mpinstagramfeed_general_token',
            client_id: '#mpinstagramfeed_general_client_id',
            client_secret: '#mpinstagramfeed_general_client_secret',
            redirect_uri: '#mpinstagramfeed_general_redirect_url',
            code: '#mpinstagramfeed_general_code'
        },
        _create: function () {
            this.initObserve();
        },

        initObserve: function () {
            var self = this;
            $(this.options.btn_token).click(function (e) {
                e.preventDefault();
                self._ajaxSubmit();
            });
        },
        _ajaxSubmit: function () {
            $.ajax({
                url: this.options.ajaxUrl,
                data: {
                    client_id: $(this.options.client_id).val(),
                    client_secret: $(this.options.client_secret).val(),
                    redirect_uri: $(this.options.redirect_uri).val(),
                    code: $(this.options.code).val()
                },
                dataType: 'json',
                type: 'GET',
                showLoader: true,
                success: function (result) {
                    alert({
                        title: result.status ? $t('Success') : $t('Error'),
                        content: result.content
                    });
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    });

    return $.mageplaza.auth;
});

