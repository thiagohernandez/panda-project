
// Start Window Load Function
$(window).on('load', function() {

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
                sliderLayout:"fullwidth",
                delay:7000,
                navigation: {
                    arrows: {
                        style: "uranus",
                        enable: true,
                        hide_onmobile: true,
                        hide_onleave: true,
                        tmp: '',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 5,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 5,
                            v_offset: 0
                        }
                    },
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    }
                },
                responsiveLevels:[1680,1480,778,480],
                visibilityLevels:[1680,1480,778,480],
                gridwidth:[1680,1480,778,480],
                gridheight:[740,561,561,480],
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

        var revapi2;
        if(tpj("#product_slider").revolution == undefined){
            revslider_showDoubleJqueryError("#product_slider");
        }else{
            revapi2 = tpj("#product_slider").show().revolution({
                sliderType:"standard",
                jsFileLocation:"js/revolutionslider/",
                sliderLayout:"fullscreen",
                delay:70000,
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
                        hide_onmobile: false,
                        style: "hesperiden",
                        hide_onleave: false,
                        direction: "vertical",
                        h_align: "right",
                        v_align: "center",
                        h_offset: 20,
                        v_offset: 0,
                        space: 5,
                        tmp: ''
                    }
                },
                responsiveLevels:[1000,1000,778,480],
                visibilityLevels:[1000,1000,778,480],
                gridwidth:[1000,1000,778,480],
                gridheight:[868,868,800,800],
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
    //  SERVICES SECTION
    //*********************************************

        $('.services-with-tabs #service_items').cubeportfolio({
            filters: '.services-with-tabs #service_filters',
            defaultFilter: '.about',
            animationType: 'fadeOut',
            displayType: 'default',
            gridAdjustment: 'responsive',
            caption: ''
        });

// End Function
});
