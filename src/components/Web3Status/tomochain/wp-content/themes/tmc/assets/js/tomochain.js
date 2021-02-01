(function ($) {
    "use strict";
    var TMC = TMC || {};
    var $window = $(window),
        $body = $('body'),
        isRTL = $body.hasClass('rtl') ? true : false,
        deviceAgent = navigator.userAgent.toLowerCase(),
        isMobile = deviceAgent.match(/(iphone|ipod|android|iemobile)/),
        isMobileAlt = deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/),
        isAppleDevice = deviceAgent.match(/(iphone|ipod|ipad)/),
        isIEMobile = deviceAgent.match(/(iemobile)/);
    TMC = {
        init: function(){
            TMC.header();
            // TMC.mainMenu();
            TMC.mobileMenu();
            TMC.video();
            TMC.click();
            TMC.tomoProduct();
            TMC.countdown();
            TMC.tomoxaccordion();
            
        },
        header: function(){
            // $('.site-header').headroom();

            // if($('.site-header').length > 0){
            //     var height = $('.site-header').outerHeight();
            //     $('.site-header').css('min-height',height);
            // }

            // $(window).scroll(function() {    // this will work when your window scrolled.
            //     var height = $(window).scrollTop();  //getting the scrolling height of window
            // });

            $(window).on('load', function() {
                setTimeout(function (){
                    var navScrollListener = function(_this, navTopScroll) {
                        var _this = $('#masthead');
                        var scrollTop = $(window).scrollTop();
                        if (($(window).scrollTop()) > navTopScroll) {
                            if (!$('#masthead').hasClass('scrollFixed')) {
                                _this.addClass('scrollFixed')
                            }
                        } else {
                            _this.removeClass('scrollFixed')
                        }
                    };
                    var navTopScroll = 0;
                    var navScrollEl = $('.site');
                    if (navScrollEl.length) {
                        navTopScroll = navScrollEl.offset().top;
                        navScrollListener(navScrollEl, navTopScroll);
                        $(window).on('resize scroll', function() {
                            navScrollListener(navScrollEl, navTopScroll);
                        });
                    }
                });
            });
        },
        mainMenu: function() {
            var $siteHeader   = $( '.site-header:not(.sticky-header)' ),
            $stickyHeader = $( '.site-header.sticky-header' ),
            $mainMenu     = $siteHeader.find( '.main-menu' );

            if ( $stickyHeader.hasClass( 'is-sticky' ) ) {
                $mainMenu = $stickyHeader.find( '.main-menu' );
            }

            if ( ! $mainMenu.length && ! $mainMenu.find( 'ul.menu' ).length ) {
                return;
            }

            $mainMenu.find('ul.menu').superfish({
                delay       : 300,
                speed       : 300,
                speedOut    : 300,
                autoArrows  : false,
                dropShadows : false,
                onBeforeShow: function() {
                    $( this ).removeClass( 'animated fast fadeOutDownSmall' );
                    $( this ).addClass( 'animated fast fadeInUpSmall' );
                },
                onBeforeHide: function() {
                    $( this ).removeClass( 'animated fast fadeInUpSmall' );
                    $( this ).addClass( 'animated fast fadeOutDownSmall' );
                }
            });
        },
        setTopValue: function ($el) {
            var $adminBar = $( '#wpadminbar' ),
                w         = $window.width(),
                h         = $adminBar.height(),
                top       = h;

            if ( $adminBar.length ) {
                var t = $adminBar[0].getBoundingClientRect().top;
                top = (t >= 0 - h) ? h + t : 0;
            }

            if ( $el.closest( '.sticky-header.is-sticky' ).length ) {
                top = 0;
            }

            $el.css( 'top', top );
        },
        mobileMenu: function () {
            var $mobileBtn      = $( '.mobile-menu-btn' ),
                $mobileMenu     = $( '#site-mobile-menu' ),
                $mobileMenuWrap = $( '.site-mobile-menu-wrapper' ),
                $siteContent    = $( '#content.site-content' );

            var caculateRealHeight = function( $ul ) {
                var height = 0;

                $ul.find( '>li' ).each( function() {
                    height += $( this ).outerHeight();
                } );

                return height;
            };

            var setUpOverflow = function( h1, h2 ) {
                if ( h1 < h2 ) {
                    $mobileMenuWrap.css( 'overflow-y', 'hidden' );
                } else {
                    $mobileMenuWrap.css( 'overflow-y', 'auto' );
                }
            };

            var buildSlideOut = function() {
                if ( typeof $mobileMenu !== 'undefined' && typeof $siteContent !== 'undefined' ) {
                    $mobileBtn.on( 'click', function() {
                        $( this ).toggleClass( 'is-active' );
                        $('body').toggleClass( 'mobile-menu-opened' );
                        TMC.setTopValue( $mobileMenuWrap );
                    } );

                    // Close menu if click on the site
                    $siteContent.on( 'click touchstart', function( e ) {
                        if ( ! $( e.target ).closest( '.mobile-menu-btn' ).length ) {
                            if ( $body.hasClass( 'mobile-menu-opened' ) ) {
                                $body.removeClass( 'mobile-menu-opened' );
                                $mobileBtn.removeClass( 'is-active' );
                                $mobileMenu.find( '#searchform input[type="text"]' ).blur();
                                e.preventDefault();
                            }
                        }
                    } );

                    setUpOverflow( $mobileMenu.height(), $mobileMenuWrap.height() );
                }
            };

            var buildDrillDown = function() {
                var level  = 0,
                    opener = '<span class="open-child">open</span>',
                    height = $mobileMenuWrap.height();

                $mobileMenu.find( 'li:has(ul)' ).each( function() {
                    var $this   = $( this ),
                        allLink = $this.find( '> a' ).clone();

                    if ( allLink.length ) {
                        $this.prepend( opener );
                        allLink.find( '.menu-item-tag' ).remove();
                        $this.find( '> ul' )
                                .prepend( '<li class="menu-back">' + allLink.wrap( '<div>' )
                                                                            .parent()
                                                                            .html() + '</a></li>' );
                    }
                } );

                $mobileMenu.on( 'click', '.open-child', function() {
                    var $parent = $( this ).parent();

                    if ( $parent.hasClass( 'over' ) ) {
                        $parent.removeClass( 'over' );
                        level --;
                        if ( level == 0 ) {
                            setUpOverflow( $mobileMenu.height(), height );
                        }
                    } else {
                        $parent.parent().find( '>li.over' ).removeClass( 'over' );
                        $parent.addClass( 'over' );
                        level ++;
                        setUpOverflow( caculateRealHeight( $parent.find( '>.sub-menu' ) ), height );
                    }

                    $mobileMenu.parent().scrollTop( 0 );
                } );

                $mobileMenu.on( 'click', '.menu-back', function() {
                    var $grand = $( this ).parent().parent();
                    if ( $grand.hasClass( 'over' ) ) {
                        $grand.removeClass( 'over' );
                        level --;

                        if ( level == 0 ) {
                            setUpOverflow( $mobileMenu.height(), height );
                        }
                    }

                    $mobileMenu.parent().scrollTop( 0 );
                } );

                $mobileMenu.on( 'click', '.menu-back > a', function(e) {
                    e.preventDefault();
                });
            };

            buildSlideOut();
            buildDrillDown();

            // re-calculate the top value of mobile menu when resize
            $window.on( 'resize', function() {
                TMC.setTopValue( $mobileMenuWrap );
            } );
        },
        video: function() {

            var $videos = $('.tmc-videos');

            if (!$videos.length) {
                return;
            }

            $videos.flipster({
                style: 'flat',
                spacing: -0.45,
                keyboard: false,
                scrollwheel: false
            });

            $('.tmc-video-item .video-link').magnificPopup({
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false
            });
        },
        click: function(){
            if($('.tmc-top-report').length > 0){
                var height = $('.tmc-top-report').outerHeight();
                // $('.tmc-top-report').css('height',height);
                $('.tmc-top-report').find('.close').on('click', function(e){
                    e.preventDefault();
                    $(this).closest('.tmc-top-report').hide(500);
                });
            }
            if($('.tmc-tab-title').length > 0){
                $('.tab-content').first().show(200);
                $('.tmc-tab-title').find('a').on('click', function(e){
                    e.preventDefault();
                    $('.tmc-tab-title').find('li').removeClass('active');
                    $(this).parent().addClass('active');
                    var id = $(this).attr('href');
                    $('.tab-content').hide(200);
                    $(id).show(200);

                });
            }
        },

        tomoProduct: function(){
            if($('.tmc-layer-widget').length > 0){
                if($('.tmc-layer-widget.default').length > 0){
                    var show_Content = $('.tmc-layer-content a:nth-child(2)').attr('href');
                    $('.tmc-layer-content a:nth-child(2)').addClass('active');
                    $(show_Content).addClass('s-active');
                }else{
                    $('.tmc-layer-content a').first().addClass('active');
                    $('.section-layer').first().addClass('s-active');
                }
                $('.tmc-layer-widget').on('click', 'a', function(e){
                    e.preventDefault();
                    if($('.tmc-layer-widget.enterprise').length > 0){
                        e.stopPropagation();
                    }
                    var a = $(this).attr('id');
                    $('.tmc-layer-widget a').removeClass('active');
                    $('.tmc-layer-widget').find('#'+a).addClass('active');
                    var id = $($(this).attr('href'));
                    $('.section-layer').removeClass('s-active');
                    id.addClass('s-active');
                });
            }

        },
        countdown: function(){
            if($('.tmc-countdown-shortcode').length > 0){
                $('.tmc-clock-shortcode').each(function(){
                    var clock = $(this).attr('data-date');
                    var data_text = $(this).attr('data-text');
                    data_text = JSON.parse(data_text);
                    if(clock){
                        $(this).countdown(clock, function(event) {
                            var $this = $(this).html(event.strftime(''
                                + '<div><span class="item day">%D</span> <span class="text">'+ data_text['day'] +'</span></div>'
                                + '<div><span class="item hour">%H</span> <span class="text">'+ data_text['hour'] +'</span></div> '
                                + '<div><span class="item min">%M</span> <span class="text">'+ data_text['min'] +'</span></div> '
                                + '<div><span class="item sec">%S</span> <span class="text">'+ data_text['sec'] +'</span></div>'));
                        });
                    }
                });
            }
        },
        tomoxaccordion: function(){
            if($('.tx-accordion').length > 0){
                $('.tx-accordion').on('click', function(){
                    $(this).toggleClass('active');
                    $(this).next().toggle(0);
                })
            }
        }
    }

    $(document).ready(function() {
        TMC.init();
    })
    $(document).ready(function() {
        $('.reportFade').slick({
            dots: false,
            infinite: false,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 8000,
            slidesToShow: 2,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    })


})(jQuery);

