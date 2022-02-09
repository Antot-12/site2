/**
 * File custom.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

/*
Template: streamit - Data science WordPress landing Page
Author URI: https://iqonic.design/
Version: 1.5.0
Design and Developed by: https://iqonic.design/
*/

/*----------------------------------------------
Index Of Script
------------------------------------------------

1. Page Loader
2. Back To Top
3. Header
4. Wow Animation
5. Back to Top
6. Header Menu Dropdown
7. Mobile Menu Overlay
8. Inner-Slider
9. Select 2 Dropdown
10. Video popup
11. Flatpicker
12. Custom File Uploader


------------------------------------------------
Index Of Script
----------------------------------------------*/
(function (jQuery) {

    "use strict";
    jQuery(window).on('load', function (e) {
        jQuery('ul.page-numbers').addClass('justify-content-center');

        /*------------------------
        Page Loader
        --------------------------*/
        jQuery("#load").fadeOut();
        jQuery("#loading").delay(0).fadeOut("slow");

        jQuery('.widget .fa.fa-angle-down, #main .fa.fa-angle-down').on('click', function () {
            jQuery(this).next('.children, .sub-menu').slideToggle();
        });

        /*------------------------
        Back To Top
        --------------------------*/
        jQuery('#back-to-top').fadeOut();
        jQuery(window).on("scroll", function () {
            if (jQuery(this).scrollTop() > 250) {
                jQuery('#back-to-top').fadeIn(1400);
            } else {
                jQuery('#back-to-top').fadeOut(400);
            }
        });

        // scroll body to 0px on click
        jQuery('#top').on('click', function () {
            jQuery('top').tooltip('hide');
            jQuery('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });


        /*------------------------
        Header
        --------------------------*/
        function headerHeight() {
            var height = jQuery("#main-header").height();
            jQuery('.iq-height').css('height', height + 'px');
        }

        jQuery(function () {
            var header = jQuery("#main-header"),
                yOffset = 0,
                triggerPoint = 80;

            headerHeight();

            jQuery(window).resize(headerHeight);
            jQuery(window).on('scroll', function () {

                yOffset = jQuery(window).scrollTop();
                if (yOffset >= 300) {
                    header.addClass("menu-sticky animated slideInDown");
                } else {
                    header.removeClass("menu-sticky animated slideInDown");
                }

            });
        });

        if (jQuery('header').hasClass('has-sticky')) {
            jQuery(window).on('scroll', function () {
                if (jQuery(this).scrollTop() > 300) {
                    jQuery('header').addClass('menu-sticky animated slideInDown');
                    jQuery('.has-sticky .logo').addClass('logo-display');
                } else if (jQuery(this).scrollTop() < 20) {
                    jQuery('header').removeClass('menu-sticky animated slideInDown');
                    jQuery('.has-sticky .logo').removeClass('logo-display');
                }
            });
        }

        jQuery('.sub-menu').css('display', 'none');
        jQuery('.sub-menu').prev().addClass('isubmenu');
        jQuery(".sub-menu").before('<i class="ion-ios-arrow-down toggledrop" aria-hidden="true"></i>');


        jQuery('.widget .ion-ios-arrow-down, #main .ion-ios-arrow-down').on('click', function () {
            jQuery(this).next('.children, .sub-menu').slideToggle();
        });

        jQuery("#top-menu .menu-item .toggledrop").off("click");
        if (jQuery(window).width() < 992) {
            jQuery('#top-menu .menu-item .toggledrop').on('click', function (e) {
                e.preventDefault();
                jQuery(this).next('.children, .sub-menu').slideToggle();
            });
        }
    });


    jQuery(document).ready(function () {
        window.onscroll = function () {
            jQuery(document).find('.nav-link[aria-selected="true"]').addClass("active");
        };
        /*------------------------
        Header
        --------------------------*/
        function headerHeight() {
            var height = jQuery("#main-header").height();
            jQuery('.iq-height').css('height', height + 'px');
        }

        jQuery(function () {
            var header = jQuery("#main-header"),
                yOffset = 0,
                triggerPoint = 80;

            headerHeight();

            jQuery(window).resize(headerHeight);
            jQuery(window).on('scroll', function () {

                yOffset = jQuery(window).scrollTop();
                if (yOffset >= 300) {
                    header.addClass("menu-sticky animated slideInDown");
                } else {
                    header.removeClass("menu-sticky animated slideInDown");
                }

            });
        });

        if (jQuery('header').hasClass('has-sticky')) {
            jQuery(window).on('scroll', function () {
                if (jQuery(this).scrollTop() > 300) {
                    jQuery('header').addClass('menu-sticky animated slideInDown');
                    jQuery('.has-sticky .logo').addClass('logo-display');
                } else if (jQuery(this).scrollTop() < 20) {
                    jQuery('header').removeClass('menu-sticky animated slideInDown');
                    jQuery('.has-sticky .logo').removeClass('logo-display');
                }
            });
        }

        /*------------------------
        Wow Animation
        --------------------------*/
        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: false,
            live: true
        });
        wow.init();

        jQuery(window).on('resize', function () {
            "use strict";
            jQuery('.widget .ion-ios-arrow-down, #main .ion-ios-arrow-down').on('click', function () {
                jQuery(this).next('.children, .sub-menu').slideToggle();
            });

            jQuery("#top-menu .menu-item .toggledrop").off("click");
            if (jQuery(window).width() < 992) {
                jQuery('#top-menu .menu-item .toggledrop').on('click', function (e) {
                    e.preventDefault();
                    jQuery(this).next('.children, .sub-menu').slideToggle();
                });
            }
        });
        /*---------------------------------------------------------------------
            Back to Top
        ---------------------------------------------------------------------*/
        var btn = jQuery('#back-to-top');
        jQuery(window).scroll(function () {
            if (jQuery(window).scrollTop() > 50) {
                btn.addClass('show');
            } else {
                btn.removeClass('show');
            }
        });
        btn.on('click', function (e) {
            e.preventDefault();
            jQuery('html, body').animate({ scrollTop: 0 }, '300');
        });


        /*---------------------------------------------------------------------
            Header Menu Dropdown
        ---------------------------------------------------------------------*/
        jQuery('[data-toggle=more-toggle]').on('click', function () {
            jQuery(this).next().toggleClass('show');
        });

        /*---------------------------------------------------------------------
       search bar toggle
       ----------------------------------------------------------------------- */
        if (jQuery("header .search__input").length > 0 && jQuery("header .search-box").length > 0) {
            jQuery(document).on('click', '#btn-search', function () {
                jQuery('.iq-usermenu-dropdown li.header-search-right').toggleClass('iq-show');
                jQuery('header .search-box').toggleClass('active');

                jQuery('.iq-usermenu-dropdown li.header-user-rights').removeClass('iq-show');
                jQuery('header .iq-sub-dropdown.iq-user-dropdown').removeClass('active');
            });
        }
        jQuery(document).on('click', '#btn-user-list', function () {
            jQuery('.iq-usermenu-dropdown li.header-user-rights').toggleClass('iq-show');
            jQuery('header .iq-sub-dropdown.iq-user-dropdown').toggleClass('active');

            jQuery('.iq-usermenu-dropdown li.header-search-right').removeClass('iq-show');
            jQuery('header .search-box').removeClass('active');
        });

        /*---------------------------------------------------------------------
        Mobile Menu Overlay
        ----------------------------------------------------------------------- */
        jQuery(document).on("click", function (event) {
            var jQuerytrigger = jQuery(".main-header .navbar");
            if (jQuerytrigger !== event.target && !jQuerytrigger.has(event.target).length) {
                jQuery(".main-header .navbar-collapse").collapse('hide');
                jQuery('body').removeClass('nav-open');
            }
        });
        jQuery('.c-toggler').on("click", function () {
            jQuery('body').addClass('nav-open');
        });

        /*------------------------
           watchlist last item
        --------------------------*/
        let iq_tags = jQuery('.iq_tags-contents');
        if (jQuery('.wl-child').length) {
            let count;
            let in_count;
            let width = jQuery(window).width();
            if (width > 991) {
                count = 3; in_count = 4;
            }
            else if (width > 767 && width < 991) {
                count = 2; in_count = 3;
            }
            else if (width < 768) {
                count = 1; in_count = 2;
            }
            else {
                count = 3;
                in_count = 4;
            }
            let k = 0;
            let j = count;
            let len = jQuery('.wl-child').length;

            jQuery('.iq_genres-contents .wl-child').each(function () {
                if (k === 0) {
                    jQuery(this).find('.watchlist-img').addClass('watchlist-first');
                }
                if (j == k || k === count || (len.length - 1) === k) {
                    j += in_count;
                    jQuery(this).find('.watchlist-img').addClass('watchlist-last');
                    jQuery(this).next().find('.watchlist-img').addClass('watchlist-first');
                }
                k++;
            });

            jQuery('.iq_tags-contents').each(function () {
                let width = jQuery(window).width();

                if (width > 991) {
                    count = 5; in_count = 6;
                }
                else if (width > 767 && width < 991) {
                    count = 3; in_count = 4;
                }
                else if (width < 768) {
                    count = 2; in_count = 3;
                }
                else {
                    count = 3;
                    in_count = 4;
                }
                k = 0;
                j = count;
                len = jQuery(this).find('.wl-child').length;
                jQuery(this).find('.wl-child').each(function () {
                    if (k === 0) {
                        jQuery(this).find('.iq-tag-box').addClass('watchlist-first');
                    }
                    if (j == k || k === count || (len.length - 1) === k) {
                        j += in_count;
                        jQuery(this).find('.iq-tag-box').addClass('watchlist-last');
                        jQuery(this).next().find('.iq-tag-box').addClass('watchlist-first');
                    }
                    k++;
                });
            });
        }

        /*------------------------
            Inner-Slider
        --------------------------*/

        if (jQuery('.inner-slider').length > 0) {
            jQuery('.inner-slider').slick({
                dots: false,
                arrows: true,
                infinite: true,
                speed: 300,
                autoplay: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                nextArrow: '<a href="#" class="slick-arrow slick-next"><i class= "fas fa-chevron-right"></i></a>',
                prevArrow: '<a href="#" class="slick-arrow slick-prev"><i class= "fas fa-chevron-left"></i></a>',
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
        /*---------------------------------------------------------------------
            Select 2 Dropdown
        -----------------------------------------------------------------------*/
        if (jQuery('select').hasClass('season-select')) {
            jQuery('select').select2({
                theme: 'bootstrap4',
                allowClear: false,
                width: 'resolve'
            });
        }
        if (jQuery('select').hasClass('pro-dropdown')) {
            jQuery('.pro-dropdown').select2({
                theme: 'bootstrap4',
                minimumResultsForSearch: Infinity,
                width: 'resolve'
            });
            jQuery('#lang').select2({
                theme: 'bootstrap4',
                placeholder: 'Language Preference',
                allowClear: true,
                width: 'resolve'
            });
        }

        /*---------------------------------------------------------------------
            Video popup
        -----------------------------------------------------------------------*/
        if (jQuery('.video-open').length > 0) {
            jQuery('.video-open').magnificPopup({
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false,
                iframe: {
                    markup: '<div class="mfp-iframe-scaler">' +
                        '<div class="mfp-close"></div>' +
                        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                        '</div>',

                    srcAction: 'iframe_src',
                }
            });
        }


        /*---------------------------------------------------------------------
            Flatpicker
        -----------------------------------------------------------------------*/
        if (jQuery('.date-input').hasClass('basicFlatpickr')) {
            jQuery('.basicFlatpickr').flatpickr();
        }
        /*---------------------------------------------------------------------
            Custom File Uploader
        -----------------------------------------------------------------------*/
        jQuery(".file-upload").on("change", function () {
            ! function (e) {
                if (e.files && e.files[0]) {
                    var t = new FileReader;
                    t.onload = function (e) {
                        jQuery(".profile-pic").attr("src", e.target.result)
                    }, t.readAsDataURL(e.files[0])
                }
            }(this)
        }), jQuery(".upload-button").on("click", function () {
            jQuery(".file-upload").click();
        });


        /*------------------------
            Comment Form validation
        --------------------------*/
        if (jQuery('.validate-form').length > 0) {
            jQuery('.validate-form #commentform').submit(function () {
                jQuery('.error-msg').hide();
                var cmnt = jQuery.trim(jQuery(".validate-form #comment").val());
                var error = '';
                if (jQuery(".validate-form #author").length > 0) {
                    var author = jQuery.trim(jQuery(".validate-form #email").val());
                    var email = jQuery.trim(jQuery(".validate-form #author").val());
                    var url = jQuery.trim(jQuery(".validate-form #url").val());
                    jQuery(".validate-form #comment,.validate-form #author,.validate-form #email,.validate-form #url").removeClass('iq-warning');

                    if (cmnt === "") {
                        jQuery(".validate-form #comment").addClass('iq-warning');
                        error = '1';
                    }
                    if (author === "") {
                        jQuery(".validate-form #author").addClass('iq-warning');
                        error = '1';
                    }
                    if (email === "") {
                        jQuery(".validate-form #email").addClass('iq-warning');
                        error = '1';
                    }
                    if (url === "") {
                        jQuery(".validate-form #url").addClass('iq-warning');
                        error = '1';
                    }

                }
                else {
                    jQuery(".validate-form #comment").removeClass('iq-warning');
                    if (cmnt === "") {
                        jQuery(".validate-form #comment").addClass('iq-warning');
                        error = '1';
                    }
                }
                if (error !== '' && error === '1') {
                    jQuery('.error-msg').html('One or more fields have an error. Please check and try again.');
                    jQuery('.error-msg').slideDown();
                    return false;
                }


            });
        }

        /*------------------------
           Description Tab
       --------------------------*/
        jQuery('.streamit-content-details .nav-link:first').addClass('active');
        jQuery('.streamit-content-details .tab-pane:first').addClass('active show');

        /*------------------------
            Read More content
        --------------------------*/
        var content_count = jQuery(".streamit-content-details .show-more a,.iq-tvshows-slider .shows-content .show-more a").attr('data-count');
        if (content_count > 50) {
            jQuery(".streamit-content-details .show-more a, .iq-tvshows-slider .shows-content .show-more a").on("click", function () {
                var $this = jQuery(this);
                var content = $this.parent().prev(".description-content");
                var moretext = $this.attr('data-showmore');
                var lesstext = $this.attr('data-showless');
                var linkText = $this.text();
                if (linkText === moretext) {
                    var linkText_less = lesstext;
                    linkText = linkText_less;
                } else {
                    var linkText_more = moretext;
                    linkText = linkText_more;
                }
                content.toggleClass('showContent hideContent');

                $this.text(linkText);
            });
        }
        /*---------------------------------------------------------------------
            Slick Slider
        ----------------------------------------------------------------------- */
        jQuery('.season-select').on('change', function () {
            jQuery('.owl-carousel , .single-season-data').each(function () {
                jQuery(this).removeClass('active show');
            });
            jQuery('[data-display=' + jQuery(this).val() + ']').addClass('active show');
        });


    });
})(jQuery);
