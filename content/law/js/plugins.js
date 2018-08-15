
// Start Window Load Function
$(window).on('load', function() {

    'use strict';

    $('.hero-slider').ready(function(){
        $(this).find('.slick-arrow').append('<span></span>')
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
                width: 768,
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
