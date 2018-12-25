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
    "Magento_Ui/js/modal/alert",
    "mage/translate",
    "jquery/ui"
], function ($, alert, $t) {
    "use strict";

    $.widget('mageplaza.auth', {
        options: {
            ajaxUrl: '',
            client_id: 'mpinstagramfeed_general_client_id',
            client_secret: 'mpinstagramfeed_general_client_secret',
            
        },
        _create: function () {
            var self = this;

            $(this.options.testEmail).click(function (e) {
                e.preventDefault();
                if (self.element.val()) {
                    self._ajaxSubmit();
                }
            });
        },

        _ajaxSubmit: function () {
            $.ajax({
                url: this.options.ajaxUrl,
                data: {
                    from: $(this.options.fromEmailElem).val(),
                    to: this.element.val(),
                    host: $(this.options.hostElem).val(),
                    port: $(this.options.portElem).val(),
                    authentication: $(this.options.authenticationElem).val(),
                    protocol: $(this.options.protocolElem).val(),
                    username: $(this.options.usernameElem).val(),
                    password: $(this.options.passwordElem).val(),
                    returnpath: $(this.options.rerutnPathElem).val()
                },
                dataType: 'json',
                showLoader: true,
                success: function (result) {
                    alert({
                        title: result.status ? $t('Success') : $t('Error'),
                        content: result.content
                    });
                }
            });
        }
    });

    return $.mageplaza.auth;
});
