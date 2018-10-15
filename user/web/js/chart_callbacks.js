// Receive chart data from the server and show it in a graph
var makeChart = function($,type,data,chart) {
	// Show output on the debug console
	var debug = function(v) {
		console.log(v);		// Comment out this line to hide all output from this file
	}
	debug('JSON data arrived at makeChart...');

	Highcharts.setOptions({
			lang: {
					decimalPoint: ',',
					thousandsSep: '.'
			}
	});
	Highcharts.setOptions(data.options);

	// Parameters for the chart (title, etc.)
	for (i in data.parameters) {
		debug("found parameter: " + i);
		chart[i] = data.parameters[i];
	}

	// The graph data
	debug("data contains " + data->series.length + " graphs");
	chart['series'] = data['series'];

	// Show the chart
	$('#chart-holder').highcharts(type,chart);
};

var hichartCallback = function($,data) {
	makeChart($,'Chart',data,{
		navigator 		: {	enabled : false		},
		rangeSelector : {	enabled : false		},
		tooltip 			: {	enabled : false		},
		credits 			: {	enabled : false		},
		exporting 		: {	enabled : false		}
	});
};

var chartAnim;
var chartData;
var chartChart;
var calcSpeed;
var chartTimer = null;
var stopTimer = function() {
	if (chartTimer != null) {
		clearInterval(chartTimer);
		chartTimer = null;
		console.log("Chart timer stopped...");
	}
}
var chartAnimator = function() {
	if (chartAnim == chartData.length) {
		stopTimer();
	}
	else {
		console.log(""+chartAnim+"/"+chartData.length);
		chartChart.addSeries(chartData[chartAnim++]);
	}
}
var chartAnimationStarter = function() {
	console.log("Starting to add operations to chart...");
	chartTimer = setInterval(chartAnimator,calcSpeed);
}
var histockCallback = function($,data,anim,spd) {
	if (typeof anim == undefined) {
		anim = false;
	}
	if (typeof spd == undefined) {
		spd = 30;
	}
	var c = {
		navigator 		: {	enabled : true		},
		rangeSelector : {	enabled : false		},
		tooltip 			: {	enabled : false		},
		credits 			: {	enabled : false		},
		exporting 		: {	enabled : false		},
		tooltip: {
			pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> <br/>',
			valueDecimals: 2
		}
	};
	if (anim) {
		// Make the chart
		var copyOfData = JSON.parse(JSON.stringify(data ));
		copyOfData.parameters.xAxis.min = null;
		copyOfData.parameters.xAxis.max = null;
		chartData = copyOfData['series'];
		copyOfData['series'] = chartData.slice(0,1);
		makeChart($,'StockChart',copyOfData,c);

		// Start the animation
		chartAnim = 1;
		calcSpeed = spd;
		chartChart = $('#chart-holder').highcharts();
		stopTimer();
		setTimeout(chartAnimationStarter,1200);
	}
	else {
		makeChart($,'StockChart',data,c);
	}
};

