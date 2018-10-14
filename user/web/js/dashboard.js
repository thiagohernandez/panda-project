var checked = 'dbc-checkbox-checked';
var chartHolder = '#panda-operations';

function showTheChart(show) {
	if (show) {
		$(chartHolder).css('display','block');
	}
	else {
		$(chartHolder).css('display','none');
	}
}

// Receive chart data from the server and show it in a graph
var makeChart = function(type,data,chart) {
	var i;
	debug('JSON data arrived at makeChart...');
	Highcharts.setOptions({
		lang: {
			decimalPoint: ',',
			thousandsSep: '.'
		}
	});
	Highcharts.setOptions(data.options);

	// Parameters for the chart (title, etc.)
	//debug(data);return;
	data = JSON.parse(data);
	for (i in data.parameters) {
		debug("found parameter: " + i);
		chart[i] = data.parameters[i];
	}

	// The graph data
	debug("data contains " + data.series.length + " graphs");
	for (i=0; i<data.series.length; ++i) {
		//debug(data.series[i]);break;
		//debug("Graph "+i+" contains "+data.series[i].data.length+" points");
	}
	//debug(chart);
	chart['colors'] = data['colors'];
	chart['series'] = data['series'];

	// Show the chart
	$('#chart-holder').highcharts(type,chart);
};

var hichartCallback = function($,data) {
	makeChart('Chart',data,{
		navigator 		: {	enabled : false		},
		rangeSelector : {	enabled : false		},
		tooltip 			: {	enabled : false		},
		credits 			: {	enabled : false		},
		exporting 		: {	enabled : false		}
	});
};

var histockCallback = function(data) {
	makeChart('StockChart',data,{
		navigator 		: {	enabled : true		},
		rangeSelector : {	enabled : false		},
		tooltip 			: {	enabled : false		},
		credits 			: {	enabled : false		},
		exporting 		: {	enabled : false		},
		tooltip: {
			pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> <br/>',
			valueDecimals: 2
		}
	});
};
var $scrollReturnPos = 0;
$('#hide-chart-button').on('click', function() {
	// Remove junk from the screen
	console.log("scrollReturnPos="+$scrollReturnPos);
	$('html,body').animate({scrollTop:($scrollReturnPos+"px")},1000);
	$('#panda-operations').fadeOut(1010);
});
function scrollChartToView() {
	$scrollReturnPos = $('html,body').scrollTop();
	$pos = $("#panda-operations").offset().top;
	$('html,body').animate({scrollTop:(($pos-14)+"px")},1000);
}

// Make an AJAX request with retries
function doAjax(ajaxURL, successCallback) {
	var params = {
		numTries : 0,
		maxTries : 3,
		url: ajaxURL,
		success: successCallback,
		error: function() {
			console.log("AJAX error after "+this.numTries+" trys");
			if (this.numTries < this.maxTries) {
				++this.numTries;
				$.ajax(this);
			}
			else {
				alert("The server didn't respond");
			}
		}
	};
	$.ajax(params);
}

function showChartFor(companyID, label) {
	debug("\n\n\nshowChartFor:"+label);
	$('#chart-name').text(label);

	var datacount = 0;
	var scrollCount = 3;
	// Remove currently displayed chart from screen, show busy spimnner
	$('#chart-holder').empty();

	showTheChart(true);
	$("#operations-list").css('min-height',(window.innerHeight-$('#chart-holder').height()));

	// Request chart data
	debug("Requesting pandaOperationsForCompanyAsChart/"+companyID);
	doAjax(baseURL+'/data/pandaOperationsForCompanyAsChart/' + companyID,
		function( data ) {
			debug(datacount+"--Chart data arrived at pandaOperationsForCompanyAsChart callback");
			histockCallback(data);
			$(".hide-chart-button").show();
			if (++datacount === scrollCount) {
				scrollChartToView();
			}
		}
	);

	// Call server to get company stats
	$("#company-stats").empty();
	debug("Requesting statsForCompanyAsJSON/"+companyID);
	doAjax(baseURL + '/data/statsForCompanyAsJSON/' + companyID,
		function( data ) {
			debug(datacount+"--Stats arrived at statsForCompanyAsJSON callback");
			//debug(data);
			data = JSON.parse(data);
			$("#company-stats").html( decodeBase64(data.text) );
			makeCharts(data.stats);
			if (++datacount === scrollCount) {
				scrollChartToView();
			}
		}
	);

	// Call server to get details of Panda operations
	$("#operations-list").empty();
	debug("Requesting operationsListAsHtml/"+companyID);
	doAjax(baseURL + '/data/operationsListAsHtml/' + companyID,
		function( data ) {
			debug(datacount+"--Operations data arrived at operationsListAsHtml callback");
			$("#operations-list").html( data );
			$("#operations-list").show();
			if (++datacount === scrollCount) {
				scrollChartToView();
			}
		}
	);
}
var selectExchange = function(ex) {
	$('.dashboard-company-group').css('display','none');				// Hide all
	$('[company_group_id="'+ex+'"]').css('display','inline');		// Show the selected dashboard
}
var clickCheckbox = function(e,id) {
	$(e).toggleClass("checked");
	if ($(e).hasClass("checked")) {
		doAjax(baseURL + "/pages/subscribe/"+id, function(msg) {
			debug(msg);
		});
	}
	else {
		doAjax(baseURL + "/pages/unsubscribe/"+id, function(msg) {
			debug(msg);
		});
	}
}

// Set up the page/add events after load
function initializeDashboard() {
	var i;
	debug('Initialising companies');
	for (i=0; i<user_companies.length; ++i) {
		//console.log("looking for: "+user_companies[i]);
		var b = $(".company-panel[company="+user_companies[i]+"]");
		b = b.find(".company-checkbox");
		b.addClass("checked");
	}
	// When you click on an exchange (Action: show the companies in that exchange)
	$('.exchange-button').on('click', function() {
		var id = $(this).attr('exch');
		debug('Click exchange: '+id);
		selectExchange(id);
	});

	var allExchanges = $('.dashboard-company-group');
	debug('allExchanges.length ='+allExchanges.length);
	if (allExchanges.length == 1) {
		allExchanges.css('display','inline');
	}
	else {
		selectExchange(0);
	}
	
	// When you click on a company name
	$('.company-panel').on('click', function(event) {
		event.preventDefault();
		var id = $(this).attr('company');
		debug('click company:'+id);
		showChartFor(id,$(this).text());
	});
	$('.xxcompany-name').on('click', function(event) {
		event.preventDefault();
		var p = $(this).parent();
		var id = p.attr('company');
		debug('click company:'+id+" ('"+$(this).text()+"')");
		showChartFor(id,$(this).text());
	});

	// When you click on a company checkbox
	$('.company-checkbox').on('click', function(event) {
		var p = $(this).closest(".company-panel");
		var id = p.attr('company');
		debug('click checkbox: '+id);
		clickCheckbox(this,id);
	});

};
