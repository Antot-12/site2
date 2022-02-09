/* Style Switcher JS */
(function ($) {
	"use strict";
	//Cookies
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires=" + d.toUTCString();
		document.cookie = cname + "=" + cvalue + "; " + expires;
	}

	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1);
			if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
		}
		return "";
	}

	jQuery(window).load(function () {
		setReadingMode();
		//Toggle switcher panel
		jQuery('.iq-theme-feature .iq-switchbuttontoggler').click(function () {
			if (jQuery('.iq-theme-feature').hasClass('open')) {
				jQuery('.iq-theme-feature').removeClass('open');
			} else {
				jQuery('.iq-theme-feature').addClass('open');
			}
		});

		jQuery('#preset li a').on('click', function () {
			localStorage.setItem('layout_reading_mode', jQuery(this).attr('id'));
			setReadingMode();
		});

	});
	function setReadingMode() {
		let value = localStorage.getItem('layout_reading_mode');
		jQuery(document).find('#preset a').removeClass('active');
		if (value == 'rtl') {
			jQuery('#rtl').addClass("active");
		} else {
			jQuery('#ltr').addClass("active");
		}
	}
})(jQuery);