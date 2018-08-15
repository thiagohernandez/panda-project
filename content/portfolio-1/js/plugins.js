
// Start Window Load Function
$(window).on('load', function() {

    'use strict';

    //*********************************************
    //  PORTFOLIO OPTIONS
    //*********************************************

        // init cubeportfolio
        $('#portfolio-items').cubeportfolio({
            filters: '#filters',
            loadMoreAction: 'click',
            layoutMode: 'grid',
            mediaQueries: [{
                width: 1500,
                cols: 5
            }, {
                width: 1100,
                cols: 4
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
            gapHorizontal: 6,
            gapVertical: 6,
            gridAdjustment: 'responsive',
            caption: 'zoom',
            displayType: 'sequentially',
            displayTypeSpeed: 150,

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
