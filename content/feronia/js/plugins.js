
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
                }
            },
                responsiveLevels:[1920,1240,778,480],
                visibilityLevels:[1920,1240,778,480],
                gridwidth:[1920,1240,778,480],
                gridheight:[868,768,500,440],
                lazyType:"none",
                parallax: {
                    type:"mouse",
                    origo:"slidercenter",
                    speed:2000,
                    levels:[2,3,4,5,6,7,12,16,10,50],
                },
                shadow:0,
                spinner:"off",
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
        $('#portfolio_items').cubeportfolio({
            filters: '#js-filters-lightbox-gallery1, #js-filters-lightbox-gallery2',
            loadMore: '#js-loadMore-lightbox-gallery',
            loadMoreAction: 'click',
            layoutMode: 'grid',
            mediaQueries: [{
                width: 1500,
                cols: 4
            }, {
                width: 950,
                cols: 3
            }, {
                width: 800,
                cols: 2
            }, {
                width: 480,
                cols: 2
            }, {
                width: 320,
                cols: 1
            }],
            defaultFilter: '*',
            animationType: 'rotateSides',
            gapHorizontal: 20,
            gapVertical: 20,
            gridAdjustment: 'responsive',
            caption: 'zoom',
            displayType: 'sequentially',
            displayTypeSpeed: 100,

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
            },
        });


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


        // init cubeportfolio
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
