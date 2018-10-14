// jQuery to collapse the navbar on scroll
function collapseNavbar() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
}


$(window).scroll(collapseNavbar);
$(document).ready(collapseNavbar);

//font loader
 WebFont.load({
    google: {
      families: ['Poppins:300,400,400i,600,700']
    }
});

jQuery(document).ready(function() {	

	"use strict";

    //scrollTo
    $(function() {
        $('a.page-scroll').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });

    function calculatePercentagePlan() {
        var usedCompanies = $('.plan-label__used').text();
        var avaliableCompanies = $('.plan-label__avaliable').text();
        var planConsumption = (100*usedCompanies) / avaliableCompanies;

        //calculo de la circunferencia
        var circunferenciaPlan = 2 * Math.PI * 56;

        $('.stroke-internal').css({
            'stroke-dasharray' : circunferenciaPlan,
            'stroke-dashoffset' : circunferenciaPlan
        });

        // calculo de la percentaje de circuferencia de acuerdo con el plan
        var animateValue = circunferenciaPlan * (1 - (planConsumption/100)) ;

        //anima circuferencia
        var animateStroke = $('.stroke-internal');
        var tl = new TimelineMax();
        tl.to(animateStroke, 3, {attr:{cx:62.5, cy:62.5}, ease: Power2.easeOut, strokeDashoffset:animateValue});

    }
    if ($('.stroke-internal').length) {
        calculatePercentagePlan();
    }
    

    //añadir color en los indices del día
    $('.tint-value').each(function() {
        var actualNumber = parseFloat($(this).text());
        if (actualNumber < 0 ) {
            $(this).addClass('tint-value__red');
        } else {
            $(this).addClass('tint-value__green');
        }
        
    });

    //add tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    //Set tab on account
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    if ($('body').hasClass('page-account')) {
        console.log('yes');
        var pointertab = getUrlParameter('tab');
        console.log(pointertab);
        switch (pointertab) {
            case 'profile':
                $('#pills-profile-tab').tab('show');
                break; 
            case 'subscription':
                $('#pills-subscription-tab').tab('show');
                break; 
            case 'alerts':
                $('#pills-alerts-tab').tab('show');
                break; 
            default: 
                $('#pills-account-tab').tab('show');
        }
    }
    //End Set tab on account

    //fake trigger alerts on save
    $('.trigger-success').on( "click", function() {
        var htmlMessage = 'Los cambios <strong>han sido guardados</strong>.';
        var htmlAlert = '<div class="alert alert-success alert-dismissible fade show" role="alert">' + htmlMessage + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        $('.alerts-message').css({
            'display' : 'none'
        });
        $('.alerts-message').html(htmlAlert);
        $('.alerts-message').show('fast');
    });

    //close alerts cards
    
    $('.triggerCardClose').on( "click", function() {
        $(this).parent().parent().hide('fast');
    });


    if ($('.markets-slider').length >= 1) {
        $('.markets-slider').slick({
            dots: true,
            infinite: false,
            speed: 300,
            arrows: false,
            //slidesToShow: 4,
            slidesToScroll: 3,
            variableWidth: true
        });
    }
    

    //Open modal
    $('.btn-charts-item').on( "click", function() {
        $('#modalGraphs').modal('show');
    });    

    //change button on pricing tables
    $('.radioBigInverters input[type=radio]').change(function() {
        if (this.value == '6 meses') {
            $('.big1year').hide('slow');
            setTimeout(function(){
              $('.big6months').show('fast');
            }, 600);
        }
        else if (this.value == '1 año') {
            $('.big6months').hide('slow');
            setTimeout(function(){
              $('.big1year').show('fast');
            }, 600);
        }
    });

    //change button on pricing tables Club
    $('.radioClubInverters input[type=radio]').change(function() {
        if (this.value == '6 meses') {
            $('.club1year').hide('slow');
            setTimeout(function(){
              $('.club6months').show('fast');
            }, 600);
        }
        else if (this.value == '1 año') {
            $('.club6months').hide('slow');
            setTimeout(function(){
              $('.club1year').show('fast');
            }, 600);
        }
    });

    //Open modal
    $('.tourStart').on( "click", function() {
        console.log('oi');
        introJs().start();
    });    
    
<<<<<<< HEAD
	var pathname = window.location.pathname;
	console.log(pathname);
	if (pathname == "/"){
		$("#home_header").addClass("active");
	}
=======
>>>>>>> c05e314cb04d50ebd48c619aaca9d6b9e94031a3


					
});	//ready

$( window ).resize(function() {
	//setHeight();
});
