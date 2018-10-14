
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
                onHoverStop: "on",
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
                        style: "uranus",
                        hide_onleave: false,
                        direction: "horizontal",
                        h_align: "center",
                        v_align: "bottom",
                        h_offset: 20,
                        v_offset: 30,
                        space: 5,
                        tmp: '<span class="tp-bullet-inner"></span>'
                    }
                },
                responsiveLevels:[1170,900,641,480],
                visibilityLevels:[1170,900,641,480],
                gridwidth:[1170,900,641,480],
                gridheight:[660,630,630,590],
                parallax: {
                    type:"3D",
                    origo:"slidercenter",
                    speed:1500,
                    levels:[1,2,3,4,5,5,5,3,5,7,9,11,13,15,17,19],
                    ddd_shadow:"off",
                    ddd_bgfreeze:"on",
                    ddd_overflow:"hidden",
                    ddd_layer_overflow:"visible",
                    ddd_z_correction:100,
                },
                shadow:0,
                spinner:"off",
                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,
                disableProgressBar:"on",
                shuffle:"off",
            });
            //Pause for popover videos
            $('.mobile-button').on('click', function(){
                revapi2.revpause();
            });
        }

        //Stop popover videos when revolution slide change
        jQuery('#home_slider').on("revolution.slide.onchange",function (e) {
            $('.home .popover').remove();
        });


    //*********************************************
    //  HEIGHT CALCULATOR FOR LAYERED ITEMS
    //*********************************************

        //Calculate Layer Items
        $('.layered-items').each(function(){
            //Calculator funtion
            $.fn.LayerHeights = function() {
                var container = $(this),
                    layer = $(this).find('.layer'),
                    layerCont = $(this).find('.layer-container'),
                    layerH = $(this).find('.layer-container img').height();
                $(layer).css('height', layerH);
                $(layerCont).css('height', layerH);
            }
            //Run
            $('body').LayerHeights();
            //Run when window resize
            $(window).resize(function(){$('body').LayerHeights();});
        });


    //*********************************************
    //  PORTFOLIO SECTION
    //*********************************************

        $('#works #items').cubeportfolio({
            filters: '#filters',
            loadMore: '#loadmore',
            loadMoreAction: 'click',
            layoutMode: 'grid',
            mediaQueries: [{
                width: 1500,
                cols: 4
            }, {
                width: 800,
                cols: 3
            }, {
                width: 540,
                cols: 2
            }, {
                width: 480,
                cols: 1,
                gapHorizontal: 0,
                gapVertical: 0
            }],
            defaultFilter: '*',
            animationType: '3dflip',
            gapHorizontal: 15,
            gapVertical: 15,
            gridAdjustment: 'responsive',
            caption: 'zoom',
            displayType: 'sequentially',
            displayTypeSpeed: 100,
        });

        //Alert for filters
        $("#works").waypoint(function(event) {
            $('#filters').toggleClass('works-visible');
        }, {offset: '20%'});

        //Check where i am when click on the filters
        $('#filters .cbp-filter-item').on('click', function(){
            var position = $('#filters').offset().top - $('#items').offset().top,
                max = 1200, min = -500;
            if ( position > max || position < min) {
                $('html, body').stop().animate({
                    scrollTop : $('#items').offset().top - 20 + "px"
                }, 1150, 'easeInOutExpo');
            }
        });



    //*********************************************
    //  SERVICES SECTION
    //*********************************************

        $('.services-with-tabs-1 #service_tabs').cubeportfolio({
            filters: '.services-with-tabs-1 #service_filters',
            defaultFilter: '.about',
            animationType: 'fadeOut',
            displayType: 'default',
            gridAdjustment: 'responsive',
            caption: ''
        });

// End Function
});
