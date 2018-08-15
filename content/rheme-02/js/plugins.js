
// Start Window Load Function
$(window).on('load', function() {

    'use strict';

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
                width: 1100,
                cols: 3
            }, {
                width: 800,
                cols: 2
            }, {
                width: 640,
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
            var position = $('#filters').offset().top - $('#works #items').offset().top,
                max = 1200, min = -200;
            if ( position > max || position < min) {
                $('html, body').stop().animate({
                    scrollTop : $('#works #items').offset().top - 80 + "px"
                }, 1150, 'easeInOutExpo');
            }
        });

// End Function
});
