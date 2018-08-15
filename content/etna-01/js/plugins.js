
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
                    arrows: {
                        style: "uranus",
                        enable: false,
                        hide_onmobile: true,
                        hide_onleave: true,
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 10,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 10,
                            v_offset: 0
                        }
                    },
                    bullets: {
                        enable: true,
                        hide_onmobile: false,
                        style: "hermes",
                        hide_onleave: false,
                        direction: "vertical",
                        h_align: "right",
                        v_align: "center",
                        h_offset: 20,
                        v_offset: 0,
                        space: 5,
                        tmp: ''
                    },
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    }
                },
                responsiveLevels:[1240,1240,778,480],
                visibilityLevels:[1240,1240,778,480],
                gridwidth:[1240,1240,778,480],
                gridheight:[700,640,480,410],
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
    //  PORTFOLIO SECTION
    //*********************************************

        $('#works #items').cubeportfolio({
            filters: '#works #filters',
            loadMore: '#loadmore',
            loadMoreAction: 'click',
            gridAdjustment: 'responsive',
            layoutMode: 'grid',
            mediaQueries: [{
                width: 1500,
                cols: 4
            }, {
                width: 1100,
                cols: 3
            }, {
                width: 800,
                cols: 2
            }, {
                width: 640,
                cols: 2
            }, {
                width: 480,
                cols: 1,
                gapHorizontal: 0,
                gapVertical: 0
            }],
            defaultFilter: '*',
            animationType: 'quicksand',
            gapHorizontal: 30,
            gapVertical: 30,
            caption: 'zoom',
            displayType: 'sequentially',
            displayTypeSpeed: 100,
        });


    //*********************************************
    //  CATEGORIES SECTION
    //*********************************************

        $('#category-items').cubeportfolio({
            filters: '#category-filter',
            loadMore: '#category-load-more',
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
                width: 1200,
                cols: 4
            }, {
                width: 640,
                cols: 2
            }, {
                width: 480,
                cols: 1
            }],
            caption: 'zoom',
            displayType: 'fadeIn',
            displayTypeSpeed: 400
        });


    //*********************************************
    //  BACKGROUND VIDEO SECTION
    //*********************************************

        var revapi42;
        if(tpj("#background_video").revolution == undefined){
            revslider_showDoubleJqueryError("#background_video");
        }else{
            revapi42 = tpj("#background_video").show().revolution({
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
    //  FAQ OPTIONS ON QUADRA MODAL
    //*********************************************

        // init cubeportfolio
        $('#js-grid-faq').cubeportfolio({
            filters: '#js-filters-faq',
            defaultFilter: '*',
            animationType: 'sequentially',
            gridAdjustment: 'default',
            displayType: 'default',
            caption: 'expand',
            gapHorizontal: 0,
            gapVertical: 0,
        });


// End Function
})(jQuery, window, document);
