
// Start Window Load Function
$(window).on('load', function() {

    'use strict';

    //*********************************************
    // GLOBAL SETTINGS
    //*********************************************

        $('.section').each(function() {
            $(this).append('<div class="darkvision"></div>');
            var $this = $(this);
            $(this).waypoint(function() {$this.find('.darkvision').fadeToggle(600);}, {offset: '70%'});
            $(this).waypoint(function() {$this.find('.darkvision').fadeToggle(600);}, {offset: '-70%'});
        });

        $('.hero-slider').ready(function(){
            $(this).find('.slick-arrow').append('<span></span>')
        });

    //*********************************************
    //  PORTFOLIO SECTION
    //*********************************************

        $('#works #items').cubeportfolio({
            filters: '#works #filters',
            loadMore: '#loadmore',
            loadMoreAction: 'click',
            gridAdjustment: 'responsive',
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
            animationType: 'quicksand',
            gapHorizontal: 30,
            gapVertical: 30,
            caption: 'zoom',
            displayType: 'sequentially',
            displayTypeSpeed: 100,
        });

// End Function
});
