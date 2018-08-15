
// Start Function
(function($, window, document, undefined) {

    'use strict';

    //*********************************************
    //  REVOLUTION SLIDER FOR HOME 
    //*********************************************

        // Start tpj for Rev Slider
        var tpj = jQuery;
        // Home Slider
        var revapi206;
        if (tpj("#home_slider").revolution == undefined) {
            revslider_showDoubleJqueryError("#home_slider");
        } else {
            revapi206 = tpj("#home_slider").show().revolution({
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
                    bullets: {
                            enable: true,
                            hide_onmobile: true,
                            style: "hades",
                            hide_onleave: true,
                            direction: "horizontal",
                            h_align: "right",
                            v_align: "bottom",
                            h_offset: 70,
                            v_offset: 50,
                            space: 7,
                            tmp: '<span class="tp-bullet-image"></span>'
                    }
                },
                responsiveLevels:[1240,1240,778,480],
                visibilityLevels:[1240,1240,778,480],
                gridwidth:[1240,1240,778,480],
                gridheight:[870,640,480,410],
                lazyType:"none",
                parallax: {
                    type:"scroll",
                    origo:"slidercenter",
                    speed:2000,
                    levels:[2,3,4,5,6,7,12,16,10,50],
                },
                shadow:0,
                spinner:"on",
                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,
                disableProgressBar:"on",
                fullScreenAlignForce:"off",
                shuffle:"off",
                hideThumbsOnMobile:"on",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0
            });
        }


    //*********************************************
    //  VIDEO SECTION
    //*********************************************

        var revapi84;
        if(tpj("#page-video").revolution == undefined){
                revslider_showDoubleJqueryError("#page-video");
            }else{
                revapi84 = tpj("#page-video").show().revolution({
                    sliderType:"standard",
                    jsFileLocation:"js/revolutionslider/",
                    sliderLayout:"fullwidth",
                    dottedOverlay:"none",
                    delay:9000,
                    navigation: {
                        onHoverStop:"off",
                    },
                    responsiveLevels:[1240,1024,778,480],
                    visibilityLevels:[1240,1024,778,480],
                    gridwidth:[1240,1024,778,480],
                    gridheight:[700,500,400,270],
                    lazyType:"none",
                    shadow:0,
                    spinner:"off",
                    stopLoop:"off",
                    stopAfterLoops:0,
                    stopAtSlide:1,
                    shuffle:"off",
                    autoHeight:"off",
                    disableProgressBar:"on",
                    hideThumbsOnMobile:"off",
                    hideSliderAtLimit:0,
                    hideCaptionAtLimit:0,
                    hideAllCaptionAtLilmit:0,
                    debugMode:false,

                    fallbacks: {
                        simplifyAll:"off",
                        nextSlideOnWindowFocus:"off",
                        disableFocusListener:false,
                    }
                });
            }


    //*********************************************
    //  PORTFOLIO SCRIPTS
    //*********************************************

        // init cubeportfolio
        $('#portfolio-items').cubeportfolio({
            filters: '#portfolio-filter',
            loadMore: '#portfolio-load-more',
            loadMoreAction: 'click',
            layoutMode: 'grid',
            defaultFilter: '*',
            animationType: 'scaleSides',
            gapHorizontal: 0,
            gapVertical: 0,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1500,
                cols: 4
            }, {
                width: 1100,
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
            singlePageStickyNavigation: true
        });


    //*********************************************
    //  PRICING TABLES SCRIPTS
    //*********************************************

        // init cubeportfolio
        $('#tables').cubeportfolio({
            filters: '#tables-filter',
            loadMore: '#tables-loadmore',
            loadMoreAction: 'click',
            layoutMode: 'grid',
            defaultFilter: '*',
            animationType: 'scaleSides',
            gapHorizontal: 30,
            gapVertical: 0,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1500,
                cols: 1
            }, {
                width: 1100,
                cols: 1
            }, {
                width: 480,
                cols: 1
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
            singlePageStickyNavigation: false,
            singlePageAnimation: 'fade',
        });

       


// End Function
})(jQuery, window, document);