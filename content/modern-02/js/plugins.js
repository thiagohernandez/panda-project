
// Start Function
(function($, window, document, undefined) {

    'use strict';

    //*********************************************
    //  REVOLUTION SLIDER FOR HOME
    //*********************************************

        var tpj = jQuery;
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
                    style: "zeus",
                    enable: true,
                    hide_onmobile: false,
                    hide_onleave: true,
                    tmp: '<div class="tp-arr-imgwrapper"><div class="tp-arr-imgholder"></div></div>',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 15,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 15,
                        v_offset: 0
                    }
                }
            },
                responsiveLevels:[1240,1024,778,480],
                visibilityLevels:[1240,1024,778,480],
                gridwidth:[1240,1024,778,480],
                gridheight:[868,640,480,410],
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
    //  PORTFOLIO OPTIONS
    //*********************************************

        // init cubeportfolio
        $('#portfolio-items').cubeportfolio({
            filters: '#filters',
            layoutMode: 'grid',
            mediaQueries: [{
                width: 1500,
                cols: 4
            }, {
                width: 1100,
                cols: 4
            }, {
                width: 800,
                cols: 2
            }, {
                width: 480,
                cols: 1
            }],
            defaultFilter: '*',
            animationType: 'quicksand',
            gapHorizontal: 0,
            gapVertical: 0,
            gridAdjustment: 'responsive',
            caption: 'zoom',
            displayType: 'sequentially',
            displayTypeSpeed: 50,

        });

        //Alert for filters
        $("#works").waypoint(function(event) {
            $('#filters').toggleClass('works-visible');
        }, {offset: '50%'});

        //Check where i am when click on the filters
        $('#filters .cbp-filter-item').on('click', function(){
            var position = $('#filters').offset().top - $('#works').offset().top,
                max = 700, min = -700;
            if ( position > max || position < min) {
                $('html, body').stop().animate({
                    scrollTop : $('#works').offset().top - 80 + "px"
                }, 1150, 'easeInOutExpo');
            }
        });


// End Function
})(jQuery, window, document);
