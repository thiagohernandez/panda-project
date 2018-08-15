
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
            sliderLayout:"auto",
            delay:9000,
            autoPlay: "off",
            navigation: {
                touch: {
                    touchenabled: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                }
            },
            responsiveLevels:[1550,960,778,480],
            visibilityLevels:[1550,960,778,480],
            gridwidth:[1550,960,778,480],
            gridheight:[868,1020,900,820],
            parallax: {
                type:"3D",
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
