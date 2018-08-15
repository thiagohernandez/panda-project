
// Start Window Load Function
$(window).on('load', function() { 

    'use strict';
        
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
                width: 900,
                cols: 5,
            }, {
                width: 600,
                cols: 3,
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
