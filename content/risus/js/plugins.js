
// Start Window Load Function
$(window).on('load', function() {

    'use strict';

    //*********************************************
    //  GETTING BACKGROUND IMAGES ACCORDING SCREEN SIZES
    //*********************************************

        //Background Variations
        var firstbg = $('.left-bg').data('firstbg'),
            firstbgMobile = $('.left-bg').data('firstbg-mobile'),
            secondbg = $('.left-bg').data('secondbg'),
            secondbgMobile = $('.left-bg').data('secondbg-mobile');

        //Change background images for large and small screens
        if ($(window).width() < 992 ) {
            //Get First Background
            if ( !$('body').hasClass('remove-intro') ) {
                $('.left-bg').css({'background-image': 'url(' + firstbgMobile + ')'});
            } else {
                $('.left-bg').css({'background-image': 'url(' + secondbgMobile + ')'});
            }
        } else{
            //Get First Background
            if ( !$('body').hasClass('remove-intro') ) {
                $('.left-bg').css({'background-image': 'url(' + firstbg + ')'});
            }    else {
                $('.left-bg').css({'background-image': 'url(' + secondbg + ')'});
            }
        }
        // Window resize
        $(window).resize(function(){
            //Change background images for large and small screens
            if ($(window).width() < 992 ) {
                if ($('body').hasClass('loaded') || $('body').hasClass('remove-intro')) {
                    $('.left-bg').css({'background-image': 'url(' + secondbgMobile + ')'});
                } else {
                    $('.left-bg').css({'background-image': 'url(' + firstbgMobile + ')'});
                }
            } else{
                if ($('body').hasClass('loaded') || $('body').hasClass('remove-intro')) {
                    $('.left-bg').css({'background-image': 'url(' + secondbg + ')'});
                } else {
                    $('.left-bg').css({'background-image': 'url(' + firstbg + ')'});
                }
            }
        });


    //*********************************************
    //  FUNCTIONS FOR INTRO AND SECOND PAGE
    //*********************************************

        //Work when click on first-load
        $('.first-load').on('click touch', function(){ loadNext(); });

        //work when windows wheel down
        if ( !$('body').hasClass('remove-intro') && !$('body').hasClass('loaded') ) {
            $(window).on('mousewheel', function(event){
                var delta = event.originalEvent.deltaY;
                if (delta > 70) { loadNext(); }
            });
        }

        //How is load
        function loadNext() {
            var $this = $('.first-load');
            //show loader
            $('.content-loader').addClass('active');

            //Change Image
            setTimeout( function(){
                $('body').addClass('loaded');
                // Check mobile and get background image
                if ($(window).width() < 1024 ) {
                    $('.left-bg').css({'background-image': 'url(' + secondbgMobile + ')'});
                } else{
                    $('.left-bg').css({'background-image': 'url(' + secondbg + ')'});
                }
                //Hide First Load
                $($this).fadeOut(0);
            }, 800);
            //Get Details
            setTimeout( function(){
                $('.site-details').fadeIn(0);
                $('.content-loader').addClass('gone');
            }, 1200);

        }
        //Add a different button in the .first-load
        $('.external').on('click', function(event){ event.stopPropagation(); });





// End Function
});
