
// Start Window Load Function
$(window).on('load', function() {

    'use strict';

    //*********************************************
    //  PORTFOLIO OPTIONS
    //*********************************************

        var tpj=jQuery,
            revapi469;
        if(tpj("#slider_carousel").revolution == undefined){
            revslider_showDoubleJqueryError("#slider_carousel");
            }else{
            revapi469 = tpj("#slider_carousel").show().revolution({
                sliderType:"carousel",
                jsFileLocation:"revolution/js/",
                sliderLayout:"fullwidth",
                dottedOverlay:"none",
                delay:9000,
                navigation: {
                    keyboardNavigation:"on",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation:"off",
                    mouseScrollReverse:"default",
                    onHoverStop:"off",
                    arrows: {
                        style: "uranus",
                        enable: true,
                        hide_onmobile: false,
                        hide_onleave: true,
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
                    }
                },
                carousel: {
                    horizontal_align: "center",
                    vertical_align: "center",
                    fadeout: "on",
                    vary_fade: "on",
                    maxVisibleItems: 3,
                    infinity: "on",
                    space: 0,
                    stretch: "off"
                },
                responsiveLevels:[1240,1024,778,480],
                visibilityLevels:[1240,1024,778,480],
                gridwidth:[800,640,480,480],
                gridheight:[720,720,480,360],
                lazyType:"none",
                parallax: {
                    type:"scroll",
                    origo:"enterpoint",
                    speed:400,
                    levels:[5,10,15,20,25,30,35,40,45,50,46,47,48,49,50,55],
                },
                shadow:0,
                spinner:"off",
                stopLoop:"on",
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
        //  Masonry OPTIONS
        //*********************************************

            // init cubeportfolio
            $('#portfolio-items').cubeportfolio({
                filters: '#filters',
                loadMoreAction: 'click',
                layoutMode: 'masonry',
                mediaQueries: [{
                    width: 1500,
                    cols: 3
                }, {
                    width: 1100,
                    cols: 3
                }, {
                    width: 900,
                    cols: 3
                }, {
                    width: 640,
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

                // lightbox
                lightboxDelegate: '.cbp-lightbox',
                lightboxGallery: true,
                lightboxTitleSrc: 'data-title',
                lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',

                // singlePageInline
                singlePageInlineDelegate: '.cbp-singlePageInline',
                singlePageInlinePosition: 'below',
                singlePageInlineInFocus: true,
                singlePageInlineCallback: function(url, element) {
                    // to update singlePageInline content use the following method: this.updateSinglePageInline(yourContent)
                    var t = this;

                    $.ajax({
                            url: url,
                            type: 'GET',
                            dataType: 'html',
                            timeout: 30000
                    })
                    .done(function(result) {

                            t.updateSinglePageInline(result);

                    })
                    .fail(function() {
                        t.updateSinglePageInline('AJAX Error! Please refresh the page!');
                    });
                }
            });


// End Function
});
