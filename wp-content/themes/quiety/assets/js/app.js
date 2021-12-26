var THEMETAGS = THEMETAGS || {};

(function ($) {

    /*!----------------------------------------------
        # This beautiful code written with heart
        # by Mominul Islam <hello@mominul.me>
        # In Dhaka, BD at the AffixTheme workstation.
        ---------------------------------------------*/

    // USE STRICT
    "use strict";

    window.TT = {
        init: function () {
            // Header
            this.header = $('.site-header');
            this.body = $('body');
            this.wpadminbar = $('#wpadminbar');

            this.headerFixed = {
                initialOffset: parseInt(this.header.attr('data-fixed-initial-offset')) || 100,

                enabled: $('[data-header-fixed]').length,
                value: false,

                mobileEnabled: $('[data-mobile-header-fixed]').length,
                mobileValue: false
            };

            // Logos
            this.siteTitle = this.header.find('.site-title');
            this.logo = this.header.find('.main-logo');
            this.logoForOnepage = this.header.find('.for-onepage');
            this.logoForOnepageLight = this.logoForOnepage.find('.light');

            // Menus
            this.megaMenu = this.header.find('#mega-menu-wrap');
            this.mobileMenu = $('[data-mobile-menu-resolution]').data('mobile-menu-resolution');


            this.resize();
        },

        resize: function () {
            this.isDesktop = $(window).width() >= 991;
            this.isMobile = $(window).width() <= 991;
            this.isPad = $(window).width() <= 1024;
            this.isMobileMenu = $(window).width() <= TT.mobileMenu
        }
    };

    THEMETAGS.initialize = {
        init: function () {
            THEMETAGS.initialize.general();
            THEMETAGS.initialize.swiperSlider();
            THEMETAGS.initialize.countUp();
            THEMETAGS.initialize.sectionSwitch();
            THEMETAGS.initialize.contactFrom();
            THEMETAGS.initialize.googleMap();
            THEMETAGS.initialize.handleMobileHeader();
        },

        /*========================================================*/
        /*=           Collection of snippet and tweaks           =*/
        /*========================================================*/

        general: function () {

            var $scene = $('.animated-element').parallax({
                scalarX: 100,
                scalarY: 100,
            });

            $('.tt-content-filter li a').on('click', function () {
                var categoryValue = $(this).attr('data-filter');
                $(this).addClass('active').siblings().removeClass('active');
                if(categoryValue=="*") {
                    $('.tt-support-item').fadeIn('1000');
                } else {
                    $(".tt-support-item").not('.'+categoryValue).hide();
                    $('.tt-support-item').filter('.'+categoryValue).fadeIn('1000');
                }
            })

            //Popup Search
            $('#search-menu-wrapper').removeClass('toggled');

            $('#search-icon').on('click', function (e) {
                e.stopPropagation();
                $('#search-menu-wrapper').toggleClass('toggled');
                $("#popup-search").focus();
            });

            $('#search-menu-wrapper input').on('click', function (e) {
                e.stopPropagation();
            });

            $('#search-menu-wrapper, body').on('click', function () {
                $('#search-menu-wrapper').removeClass('toggled');
            });

            if ($('body').hasClass("admin-bar")) {
                $('body').addClass('header-position');
            }

            var $body = $('body');
            var $popup = $('.canvas-menu-wrapper');

            $("#page-open-main-menu").on('click', function (e) {
                e.preventDefault();
                var mask = '<div class="mask-overlay">';
                $(mask).hide().appendTo('body').fadeIn('fast');
                $popup.addClass('open');
                $(".tt-hamburger").addClass('active');
                $body.addClass('page-popup-open');
                $("html").addClass("no-scroll sidebar-open").height(window.innerHeight + "px");
            });

            $("#page-close-main-menu, .mask-overlay").on('click', function (e) {
                e.preventDefault();
                $('.mask-overlay').remove();
                $body.removeClass('page-popup-open');
                $popup.removeClass('open');
                $('.sub-menu, .sub-menu-wide').removeAttr('style');
                $("html").removeClass("no-scroll sidebar-open").height("auto");
                $(".tt-hamburger").removeClass('active');
                $('.sub-menu, .sub-menu-wide').removeAttr('style');
                $('.has-submenu .menu-link').removeClass('active');
            });

            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: false,
                live: true,
                scrollContainer: null
            });
            wow.init();

            if ($("#wpadminbar").length && $(window).width() < 768) {
                $("#wpadminbar").css({
                    position: "fixed",
                    top: "0"
                })
            }

            /* Magnefic Popup */
            $('.play-button, .popup-play-btn').each(function () {
                $('.play-button, .popup-play-btn').magnificPopup({
                    type: 'iframe'
                });
            });

            if ($('.sticky-sidebar').length) {
                $('body').addClass('sticky-sidebar_init');
                $('.sticky-sidebar').each(function() {
                    $(this).theiaStickySidebar({
                        additionalMarginTop: 140,
                        additionalMarginBottom: 30
                    });
                });
            }

            if ($('.sticky_layout .info-wrapper').length) {
                $('.sticky_layout .info-wrapper').each(function() {
                    $(this).theiaStickySidebar({
                        additionalMarginTop: 120,
                        additionalMarginBottom: 120
                    });
                });
            }

            $('.quantity .input-text').keyup(function () {
                var $button = $(this).parent().next().next(),
                    $max = parseInt($(this).attr('max')),
                    $val = parseInt($(this).val());
                if ($val <= $max) {
                    $button.attr('data-quantity', $val);
                }
            });

            $('body').on('click', '.quantity .plus-button', function (e) {
                var $input = $(this).parent().parent().find('input.input-text'),
                    $quantity = parseInt($input.attr('max')),
                    $step = parseInt($input.attr('step')),
                    $val = parseInt($input.val()),
                    $button = $(this).parent().parent().next().next();
                if (($quantity !== '') && ($quantity <= $val + $step)) {
                    $('.quantity .plus-button').css('pointer-events', 'none');
                }
                if ($val + $step > $quantity) return;
                $input.val($val + $step);

                $input.trigger('change');
                if ($('.btn-atc').hasClass('atc-popup')) {
                    $button.attr('data-quantity', $val + $step);
                }
            });

            $('body').on('click', '.quantity .minus-button', function (e) {
                var $input = $(this).parent().parent().find('input.input-text'),
                    $step = parseInt($input.attr('step')),
                    $val = parseInt($input.val()) - $step,
                    $button = $(this).parent().parent().next().next();

                if ($val < $step) $val = $step;
                $input.val($val);

                $('.quantity .plus-button').removeAttr('style');

                $input.trigger('change');
                if ($('.btn-atc').hasClass('atc-popup')) {
                    $button.attr('data-quantity', $val);
                }
            });
        },


        /*===========================================*/
        /*=           handle Mobile Header          =*/
        /*===========================================*/

        handleMobileHeader: function () {

            if (TT.header && TT.header.length) {

                if (TT.isMobileMenu) {
                    TT.header.addClass('mobile-header');
                    TT.body.addClass('is-mobile-menu');
                    setTimeout(function () {
                        $('.main-nav').addClass('unhidden');
                    }, 300);
                } else {
                    TT.header.removeClass('mobile-header');
                    TT.body.removeClass('is-mobile-menu');
                    $('.main-nav').addClass('visible');
                }
            }
        },

        /*==========================================*/
        /*=           handle Fixed Header          =*/
        /*==========================================*/

        handleFixedHeader: function () {

            TT.init();
            var fixed = TT.headerFixed;

            if ($(document).scrollTop() > fixed.initialOffset) {

                if ((!TT.isMobileMenu && fixed.enabled && !fixed.value) ||
                    (TT.isMobileMenu && fixed.mobileEnabled && !fixed.mobileValue)) {

                    if (TT.isMobileMenu) {
                        fixed.mobileValue = true;
                    } else {
                        fixed.value = true;
                    }

                    TT.header.addClass('header-fixed no-transition');

                }

            } else if (fixed.value || fixed.mobileValue) {

                fixed.value = false;
                fixed.mobileValue = false;

                TT.header.removeClass('header-fixed');

            }

            // Effect appearance
            if ($(document).scrollTop() > fixed.initialOffset + 50) {
                TT.header.removeClass('no-transition').addClass('showed');
            } else {
                TT.header.removeClass('showed').addClass('no-transition');
            }
        },

        /*==================================*/
        /*=           Progressbar          =*/
        /*==================================*/
        progressBar: function () {
            if ($('.skill-wrapper').length) {
                $('.skills').not('.active').each(function () {
                    if ($(window).scrollTop() >= $(this).offset().top - $(window).height() * 1) {
                        $(this).addClass('active');
                        $(this).find('.skill').each(function () {
                            var procent = $(this).attr('data-value');
                            $(this).find('.active-line').css('width', procent + '%');
                        });
                    }
                });
            }
        },

        /*====================================*/
        /*=           Swiper Slider          =*/
        /*====================================*/

        swiperSlider: function () {
            $('.tt-portfolio-related').each(function () {
                var swiper = new Swiper('.tt-portfolio-related', {
                    slidesPerView: 3,
                    spaceBetween: 30,
                    loop: true,
                    speed: 800,
                    autoplay: {
                        delay: 2000,
                    },
                    pagination: {
                        el: '.portfolio-pagination',
                        clickable: true,
                    },
                });
            });
        },

        /*=====================================*/
        /*=           Section Switch          =*/
        /*=====================================*/

        sectionSwitch: function () {
            $('.page-scroll, .site-header .menu li a').on('click', function () {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    if (target.length > 0) {

                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        $('html,body').animate({
                            scrollTop: target.offset().top - 130
                        }, 1000);
                        return false;
                    }
                }
            });
        },

        /*==============================*/
        /*=           Countup          =*/
        /*==============================*/

        countUp: function () {
            var options = {
                useEasing: true,
                useGrouping: true,
                separator: ',',
                decimal: '.',
                prefix: '',
                suffix: ''
            };

            var counteEl = $('[data-counter]');

            if (counteEl) {
                counteEl.each(function () {
                    var val = $(this).data('counter');

                    var countup = new CountUp(this, 0, val, 0, 2.5, options);
                    $(this).appear(function () {
                        countup.start();
                    }, {
                        accX: 0,
                        accY: 0
                    })
                });
            }
        },

        /*=================================*/
        /*=           Google Map          =*/
        /*=================================*/

        googleMap: function () {
            $('.gmap3-area').each(function () {
                var $this = $(this),
                key = $this.data('key'),
                lat = $this.data('lat'),
                lng = $this.data('lng'),
                mrkr = $this.data('mrkr'),
                zoom = $this.data('zoom'),
                scrollwheel = $this.data('scrollwheel') || false;

                $this.gmap3({
                    center: [lat, lng],
                    zoom: zoom,
                    scrollwheel: scrollwheel,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: [
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#e9e9e9"
                                },
                                {
                                    "lightness": 17
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f5f5f5"
                                },
                                {
                                    "lightness": 20
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 17
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 29
                                },
                                {
                                    "weight": 0.2
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 18
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 16
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f5f5f5"
                                },
                                {
                                    "lightness": 21
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#dedede"
                                },
                                {
                                    "lightness": 21
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 16
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "saturation": 36
                                },
                                {
                                    "color": "#333333"
                                },
                                {
                                    "lightness": 40
                                }
                            ]
                        },
                        {
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f2f2f2"
                                },
                                {
                                    "lightness": 19
                                }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#fefefe"
                                },
                                {
                                    "lightness": 20
                                }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#fefefe"
                                },
                                {
                                    "lightness": 17
                                },
                                {
                                    "weight": 1.2
                                }
                            ]
                        }
                    ]
                })
                .marker(function (map) {
                    return {
                        position: map.getCenter(),
                        icon: mrkr
                    };
                })

            });

        },

        /*=================================*/
        /*=           Contact Form         =*/
        /*=================================*/
        contactFrom: function () {
            $('[data-tt-form]').each(function () {
                var $this = $(this);
                $('.form-result', $this).css('display', 'none');

                $this.submit(function () {
                    $('button[type="submit"]', $this).addClass('clicked');
                    // Create a object and assign all fields name and value.
                    var values = {};

                    $('[name]', $this).each(function () {
                        var $this = $(this),
                        $name = $this.attr('name'),
                        $value = $this.val();
                        values[$name] = $value;
                    });

                    // Make Request
                    $.ajax({
                        url: $this.attr('action'),
                        type: 'POST',
                        data: values,
                        success: function success(data) {

                            if (data.error == true) {
                                $('.form-result', $this).addClass('alert-warning').removeClass('alert-success alert-danger').css('display', 'block');
                            } else {
                                $('.form-result', $this).addClass('alert-success').removeClass('alert-warning alert-danger').css('display', 'block');
                            }
                            $('.form-result > .content', $this).html(data.message);
                            $('button[type="submit"]', $this).removeClass('clicked');
                        },
                        error: function error() {
                            $('.form-result', $this).addClass('alert-danger').removeClass('alert-warning alert-success').css('display', 'block');
                            $('.form-result > .content', $this).html('Sorry, an error occurred.');
                            $('button[type="submit"]', $this).removeClass('clicked');
                        }
                    });
                    return false;
                });

            });
        }
    };

    THEMETAGS.documentOnReady = {
        init: function () {
            THEMETAGS.initialize.init();

        },
    };

    THEMETAGS.documentOnLoad = {
        init: function () {
            TT.init();
            THEMETAGS.initialize.handleMobileHeader();
            $("#preloader").fadeOut("slow");
        },
    };

    THEMETAGS.documentOnResize = {
        init: function () {
            if ($("#wpadminbar").length && $(window).width() < 768) {
                $("#wpadminbar").css({
                    position: "fixed",
                    top: "0"
                })
            }
            TT.resize();
            THEMETAGS.initialize.handleMobileHeader();
            THEMETAGS.initialize.handleFixedHeader();
        },
    };

    THEMETAGS.documentOnScroll = {
        init: function () {
            THEMETAGS.initialize.handleFixedHeader();
            // THEMETAGS.initialize.progressBar();
        },
    };

    // Initialize Functions
    $(document).ready(THEMETAGS.documentOnReady.init);
    $(window).on('load', THEMETAGS.documentOnLoad.init);
    $(window).on('resize', THEMETAGS.documentOnResize.init);
    $(window).on('scroll', THEMETAGS.documentOnScroll.init);

})(jQuery);

