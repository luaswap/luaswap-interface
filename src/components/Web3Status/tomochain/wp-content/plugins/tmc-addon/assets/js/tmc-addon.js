( function( $ ) {
    "use strict";
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var EventSlick = function( $scope, $ ) {
        $scope.find('.tmc-events-widget').css( 'opacity','1' );
        var items = $scope.find('.tmc-event-dots').data('item');
        $scope.find('.tmc-event-dots').slick({
            vertical: true,
            focusOnSelect: true,
            asNavFor: '.tmc-event-content',
            slidesToShow: items != '' ? parseInt(items) : 4,
            slidesToScroll: 1,
            verticalSwiping: true,
            infinite: false,
            centerMode: true,
            centerPadding: '0px',
            // autoplay: true,
            // autoplaySpeed: 5000,
            speed: 1000,
            arrows: false,
            // prevArrow:'<i class="fas fa-angle-double-up"></i>',
            // nextArrow: '<i class="fas fa-angle-double-down"></i>'
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        verticalSwiping: false,
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: '25px',
                        arrows: true,
                        vertical: false,
                        prevArrow:'<div class="event-arrows-back fas fa-chevron-left"></div>',
                        nextArrow: '<div class="event-arrows-next fas fa-chevron-right"></div>'
                    }
                }
            ]
        });
        $scope.find('.tmc-event-content').slick({
            dots: false,
            // autoplay: true,
            // autoplaySpeed: 5000,
            asNavFor: '.tmc-event-dots',
            speed: 1000,
            fade: true,
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
        //remove active class from all thumbnail slides
        var $new_dot = $scope.find('.tmc-event-dots .slick-slide')
        $new_dot.removeClass('slick-active');

        //set active class to first thumbnail slides
        $new_dot.eq(0).addClass('slick-active');

         // On before slide change match active thumbnail to current slide
        $scope.find('.tmc-event-content').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var mySlideNumber = nextSlide;
            $new_dot.removeClass('slick-active');
            $new_dot.eq(mySlideNumber).addClass('slick-active');
        });
    };
    var PressSlick = function( $scope, $ ) {
        $scope.find('.tmc-press-content').slick({
            rows: 2,
            dots: true,
            slidesToShow: 2,
            slidesToScroll: 2,
            speed: 1000,
            arrows: false,
            customPaging: function(slider, i) {
              // this example would render "tabs" with titles
              return '<span class="dot"></span>';
            },
            // prevArrow:'<i class="fas fa-angle-double-up"></i>',
            // nextArrow: '<i class="fas fa-angle-double-down"></i>'
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    };

    var PublicationSlick = function( $scope, $ ) {
        $scope.find('.tmc-publication-widget').css( 'opacity','1' );
        $scope.find('.tmc-publication-content').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            speed: 1000,
            arrows: false,
            // prevArrow:'<span class="tmc-prev"><i class="fas fa-angle-left"></i></span>',
            // nextArrow: '<span class="tmc-next"><i class="fas fa-angle-right"></i></span>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 560,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    };

    var UsecaseSlick = function( $scope, $ ) {
        $scope.find('.tmc-usecase-widget').css( 'opacity','1' );
        $scope.find('.tmc-usecase-content').slick({
            rows: 2,
            dots: true,
            slidesToShow: 2,
            slidesToScroll: 2,
            speed: 1000,
            arrows: false,
            customPaging: function(slider, i) {
              // this example would render "tabs" with titles
              return '<span class="dot"></span>';
            },
            // prevArrow:'<i class="fas fa-angle-double-up"></i>',
            // nextArrow: '<i class="fas fa-angle-double-down"></i>'
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    };

    //slider developer-hub
    var DeveloperSlick = function( $scope, $ ) {
        $scope.find('.tmc-developerhub-technology-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            speed: 1000,
            arrows: true,
            autoplay: true,
            prevArrow:'<i class="tmc-arrow-left fas fa-angle-left"></i>',
            nextArrow: '<i class="tmc-arrow-right fas fa-angle-right"></i>',
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    };

    //slider homepage Build-On-TomoChain
    var SliderSwiper = function( $scope, $ ){
        new Swiper(".tmc-slider-widget", {
            loop: !0,
            effect: "fade",
            speed: 1e3,
            fadeEffect: {
                crossFade: !0
            },
            autoplay: {
                delay: 3e3
            },
            pagination: {
                el: ".swiper-pagination",
                type: "bullets",
                clickable: !0,
                renderBullet: function(e, t) {
                    var a = document.getElementById("tab-" + (e + 1));
                    return '<span class="' + t + '" style="color: ' + a.getAttribute("data-color") + ';"><span class="swiper-pagination-bg" style="background: ' + a.getAttribute("data-color") + '"></span><span class="swiper-pagination-letter">' + a.getAttribute("data-letter") + "</span></span>"
                }
            }
        });
        for (var e = document.querySelectorAll(".swiper-pagination-bullet"), t = 0; t < e.length; t++) e[t].addEventListener("click", (function() {
            this.classList.add("swiper-pagination-bullet-active-click")
        }));
    };
    //slider on Enterprise page
    var EnSliderSwiper = function( $scope, $ ){
        new Swiper(".tmc-en-slider-widget", {
            loop: !0,
            effect: "fade",
            speed: 1e3,
            fadeEffect: {
                crossFade: !0
            },
            autoplay: {
                delay: 3e3
            },
            pagination: {
                el: ".swiper-pagination",
                type: "bullets",
                clickable: !0,
                renderBullet: function(e, t) {
                    var a = document.getElementById("tab-" + (e + 1));
                    return '<span class="' + t + '" style="color: ' + a.getAttribute("data-color") + ';"><span class="swiper-pagination-bg" style="background: ' + a.getAttribute("data-color") + '"></span><span class="swiper-pagination-letter">' + a.getAttribute("data-letter") + "</span></span>"
                }
            }
        });
        for (var e = document.querySelectorAll(".swiper-pagination-bullet"), t = 0; t < e.length; t++) e[t].addEventListener("click", (function() {
            this.classList.add("swiper-pagination-bullet-active-click")
        }));
    };
    var Countdown = function( $scope, $ ){
        var clock = $scope.find('#tmc-clock').attr('data-date');
        var data_text = $scope.find('#tmc-clock').attr('data-text');
        data_text = JSON.parse(data_text);
        if(clock){
            $scope.find('#tmc-clock').countdown(clock, function(event) {
                var $this = $(this).html(event.strftime(''
                    + '<div><span class="item day">%D</span> <span class="text">'+ data_text['day'] +'</span></div>'
                    + '<div><span class="item hour">%H</span> <span class="text">'+ data_text['hour'] +'</span></div> '
                    + '<div><span class="item min">%M</span> <span class="text">'+ data_text['min'] +'</span></div> '
                    + '<div><span class="item sec">%S</span> <span class="text">'+ data_text['sec'] +'</span></div>'));
            });
        }
    };
    var stakeProfit = function($scope, $){
        var per_profit = $scope.find('.tmc-stake-profit-form').attr('data-profit');
        $scope.find('#tmc-amount').keyup(function(){
            var tomo_own = $(this).val();
            var number_profit = '';
            if(tomo_own > 0){
                number_profit = tomo_own*per_profit/100;
            }
            
            $(this).closest('.tmc-stake-profit-form').find('#tmc-profit').val(number_profit);
        });
    };

    var tutorialTab = function($scope, $){
        var tutorialTab = function($scope, $){
            $scope.find('.tx-heading').on('click', function(){
                if($(this).hasClass('active')){
                    $scope.find('.tx-tab-list').slick({
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    speed: 1000,
                    arrows: true,
                    autoplay: true,
                    prevArrow:'<i class="tmc-arrow-left fas fa-angle-left"></i>',
                    nextArrow: '<i class="tmc-arrow-right fas fa-angle-right"></i>',
                    responsive: [
                        {
                            breakpoint: 1025,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                            }
                        }
                    ]
                });
            }
        })};

        $scope.find('.tx-tab-list .tx-tab-item').first().addClass('tab-active');
        $scope.find('.tx-tab-content-item').first().show();
        $scope.find('.tx-tab-list').on('click', 'a', function(e){
            e.preventDefault();

            var id = $(this).attr('href');

            $('.tx-tab-list .tx-tab-item').removeClass('tab-active');
            $(this).addClass('tab-active');

            $scope.find('.tx-tab-content-item').hide();
            $(id).show();
        })
    }

    var buttonPopup = function($scope, $){        
        $scope.find('.button-link').each(function(){
            var popup = $(this).attr('data-type');
            if(typeof popup !== 'undefined'){
                $(this).on('click', function(e){
                    e.preventDefault();
                    popup = $(this).attr('data-type');
                    $(popup).show();
                });
                $scope.find('.tmc-close-popup').on('click', function(e){
                    e.preventDefault();
                    var close = $(this).attr('data-type');
                    $(close).hide();
                });
            }
        });
        
    }
    var roadMap = function($scope, $){

        if ( $( '.tmc-roadmap-filter' ).length > 0) {
            var $default = $('.tmc-roadmap-filter li').first().find('a').attr('data-desc');
            $('.tmc-roadmap-head').find('.tmc-term-desc').html($default);
            $scope.on('click', 'a[data-filter]', function(e){

                e.preventDefault();

                var $_this   = $(this);
                var $wrapper = $('.tmc-roadmap-content');
                var $id      = $_this.attr('data-filter');
                var $desc    = $_this.attr('data-desc');
                $wrapper.addClass('loading');
                $_this.closest('ul').find('.selected').removeClass('selected');
                $_this.parent().addClass('selected');


                var $params    = {
                    'id'  :  $id
                };

                $.ajax({
                    url: tmcAddon.ajax_url,
                    type: 'POST',
                    data: ({
                        action: 'roadmap_ajax',
                        params: $params
                    }),
                    dataType: 'html',

                    success: function ( data ) {
                        $_this.closest('.tmc-roadmap-head').find('.tmc-term-desc').html($desc);
                        $wrapper.removeClass('loading');
                        $wrapper.find('.tmc-roadmap-left').html(data);
                    }
                });
            });
        }
    }

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {

        // elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-post-layout.default', TMCCarousel );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-event.default', EventSlick );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-countdown.default', Countdown );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-press.default', PressSlick );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-publication.default', PublicationSlick );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-usecase.default', UsecaseSlick );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-build.default', DeveloperSlick );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-slider.default', SliderSwiper );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-enterprise-slider.default', EnSliderSwiper );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/stake-profit.default', stakeProfit );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-tutorial-tab.default', tutorialTab );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc_button.default', buttonPopup );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-roadmap.default', roadMap );
    } );

})( jQuery );