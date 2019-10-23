(function (e) {
    "use strict";
    var n = window.TWP_JS || {};
    n.stickyMenu = function () {
        e(window).scrollTop() > 350 ? e("#masthead").addClass("nav-affix") : e("#masthead").removeClass("nav-affix")
    },
        n.mobileMenu = {
            init: function () {
                this.toggleMenu(), this.menuMobile(), this.menuArrow()
            },
            toggleMenu: function () {
                e('#masthead').on('click', '.toggle-menu', function (event) {
                    var ethis = e('.main-navigation .menu .menu-mobile');
                    if (ethis.css('display') == 'block') {
                        ethis.slideUp('300');
                    } else {
                        ethis.slideDown('300');
                    }
                    e('.ham').toggleClass('exit');
                });
                e('#masthead .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                    event.preventDefault();
                    var ethis = e(this),
                        eparent = ethis.closest('li'),
                        esub_menu = eparent.find('> .sub-menu');
                    if (esub_menu.css('display') == 'none') {
                        esub_menu.slideDown('300');
                        ethis.addClass('active');
                    } else {
                        esub_menu.slideUp('300');
                        ethis.removeClass('active');
                    }
                    return false;
                });
            },
            menuMobile: function () {
                if (e('.main-navigation .menu > ul').length) {
                    var ethis = e('.main-navigation .menu > ul'),
                        eparent = ethis.closest('.main-navigation'),
                        pointbreak = eparent.data('epointbreak'),
                        window_width = window.innerWidth;
                    if (typeof pointbreak == 'undefined') {
                        pointbreak = 991;
                    }
                    if (pointbreak >= window_width) {
                        ethis.addClass('menu-mobile').removeClass('menu-desktop');
                        e('.main-navigation .toggle-menu').css('display', 'block');
                    } else {
                        ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                        e('.main-navigation .toggle-menu').css('display', '');
                    }
                }
            },
            menuArrow: function () {
                if (e('#masthead .main-navigation div.menu > ul').length) {
                    e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="fa fa-angle-down">');
                }
            }
        },

        n.TwpReveal = function () {
            e('.icon-search').on('click', function (event) {
                e('body').toggleClass('reveal-search');
            });
            e('.close-popup').on('click', function (event) {
                e('body').removeClass('reveal-search');
            });
        },

        n.TwpWidgetsNav = function () {
            e('#widgets-nav').sidr({
                name: 'sidr-nav',
                side: 'left'
            });

            e('.sidr-class-sidr-button-close').click(function () {
                e.sidr('close', 'sidr-nav');
            });
        },

        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {

                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

        n.InnerBanner = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });
        },

        /* Slick Slider */
        n.SlickCarousel = function () {
            e(".featured-slider").slick({
                slidesToShow: 7,
                slidesToScroll: 1,
                speed: 8000,
                autoplay: true,
                autoplaySpeed: 0,
                cssEase: 'linear',
                nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
                focusOnSelect: true,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 1699,
                        settings: {
                            slidesToShow: 5
                        }
                    },
                    {
                        breakpoint: 1599,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });

            e(".mainbanner-jumbotron-1").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
                dots: true
            });

            e(".mainbanner-jumbotron-2").slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                centerMode: true,
                centerPadding: '60px',
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 678,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });


            e(".twp-slider-widget").each(function() {
                e(this).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    autoplay: true,
                    autoplaySpeed: 8000,
                    infinite: true,
                    nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                    prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>'
                });
            });

            e(".twp-carousal-widget").each(function() {
                e(this).slick({
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    focusOnSelect: true,
                    dots: true,
                    arrows: false,
                    responsive: [
                        {
                            breakpoint: 1599,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            });

            e(".wp-block-gallery.columns-1, .gallery-columns-1").each(function() {
                e(this).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    autoplay: true,
                    autoplaySpeed: 8000,
                    infinite: true,
                    nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                    prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
                    dots: true
                });
            });
        },

        n.MagnificPopup = function () {
            e('.widget .gallery, .entry-content .gallery, .wp-block-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                image: {
                    verticalFit: true,
                    titleSrc: function (item) {
                        return item.el.attr('title');
                    }
                },
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function (element) {
                        return element.find('img');
                    }
                }
            });
        },

        n.twp_preloader = function () {
            e(window).load(function () {
                e("body").addClass("page-loaded");
            });
        },

        n.InnerBanner = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });
        },

        n.twp_matchheight = function () {
            jQuery('.widget-area').theiaStickySidebar({
                additionalMarginTop: 30
            });
        },

        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#scroll-up").fadeIn(300);
            } else {
                e("#scroll-up").fadeOut(300);
            }
        },

        n.scroll_up = function () {
            e("#scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        },

        e(document).ready(function () {
            n.mobileMenu.init(), n.TwpReveal(), n.TwpWidgetsNav(), n.DataBackground(), n.InnerBanner(), n.SlickCarousel(), n.MagnificPopup(), n.twp_preloader(), n.twp_matchheight(), n.scroll_up();
        }), e(window).scroll(function () {
        n.stickyMenu(), n.show_hide_scroll_top();
    }), e(window).resize(function () {
        n.mobileMenu.menuMobile();
    })
})(jQuery);