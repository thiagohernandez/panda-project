// When Window Loaded.
$(window).on('load', function() {

    'use strict';

	// Get Slide Arrow Texts On Home
	$('.hero-slider').ready(function(){
	    $(this).find('.slick-arrow').append('<span></span>')
	});

	// Visible text positions for category tabs
	$(".categories .tab-item").each(function(){
		var item = $(this),
			visibleItem = item.find(".visible-item"),
			hiddenItemH = item.find(".hidden-item").height() / 2;
		$(visibleItem).css({
		    "-webkit-transform":"translateY("+ hiddenItemH + "px" + ")",
		    "-ms-transform":"translateY("+ hiddenItemH + "px" + ")",
		    "transform":"translateY(" + hiddenItemH + "px" + ")"
		});
	});

});


// Cube Portfolio Scripts For Portfolio and Blog
(function($, window, document, undefined) {

    'use strict';

    // init cubeportfolio - Portfolio
    $('#portfolio-items').cubeportfolio({
        filters: '#filter',
        layoutMode: 'mosaic',
        mediaQueries: [{
            width: 1000,
            cols: 4,
        }, {
            width: 700,
            cols: 2,
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
        defaultFilter: '*',
        gapHorizontal: 0,
        gapVertical: 0,
        gridAdjustment: 'responsive',
        caption: 'fadeIn',
        displayType: 'none',
        displayTypeSpeed: 10,
    });

    // init cubeportfolio - Blog
    $('#posts').cubeportfolio({
        filters: '#tags',
        gapVertical: 20,
        gapHorizontal: 30,
        layoutMode: 'masonry',
        gridAdjustment: 'responsive',
        mediaQueries: [{
            width: 950,
            cols: 3,
        }, {
            width: 850,
            cols: 2,
        }, {
            width: 770,
            cols: 2,
        }, {
            width: 640,
            cols: 2,
        }, {
            width: 480,
            cols: 1,
        }, {
            width: 320,
            cols: 1
        }],
        caption: 'none',
        animationType: 'quicksand',
        displayType: 'none',
        displayTypeSpeed: 0,
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
})(jQuery, window, document);



