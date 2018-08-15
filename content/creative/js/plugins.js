
// Start Function
(function($, window, document, undefined) {

    'use strict';

    //*********************************************
    //  REVOLUTION SLIDER FOR HOME
    //*********************************************

        var tpj = jQuery;
        var revapi202;
        if (tpj("#home_slider").revolution == undefined) {
            revslider_showDoubleJqueryError("#home_slider");
        } else {
            revapi202 = tpj("#home_slider").show().revolution({
                sliderType: "standard",
                jsFileLocation: "js/revolutionslider/",
                sliderLayout: "fullscreen",
                dottedOverlay: "true",
                delay: 8000,
                navigation: {
                    keyboardNavigation: "on",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    onHoverStop: "off",
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 50,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "zeus",
                        enable: true,
                        hide_onmobile: false,
                        hide_onleave: true,
                        tmp: '<div class="tp-arr-imgwrapper"><div class="tp-arr-imgholder"></div></div>',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 15,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 15,
                            v_offset: 0
                        }
                    },
                    bullets: {
                        enable: true,
                        hide_onmobile: false,
                        hide_under: 600,
                        style: "zeus",
                        hide_onleave: false,
                        direction: "horizontal",
                        h_align: "center",
                        v_align: "bottom",
                        h_offset: 0,
                        v_offset: 30,
                        space: 5,
                        tmp: '<span class="tp-bullet-image"></span><span class="tp-bullet-imageoverlay"></span><span class="tp-bullet-title">{{title}}</span>'
                    }
                },
                responsiveLevels:[1240,1240,778,480],
                visibilityLevels:[1240,1240,778,480],
                gridwidth:[1240,1240,778,480],
                gridheight:[868,640,480,410],
                stopLoop: "off",
                stopAfterLoops: 0,
                stopAtSlide: 0,
                shuffle: "off",
                autoHeight: "on",
                fullScreenAutoWidth: "off",
                fullScreenAlignForce: "off",
                fullScreenOffsetContainer: "",
                fullScreenOffset: "0",
                spinner:"off",
                disableProgressBar: "on",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }

    //*********************************************
    //  REVOLUTION SLIDER FOR IMAGE SLIDE SECTION
    //*********************************************

        var revapi8;
        if (tpj("#image_slider").revolution == undefined) {
            revslider_showDoubleJqueryError("#image_slider");
        } else {
            revapi8 = tpj("#image_slider").show().revolution({
                sliderType: "standard",
                jsFileLocation: "js/revolutionslider/",
                sliderLayout: "fullwidth",
                dottedOverlay: "none",
                delay: 6000,
                navigation: {
                    keyboardNavigation: "on",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    onHoverStop: "off",
                    arrows: {
                        style: "zeus",
                        enable: true,
                        hide_onmobile: false,
                        hide_onleave: true,
                        tmp: '<div class="tp-arr-imgwrapper"><div class="tp-arr-imgholder"></div></div>',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 15,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 15,
                            v_offset: 0
                        }
                    },
                    bullets: {
                        enable: true,
                        hide_onmobile: true,
                        hide_under: 800,
                        style: "dione",
                        hide_onleave: false,
                        direction: "horizontal",
                        h_align: "center",
                        v_align: "bottom",
                        h_offset: 20,
                        v_offset: 60,
                        space: 0,
                        tmp: '<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
                    }
                },
                responsiveLevels:[1240,1024,778,480],
                visibilityLevels:[1240,1024,778,480],
                gridwidth:[1240,1024,778,480],
                gridheight:[750,640,480,410],
                lazyType: "single",
                shadow: 0,
                spinner: "off",
                stopLoop: "on",
                stopAfterLoops: 0,
                stopAtSlide: -1,
                shuffle: "off",
                autoHeight: "off",
                disableProgressBar: "on",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }


    //*********************************************
    //  PORTFOLIO OPTIONS
    //*********************************************

        //Append Counters
        $('#works.creative .cbp-filter-item').each(function(){
        	$(this).append("<div class='cbp-filter-counter'></div>");
        });

    	// init cubeportfolio
        $('#js-grid-agency').cubeportfolio({
            filters: '#js-filters-agency',
            loadMore: false,
            loadMoreAction: 'click',
            layoutMode: 'grid',
            defaultFilter: '*',
            animationType: 'rotateRoom',
            gapHorizontal: 0,
            gapVertical: 0,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1500,
                cols: 5
            }, {
                width: 1100,
                cols: 4
            }, {
                width: 800,
                cols: 3
            }, {
                width: 480,
                cols: 2
            }, {
                width: 320,
                cols: 1
            }],
            caption: 'zoom',
            displayType: 'fadeIn',
            displayTypeSpeed: 100,
        });

    //*********************************************
    //  QUADRA BOX IN THE PORTFOLIO
    //*********************************************

        //Portfolio Quadra Box Scripts
        var qdrTime;
        $('#works .cbp-item').each(function(){
            var imageSRC = $(this).find('img').attr('src'),
                iconSRC = $(this).find('a').data('icon'),
                titleSRC = $(this).find('a').data('qdr-title'),
                headerSRC = $(this).find('.item-body .cbp-l-caption-title').text(),
                descriptionSRC = $(this).find('a').data('description'),
                projectURL = $(this).find('a').attr('data-project-url');
            //QuadraBox Function
            function quadraWork() {
                $('.quadra-box img').attr('src', imageSRC);
                $('.quadra-box .quadra-title').text(titleSRC);
                $('.quadra-box .quadra-header').text(headerSRC);
                $('.quadra-box .quadra-icon i').removeAttr('class').addClass('fa fa-' + iconSRC);
                $('.quadra-box .quadra-description').text(descriptionSRC);
                $('.quadra-box .quadra-button').attr('href', projectURL);
            } quadraWork();
            //Quadra Effect
            $(this).on({ mouseenter: function () { qdrTime = setTimeout(function(){ $(".quadra-box").fadeOut("fast");setTimeout(quadraWork, 220);$(".quadra-box").fadeIn("fast"); }, 500); }, mouseleave: function () { clearTimeout(qdrTime);} });
        });


    //*********************************************
    //  TESTIMONIALS OPTIONS
    //*********************************************

        // init cubeportfolio
        $('.quote-slider').cubeportfolio({
            layoutMode: 'slider',
            drag: true,
            auto: true,
            autoTimeout: 4000,
            autoPauseOnHover: true,
            showNavigation: true,
            showPagination: false,
            rewindNav: true,
            scrollByPage: false,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1,
                cols: 1
            }],
            gapHorizontal: 0,
            gapVertical: 0,
            caption: '',
            displayType: 'default',
        });

    //*********************************************
    //  CLIENTS OPTIONS
    //*********************************************

        // Clients
        $('.clients-slider').cubeportfolio({
            layoutMode: 'slider',
            drag: true,
            auto: true,
            autoTimeout: 5000,
            autoPauseOnHover: true,
            showNavigation: false,
            showPagination: true,
            rewindNav: true,
            scrollByPage: true,
            gridAdjustment: 'responsive',
            mediaQueries: [{
                width: 1680,
                cols: 3
            }, {
                width: 900,
                cols: 3
            }, {
                width: 700,
                cols: 2
            }, {
                width: 480,
                cols: 1
            }, {
                width: 320,
                cols: 1
            }],
            gapHorizontal: 0,
            gapVertical: 45,
            caption: '',
            displayType: 'fadeIn',
            displayTypeSpeed: 600,
        });

    //*********************************************
    //  MAP AND CONTACT FORM HEIGHT CALCULATER
    //*********************************************

        // Creative Contact Form Height Calculate
        var formHeight = $('#contact #form').outerHeight();
        $('#contact #map').css({'height': formHeight + 'px'});

    //*********************************************
    //  GOOGLE MAP
    //*********************************************

        // Map Coordination - Map looks
        var position = new google.maps.LatLng(40.7700, -73.9400);
        // First Marker Coordination
        var myposition = new google.maps.LatLng(40.8200, -74.0800);
        // Map Options
        var myOptions = {
            zoom: 11,
            center: position,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            scrollwheel: false,
            // Google Map Color Styles
            styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
        };
        //Map ID
        var map = new google.maps.Map(document.getElementById('google_map'), myOptions),
            // Marker Images for first and second
            image = 'images/marker.png', image1 = 'images/marker4.png',
            // Your Title and description
            contentString =  '<h4>' + 'Office 1' + '</h4><p>' + 'Your description is here.' +'</p>',
            //Marker Position and image selector
            marker = new google.maps.Marker({ position: myposition, map: map, icon: image }),
            // Infowindow
            infowindow = new google.maps.InfoWindow({ content: contentString });
        //Click function for marker
        google.maps.event.addListener(marker, 'click', function() { infowindow.open(map,marker); });

        /* ========= Second Marker - You can remove this area if you do not use ========= */
        // Second Marker Coordination
        var mypositionSecond = new google.maps.LatLng(40.6900, -73.7600),
            // Your Title and description
            contentStringSecond = '<h4>' + 'Office 2' + '</h4><p>' + 'Your description is here.' +'</p>',
            infowindowSecond = new google.maps.InfoWindow({ content: contentStringSecond }),
            markerSecond = new google.maps.Marker({ position: mypositionSecond, map: map, icon: image1 });
        google.maps.event.addListener(markerSecond, 'click', function() { infowindowSecond.open(map,markerSecond); });



// End Function
})(jQuery, window, document);
