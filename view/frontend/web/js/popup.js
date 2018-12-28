require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function($,modal) {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            clickableOverlay: true,
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }]
        };
        var popup = modal(options, $('.show-popup'));
        $(".mpinstagramfeed-photo .mpinstagramfeed-photo").on("click",function(){
            $('.show-popup').modal('openModal');
            $('.overlay').addClass('z-index:');
            var $src = $(this).attr("src");
            $(".img-show img").attr("src", $src);
        });
        $(document).click(function(event){
            if((event.target.className.indexOf('_show'))>=0){
                $('#quick-view').modal('closeModal');
            }
        })
    }
);