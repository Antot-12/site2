(function ($) {
    "use strict";
    jQuery(document).ready(function () {
        jQuery(".streamit-notice-dismiss").click(function (e) {
            e.preventDefault();
            jQuery(this).parent().parent(".streamit-notice").fadeOut(600, function () {
                jQuery(this).parent().parent(".streamit-notice").remove();
            });
            notify_wordpress(jQuery(this).data("msg"));
        });
    });
}(jQuery));

function notify_wordpress(message) {
    var param = {
        action: 'streamit_dismiss_notice',
        data: message
    };
    jQuery.post(ajaxurl, param);
}