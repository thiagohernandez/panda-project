
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
                delay:9000,
                navigation: {
                    arrows: {
                        style: "erinyen",
                        enable: true,
                        hide_onmobile: true,
                        hide_onleave: true,
                        tmp: '<div class="tp-title-wrap">   <div class="tp-arr-imgholder"></div>    <div class="tp-arr-img-over"></div> <span class="tp-arr-titleholder">{{title}}</span> </div>',
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
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    }
                },
                responsiveLevels:[1280,1024,778,480],
                visibilityLevels:[1280,1024,778,480],
                gridwidth:[1280,1024,778,480],
                gridheight:[640,561,561,480],
                parallax: {
                    type:"3D",
                    origo:"slidercenter",
                    speed:1000,
                    levels:[1,3,5,10,25,30,5,0,45,50,47,48,49,50,51,55],
                    ddd_shadow:"off",
                    ddd_bgfreeze:"on",
                    ddd_overflow:"hidden",
                    ddd_layer_overflow:"visible",
                    ddd_z_correction:155
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

        // init cubeportfolio
        $('#work-items').cubeportfolio({
            layoutMode: 'slider',
            defaultFilter: '*',
            animationType: 'fadeOutTop',
            gapHorizontal: 0,
            gapVertical: 0,
            autoPauseOnHover: false,
            auto: true,
            autoTimeout: 3000,
            drag: true,
            showNavigation: true,
            showPagination: false,
            rewindNav: false,
            scrollByPage: false,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1500,
                cols: 4,
            }, {
                width: 1100,
                cols: 3,
            }, {
                width: 640,
                cols: 2,
            }, {
                width: 480,
                cols: 1,
                options: {
                    caption: '',
                }
            }],
            caption: 'zoom',
            displayType: 'fadeIn',
            displayTypeSpeed: 100,
        });


    //*********************************************
    //  Works on QDR Modal
    //*********************************************
        // init cubeportfolio
        $('#works-without-images').cubeportfolio({
            filters: '#works-without-images-filters',
            layoutMode: 'masonry',
            defaultFilter: '*',
            animationType: 'scaleSides',
            gapHorizontal: 10,
            gapVertical: 10,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1500,
                cols: 4,
            }, {
                width: 1100,
                cols: 3,
            }, {
                width: 640,
                cols: 2,
            }, {
                width: 480,
                cols: 1,
                options: {
                    gapHorizontal: 15,
                    gapVertical: 15,
                }
            }],
            caption: 'zoom',
            displayType: 'fadeIn',
            displayTypeSpeed: 400,
        });



// End Function
});
