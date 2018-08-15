
// Start Window Load Function
$(window).on('load', function() {

    'use strict';

    //*********************************************
    //  LOADING ANIMATIONS
    //*********************************************

        $('.oinone-box').each(function(){
            var $this = $(this);
            $($this).waypoint(function(){
                $this.addClass('oinone-loaded');
                this.destroy();
            }, {offset: '75%'});
        });

    //*********************************************
    //  PORTFOLIO
    //*********************************************

        $('#portfolio-items').cubeportfolio({
            layoutMode: 'grid',
            mediaQueries: [{
                width: 1500,
                cols: 2,
            }, {
                width: 1100,
                cols: 2,
            }, {
                width: 640,
                cols: 2,
            }, {
                width: 480,
                cols: 1,
                options: {
                    caption: '',
                }
            }],
            defaultFilter: '*',
            animationType: 'scaleDown',
            gapHorizontal: 20,
            gapVertical: 20,
            gridAdjustment: 'responsive',
            caption: 'moveRight',
            displayType: 'sequentially',
            displayTypeSpeed: 150,
        });

    //*********************************************
    //  GOOGLE MAP 2 - Gray
    //*********************************************

        // Map Coordination - Map looks
        var position = new google.maps.LatLng(40.9100, -74.5400);
        // First Marker Coordination
        var myposition = new google.maps.LatLng(40.9100, -73.9800);
        // Map Options
        var myOptions = {
            zoom: 10,
            center: position,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            scrollwheel: false,
            // Google Map Color Styles
            styles:
            [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
        };
        //Map ID
        var map = new google.maps.Map(document.getElementById('google_map'), myOptions),
            // Marker Images for first and second
            image = 'images/marker2.png',
            // Your Title and description
            contentString =  '<h4>' + 'Office 1' + '</h4><p>' + 'Your description is here.' +'</p>',
            //Marker Position and image selector
            marker = new google.maps.Marker({ position: myposition, map: map, icon: image }),
            // Infowindow
            infowindow = new google.maps.InfoWindow({ content: contentString });
        //Click function for marker
        google.maps.event.addListener(marker, 'click', function() { infowindow.open(map,marker); });

// End Function
});
