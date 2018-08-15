
// Start Window Load Function
$(window).on('load', function() {

    'use strict';

    // Revolution Slider for home page
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
            autoPlay: "off",
            navigation: {
                    keyboardNavigation: "on",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    onHoverStop: "on",
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
                    },
                    bullets: {
                        enable: true,
                        hide_onmobile: false,
                        style: "uranus",
                        hide_onleave: false,
                        direction: "horizontal",
                        h_align: "left",
                        v_align: "bottom",
                        h_offset: 20,
                        v_offset: 20,
                        space: 5,
                        tmp: '<span class="tp-bullet-inner"></span>'
                    }
                },
            responsiveLevels:[1200,960,778,480],
            visibilityLevels:[1200,960,778,480],
            gridwidth:[1200,960,778,480],
            gridheight:[770,630,630,590],
            parallax: {
                type:"scroll",
                speed:3000,
                origo:"slidercenter",
                levels:[5,10,15,20,25,30,35,40,-5,-10,-15,-20,-25,-30,-35,18],
                ddd_shadow:"off",
                ddd_bgfreeze:"off",
                ddd_overflow:"visible",
                ddd_layer_overflow:"hidden",
                ddd_z_correction:10,
                disable_onmobile:"on"
            },
            shadow:0,
            spinner:"off",
            stopLoop:"off",
            stopAfterLoops:0,
            stopAtSlide:1,
            disableProgressBar:"on",
            shuffle:"off",
        });
    }

    // Before After
    $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.5});

    // Works on QDR Modal
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
            cols: 4,
        }, {
            width: 800,
            cols: 3,
        },{
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
