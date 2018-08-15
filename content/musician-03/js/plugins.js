
// Start Window Load Function
$(window).on('load', function() {

    'use strict';

    //*********************************************
    //  REVOLUTION SLIDER FOR HOME
    //*********************************************

        var tpj=jQuery;
        var revapi1077;
        if(tpj("#home_slider").revolution == undefined){
            revslider_showDoubleJqueryError("#home_slider");
        }else{
            revapi1077 = tpj("#home_slider").show().revolution({
                sliderType:"standard",
                jsFileLocation:"js/revolutionslider/",
                sliderLayout:"fullscreen",
                delay:9000,
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
                gridheight:[868,768,480,380],
                parallax: {
                    type:"mouse",
                    origo:"slidercenter",
                    speed:2000,
                    levels:[2,3,4,5,6,7,12,16,10,50,46,47,48,49,50,55],
                    disable_onmobile:"on"
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
            auto: true,
            autoTimeout: 3000,
            defaultFilter: '*',
            animationType: 'fadeOutTop',
            gapHorizontal: 0,
            gapVertical: 0,
            showNavigation: false,
            showPagination: false,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1500,
                cols: 5,
            }, {
                width: 800,
                cols: 3,
            }, {
                width: 600,
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

            // lightbox
            lightboxDelegate: '.cbp-lightbox',
            lightboxGallery: true,
            lightboxTitleSrc: 'data-title',
        });

    //*********************************************
    //  MUSIC PLAYER SCRIPTS
    //*********************************************

        //Disable scroll when press to space
        $(document).keydown(function(e) {
            if (e.which == 32) {
                return false;
            }
        });
        $('<div class="equalizer"> <span class="bar bar-1"></span> <span class="bar bar-2"></span> <span class="bar bar-3"></span></div>').appendTo('#playlist li a');

        //Background option for volume
        $('input[type="range"]').change(function () {
            var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
            $(this).css('background-image',
                        '-webkit-gradient(linear, left top, right top, '
                        + 'color-stop(' + val + ', #db241b), '
                        + 'color-stop(' + val + ', #171717)'
                        + ')'
                        );
        });
        //Move the playlist info
        $('#playlist-info-container').appendTo('.player-title');

        //Alert for keys
        $("#player").waypoint(function(event) {
            $('.player-keys').toggleClass('animateme');
            this.destroy();
        }, {offset: '0%'});

    //*********************************************
    //  EVENT LIST SCRIPTS
    //*********************************************

        // init cubeportfolio
        $('#event-items').cubeportfolio({
            filters: '#event-filters',
            search: '#event-search',
            loadMore: '#more-events',
            loadMoreAction: 'click',
            layoutMode: 'grid',
            defaultFilter: '*',
            animationType: '3dflip',
            gapHorizontal: 35,
            gapVertical: 25,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1500,
                cols: 4,
            }, {
                width: 800,
                cols: 3,
            }, {
                width: 600,
                cols: 2
            }, {
                width: 480,
                cols: 1,
                options: {
                    caption: '',
                    gapHorizontal: 25,
                    gapVertical: 10,
                }
            }],
            caption: 'zoom',
            displayType: 'fadeIn',
            displayTypeSpeed: 100,
        });

    //*********************************************
    //  CLIENTS
    //*********************************************
        // init cubeportfolio
        $('#js-grid-clients').cubeportfolio({
            layoutMode: 'slider',
            drag: true,
            auto: true,
            autoTimeout: 3000,
            autoPauseOnHover: true,
            showNavigation: false,
            showPagination: false,
            rewindNav: true,
            scrollByPage: false,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1500,
                cols: 5,
            }, {
                width: 1100,
                cols: 5,
            }, {
                width: 800,
                cols: 4,
            }, {
                width: 480,
                cols: 2,
            }],
            gapHorizontal: 10,
            gapVertical: 5,
            caption: 'opacity',
            displayType: 'fadeIn',
            displayTypeSpeed: 100,
        });



// End Function
});








































// End Function
