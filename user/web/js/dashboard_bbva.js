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
var makeChart = function(type,data,chart,target) {
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
	$(target).highcharts(type,chart);
};

var hichartCallback = function($,data) {
	makeChart('Chart',data,{
		navigator 		: {	enabled : false		},
		rangeSelector : {	enabled : false		},
		tooltip 			: {	enabled : false		},
		credits 			: {	enabled : false		},
		exporting 		: {	enabled : false		}
	},"chart-holder");
};

var histockCallback = function(data,target) {
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
	},target);
};
var $scrollReturnPos = 0;
$('#hide-chart-button').on('click', function() {
	// Remove junk from the screen
	console.log("scrollReturnPos="+$scrollReturnPos);
	$('html,body').animate({scrollTop:($scrollReturnPos+"px")},1000);
	$('#panda-operations').fadeOut(1200);
});
function scrollChartToView() {
	$scrollReturnPos = $('html,body').scrollTop();
	$pos = $("#panda-operations").offset().top;
	$('html,body').animate({scrollTop:(($pos-14)+"px")},1000);
	$(".hide-chart-button").show();
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
	var scrollCount = 4;
	// Remove currently displayed chart from screen, show busy spimnner
	$('#chart-holder').empty();

	showTheChart(true);
	$("#operations-list").css('min-height',(window.innerHeight-$('#chart-holder').height()));

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

	// Request chart data
	debug("Requesting makeOperationsForCompanyAsChart1/"+companyID);
	doAjax(baseURL+'/data/makeOperationsForCompanyAsChart1/' + companyID,
		function( data ) {
			debug(datacount+"--Chart data arrived at pandaOperationsForCompanyAsChart1 callback");
			histockCallback(data,"#chart-holder1");
			if (++datacount === scrollCount) {
				scrollChartToView();
			}
		}
	);

	// Request chart data
	debug("Requesting makeOperationsForCompanyAsChart2/"+companyID);
	doAjax(baseURL+'/data/makeOperationsForCompanyAsChart2/' + companyID,
		function( data ) {
			debug(datacount+"--Chart data arrived at pandaOperationsForCompanyAsChart2 callback");
			histockCallback(data,"#chart-holder2");
			if (++datacount === scrollCount) {
				scrollChartToView();
			}
		}
	);

	// Request chart data
	debug("Requesting makeOperationsForCompanyAsChart3/"+companyID);
	doAjax(baseURL+'/data/makeOperationsForCompanyAsChart3/' + companyID,
		function( data ) {
			debug(datacount+"--Chart data arrived at pandaOperationsForCompanyAsChart3 callback");
			histockCallback(data,"#chart-holder3");
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

// Set up the page/add events after load
function initializeDashboard() {
	debug('Initialising dashboard');

	debug('Initialising companies');
	for (var i=0; i<user_companies.length; ++i) {
		//console.log("looking for: "+user_companies[i]);
		var b = $(".company-panel[company="+user_companies[i]+"]");
		b = b.find(".company-checkbox");
		b.addClass("checked");
	}
	
	// When you click on a company name
	$('.company-panel').on('click', function(e) {
		var id = $(this).attr('company');
		debug('click company:'+id);
		e.preventDefault();
		showChartFor(id,$(this).text());
	});

	// When you click on a company checkbox
	$('.company-checkbox').on('click', function(e) {
		e.preventDefault();
		var p = $(this).closest(".company-panel");
		var id = p.attr('company');
		debug('click checkbox: '+id);
		$(this).toggleClass("checked");
		return false;
	});
	//showChartFor(104,"Telefonica");
};
