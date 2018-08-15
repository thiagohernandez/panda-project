
// Start Function
(function($, window, document, undefined) {

    'use strict';

    //*********************************************
    //  REVOLUTION SLIDER FOR HOME
    //*********************************************

        var tpj=jQuery;
        var revapi2;
        if(tpj("#home_slider").revolution == undefined){
            revslider_showDoubleJqueryError("#home_slider");
        }else{
            revapi2 = tpj("#home_slider").show().revolution({
                sliderType:"standard",
                jsFileLocation:"js/revolutionslider/",
                sliderLayout:"fullscreen",
                delay:9000,
                navigation: {
                    keyboardNavigation: "on",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    onHoverStop: "off",
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "uranus",
                        enable: true,
                        hide_onmobile: false,
                        hide_onleave: false,
                        tmp: '',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 0,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 0,
                            v_offset: 0
                        }
                    }
                },
                responsiveLevels:[1300,1300,769,480],
                visibilityLevels:[1300,1300,769,480],
                gridwidth:[1300,1300,769,480],
                gridheight:[868,640,480,410],
                parallax: {
                    type:"scroll",
                    origo:"slidercenter",
                    speed:2000,
                    levels:[2,3,4,5,8,10,12,16,30],
                },
                shadow:0,
                spinner:"off",
                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,
                disableProgressBar:"on",
                shuffle:"off",
            });
        }


    //*********************************************
    //  HOME ANIMATED CONTENT SCRIPTS
    //*********************************************

        $.fn.homeTexts = function () {
            // Home Text Slider's Position
            if ($(window).scrollTop() > 3) { $('#home .home-socials').addClass('page-note-active'); $('#home .text-slider-container').addClass('active'); }
            else { $('#home .home-socials').removeClass('page-note-active'); $('#home .text-slider-container').removeClass('active'); }
        };
        // Work the function
        $(window).on('scroll resize', function(){
            if ($('body').hasClass('device-lg') || $('body').hasClass('device-xl')) {
                $('body').homeTexts();
            }
        });

    //*********************************************
    //  OPTIONS FOR CATEGORIES SECTION
    //*********************************************

        $('#category-items').cubeportfolio({
            filters: '#category-filter',
            loadMore: '#category-load-more',
            loadMoreAction: 'click',
            defaultFilter: '*',
            animationType: 'scaleSides',
            gapHorizontal: 0,
            gapVertical: 0,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1100,
                cols: 4
            }, {
                width: 800,
                cols: 2
            }, {
                width: 480,
                cols: 2
            }, {
                width: 320,
                cols: 1
            }],
            caption: 'zoom',
            displayType: 'fadeIn',
            displayTypeSpeed: 400,

            // singlePage popup
            singlePageDelegate: '.cbp-singlePage',
            singlePageDeeplinking: true,
            singlePageAnimation: 'fade',
            singlePageStickyNavigation: true,
            singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',

            singlePageCallback: function(url, element) {
                // to update singlePage content use the following method: this.updateSinglePage(yourContent)
                var t = this;

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    timeout: 10000
                })
                .done(function(result) {
                    t.updateSinglePage(result);
                })
                .fail(function() {
                    t.updateSinglePage('AJAX Error! Please refresh the page!');
                });
            },
        });

    //*********************************************
    //  OPTIONS FOR WORKS
    //*********************************************

        $('#work-items').cubeportfolio({
            filters: '#work-filter',
            loadMore: '#work-load-more',
            loadMoreAction: 'click',
            layoutMode: 'grid',
            defaultFilter: '*',
            animationType: 'scaleSides',
            gapHorizontal: 0,
            gapVertical: 0,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1000,
                cols: 4
            }, {
                width: 950,
                cols: 4
            }, {
                width: 480,
                cols: 2
            }, {
                width: 320,
                cols: 1
            }],
            caption: 'zoom',
            displayType: 'fadeIn',
            displayTypeSpeed: 400,

            // singlePage popup
            singlePageDelegate: '.cbp-singlePage',
            singlePageDeeplinking: true,
            singlePageAnimation: 'fade',
            singlePageStickyNavigation: true,
            singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
            singlePageCallback: function(url, element) {
                // to update singlePage content use the following method: this.updateSinglePage(yourContent)
                var t = this;

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    timeout: 10000
                })
                .done(function(result) {
                    t.updateSinglePage(result);
                })
                .fail(function() {
                    t.updateSinglePage('AJAX Error! Please refresh the page!');
                });
            },
        });

    //*********************************************
    //  OPTIONS FOR BACKGROUND VIDEO SECTION
    //*********************************************

        var revapi42;
        if(tpj("#background-video").revolution == undefined){ revslider_showDoubleJqueryError("#background-video"); }
        else{revapi42 = tpj("#background-video").show().revolution({
            sliderType:"hero",
            jsFileLocation:"../../revolution/js/",
            sliderLayout:"fullwidth",
            dottedOverlay:"none",
            delay:9000,
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1240,1024,778,480],
            gridheight:[660,640,560,500],
            lazyType:"none",
            parallax: {
                type:"scroll",
                origo:"enterpoint",
                speed:400,
                levels:[5,10,15,20,25,30,35,40,45,50],
            },
            shadow:0,
            spinner:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false
        });
    }




// End Function
})(jQuery, window, document);
