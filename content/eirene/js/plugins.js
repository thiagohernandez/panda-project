
// Start Window Load Function
$(window).on('load', function() {

    'use strict';

    // Check the device for mobile or desktop
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) { var mobile = true; }
    else{ var mobile = false; }

    //Slider settings for load projects and heights
    $('.eirene-slide').each(function(){
        var item = $(this),
            project = $(item).data('project');
        //slide Height in normally
        $(item).height('100vh');

        //call html files and change height
        $(item).on('click', ".slide-texts:not('.prj-loaded'):not(.prj-loading)", function(e){
            //Show Loader
            $('.loader-to-project').fadeIn('400');
            //Get loader class
            $(item).find('.slide-texts').addClass('prj-loading');
            //Disable Loader
            $('.slide-hover').fadeOut('100');
            //Load html file
            $("#project-loader").load(project, function() {
                //Disable arrows
                $('.page-changer').addClass('hiding');
                //Trigger for Quadra Functions
                $(this).ready(function(){
                    //You can add functions to whenProjectLoaded function - bottom of this file.
                    $('body').whenProjectLoaded();
                });
                setTimeout( function(){
                    //Project Loader Circle
                    $('.loader-to-project').fadeOut('300');
                    //Edit height
                    $('.eirene-slider .eirene-slide, .eirene-slider .slick-list').animate({'height': '70vh'}, 800, "easeInOutQuart");
                    //Refresh Parallax Effect
                    if (mobile == false) {
                        $(window).data('plugin_stellar').refresh();
                    }
                }, 900);
                setTimeout( function(){
                    //Trigger Body
                    $('body').addClass('project-loaded');
                    //Get loader class
                    $(item).find('.slide-texts').addClass('prj-loaded').removeClass("prj-loading");
                }, 1100);

            });
        });

        $.fn.hideProject = function() {
            //Remove Loaded Checker
            $('.slide-texts').addClass("prj-hiding");
            //Scroll top
            $('html, body').stop().animate({ scrollTop : 0 }, 700, 'easeInOutExpo');
            //Show Loader
            $('.loader-to-project').fadeOut('0');
            //Trigger Body
            setTimeout( function(){ $('body').removeClass('project-loaded'); }, 450);
            setTimeout( function(){
                //Clear project section
                $('#project-loader').empty();
                //Get arrows
                $('.page-changer').removeClass('hiding');
                $('.slide-texts').removeClass('prj-hiding prj-loaded');
            }, 800);
            //Disable Loader
            $('.slide-hover').delay('800').fadeIn('200');

            //slide Height in normally
            $('.eirene-slider .eirene-slide, .eirene-slider .slick-list').animate({'height': '100vh'}, 800, "easeInOutQuart");
        }
        //Return
        $(item).on('click', ".prj-loaded:not(.prj-hiding):not(.prj-loading)", function(){
            $('body').hideProject();
        });
    });


    

//*********************************************
//  Options for home slider
//*********************************************

    //Get Slider
    var $slider = $('.eirene-slider');
    //After Slider Load
    $slider.on('init', function(event) {
        $('.slick-active').next().addClass('next');
        var nextItem = $('.slick-slide.next'),
            nextImage = $(nextItem).data('background'),
            nextTitle = $(nextItem).data('title');
            $('.next-page-button').css({'background-image': 'url(' + nextImage +')'});
            $('.next-page-button').find('span').html(nextTitle);
        var prevItem = $('.slick-slide:last-child'),
            prevImage =$(prevItem).attr('data-background'),
            prevTitle =$(prevItem).data('title');
            $('.prev-page-button').css({'background-image': 'url(' + prevImage +')'})
            $('.prev-page-button').find('span').html(prevTitle);
    });
    //Slider Options
    $($slider).slick({
        fade: true,
        dots: false,
        arrows: false,
        autoplay: false,
        pauseOnHover: true,
        infinite: true,
        edgeFriction: 0,
        easing: 'linear',
        touchThreshold: 50,
        speed: 300,
        slidesToShow: 1,
        swipe: false,
        initialSlide: 0,
        touchMove: false,
        draggable: false,
        adaptiveHeight: false,
        variableWidth: false,
        centerMode: false,
        slidesToScroll: 1,
        setPosition: 0
    }).on('reInit afterChange', function(event, slick, nextSlide){
        var totalItems = $('.eirene-slide').length,
            nextItem = $(slick.$slides.get(nextSlide - totalItems +1)),
            nextImage = $(nextItem).data('background'),
            nextTitle = $(nextItem).data('title');
            $('.next-page-button').css({'background-image': 'url(' + nextImage +')'});
            $('.next-page-button').find('span').html(nextTitle);
    }).on('afterChange', function(event, slick, prevSlide){
        var prevItem = $(slick.$slides.get(prevSlide -1)),
            prevImage =$(prevItem).attr('data-background'),
            prevTitle =$(prevItem).data('title');
            $('.prev-page-button').css({'background-image': 'url(' + prevImage +')'})
            $('.prev-page-button').find('span').html(prevTitle);
    });
    //Navigations
    $('.next-page-button').click(function(){
        $(".eirene-slider").slick('slickNext');
    });
    //Navigations
    $('.prev-page-button').click(function(){
        $(".eirene-slider").slick('slickPrev');
    });

    //Disable Keyboard Controls when project is open
    var hold = false;
    $(".slide-texts").click(function() {
        $slider.slick("slickSetOption", "accessibility", hold);
        hold = !hold;
        $(this).toggleClass("disabled");
    });


    //Close the page loader
        var $pageloader = $('.page-loader');
        setTimeout(function() {
            $pageloader.addClass("page-loader--fading-out");
        }, 100);
        setTimeout(function() {
            $pageloader.removeClass("page-loader--fading-out").addClass("page-loader--hidden");
        }, 400);
    // Window Before Unloading
        window.onbeforeunload = function (event) {
            $('.page-loader').removeClass("page-loader--hidden").addClass("page-loader--fading-in");
        };




//*********************************************
//  Scripts for when project loaded
//*********************************************
    
    $.fn.whenProjectLoaded = function() {
        $(window).trigger("resize");
        $(this).find('.custom-slider').slick({touchThreshold: 150,
            responsive: [{
                breakpoint: 768,
                settings: { slidesToShow: 1, slidesToScroll: 1 }
            }
        ]});
        $('body').animatedItems();
        //Get Background Image
        $("[data-background]").not('.bg-mobiled').each(function () { var bgSRC = $(this).data('background'); var self = $(this);
            $(this).css({'background-image': 'url(' + bgSRC + ')'});
            $(self).ready( function() {
                setTimeout( function(){$(self).addClass('loaded'); }, 50);
            });
        });
        //Change background images for large and small screens
        if ($(window).width() < 1024 ) {
            $("[data-mobile-background]").each(function(){var bgSRC = $(this).data('mobile-background');$(this).css({'background-image': 'url(' + bgSRC + ')', 'background-size': 'cover !important'}); });
        } else{
            $("[data-background]").each(function () {var bgSRC = $(this).data('background');$(this).removeClass('bg-mobiled').css({'background-image': 'url(' + bgSRC + ')'}); });
        }

        //Work Parallax Effects
        $("[data-stellar-background-ratio], [data-stellar-ratio]").not('.bg-normal').addClass('parallax');
        $('.bg-parallax').each(function(){ var $this = $(this); $($this).closest('section, .parallax-container').addClass('o-hidden relative z-index-1');});
        $(window).data('plugin_stellar').refresh();

        //Lightbox Gallery Class for containers. All "a" links will work for lightbox with click.
        //Also you can add .no-lightbox claass for no-lightbox links.
        if ($(".lightbox_gallery").exists()) {
            $('.lightbox_gallery').lightGallery({
                selector: 'a:not(.no-lightbox)',
                download: true,
                speed: 400,
                loop: true,
                controls: true,
                thumbWidth: 100,
                thumbContHeight: 100,
                thumbMargin: 8,
                share: true,
                cssEasing: 'cubic-bezier(0.645, 0.045, 0.355, 1)',
                loadYoutubeThumbnail: true,
                youtubeThumbSize: 'default',
                iframeMaxWidth: '80%',
                loadVimeoThumbnail: true,
                vimeoThumbSize: 'thumbnail_medium',
                youtubePlayerParams: { modestbranding: 1, showinfo: 0, rel: 0, controls: 0 },
                vimeoPlayerParams: { byline : 0, portrait : 0, color : 'A90707' }
            });
            $('.lightbox_gallery:not(.no-lightbox)').addClass('lightboxed');
        }
        //Only .lightbox_selected classes will work in .lightbox_selected container
        if ($(".lightbox_selected").exists()) {
            $('.lightbox_selected').lightGallery({
                selector: 'a.lightbox_item',
                download: true,
                speed: 500,
                loop: true,
                controls: true,
                thumbWidth: 100,
                thumbContHeight: 100,
                thumbMargin: 8,
                share: true,
                cssEasing: 'cubic-bezier(0.645, 0.045, 0.355, 1)',
                loadYoutubeThumbnail: true,
                youtubeThumbSize: 'default',
                loadVimeoThumbnail: true,
                vimeoThumbSize: 'thumbnail_medium',
                youtubePlayerParams: { modestbranding: 1, showinfo: 0, rel: 0, controls: 0 },
                vimeoPlayerParams: { byline : 0, portrait : 0, color : 'A90707' }
            });
        }
        //You can add .lightbox classes to single elements
        if ($(".lightbox").exists()) {
            $('.lightbox').lightGallery({
                selector: 'this',
                download: true,
                thumbWidth: 100,
                thumbContHeight: 100,
                share: true,
                loadYoutubeThumbnail: true,
                youtubeThumbSize: 'default',
                loadVimeoThumbnail: true,
                youtubePlayerParams: { modestbranding: 1, showinfo: 0, rel: 0, controls: 0 },
                vimeoPlayerParams: { byline : 0, portrait : 0, color : 'A90707' }
            });
        }
        //Call Tooltip and popovers
        $('[data-toggle="tooltip"], .tooltip-item').tooltip({html: true});
        // $('[data-toggle="tooltip"], .tooltip-item').on('shown.bs.tooltip', function () { $('.tooltip').addClass('fade in'); });
        $('[data-toggle="popover"]').popover({html: true});
    }


// End Window Load Function
});







