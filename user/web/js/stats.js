/*!
 * jquery.svgDoughnutChart.js
 * Version: 0.1(Beta)
 * Inspired by Chart.js(http://www.chartjs.org/)
 *
 * Copyright (c) 2016 Jordi Corbilla
 * https://github.com/JordiCorbilla/jquery.svgDoughnutChart.js
 * MIT License (MIT)
 * 
 * Modified by FTB...this is NOT the original code!
 */

(function ($) {

		$.fn.donutChart = function (options) {
				var settings = $.extend({
						positiveColor: 'rgb(39, 192, 31)',
						negativeColor:	'rgb(212, 39, 31)',
						backgroundColor: "white",
						width: 200,
						height: 80,
						doughnutSize: 0.35,
						Title: "Graph title",
						positiveText: "Positive text",
						negativeText : "Negative text"
				}, options);

				// Main Layout
				var svgns = "http://www.w3.org/2000/svg";
				var chart = document.createElementNS(svgns, "svg:svg");
				var width = settings.width;
				var height = settings.height;
				chart.setAttribute("width", width);
				chart.setAttribute("height", height);
				var center = (height / 2);
				chart.setAttribute("viewBox", "0 0 " + width + " " + height);
				var back = document.createElementNS(svgns, "circle");
				back.setAttributeNS(null, "cx", center);
				back.setAttributeNS(null, "cy", center);
				back.setAttributeNS(null, "r", center);
				back.setAttributeNS(null, "fill", settings.negativeColor);
				chart.appendChild(back);

				// primary slice
				var path = document.createElementNS(svgns, "path");
				var unit = (Math.PI * 2) / 100;
				var startangle = 0;
				var endangle = settings.percentage * unit - 0.001;
				var x1 = center + center * Math.sin(startangle);
				var y1 = center - center * Math.cos(startangle);
				var x2 = center + center * Math.sin(endangle);
				var y2 = center - center * Math.cos(endangle);
				var big = 0;
				if (endangle - startangle > Math.PI) {
						big = 1;
				}
				//https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths
				//Draw the main path
				var d = "M " + center + "," + center +			// Start at circle center
						" L " + x1 + "," + y1 +								 // Draw line to (x1,y1)
						" A " + center + "," + center +				 // Draw an arc of radius r
						" 0 " + big + " 1 " +									 // Arc details...
						x2 + "," + y2 +												 // Arc goes to (x2,y2)
						" Z";																	 // Close path back to (cx,cy)
				path.setAttribute("d", d); 
				path.setAttribute("fill", settings.positiveColor);
				chart.appendChild(path); // Add slice to chart

				// foreground circle
				var front = document.createElementNS(svgns, "circle");
				front.setAttributeNS(null, "cx", center);
				front.setAttributeNS(null, "cy", center);
				front.setAttributeNS(null, "r", (settings.height * settings.doughnutSize)); 
				front.setAttributeNS(null, "fill", settings.backgroundColor);
				chart.appendChild(front);

	
				//Inner text
				var newText = document.createElementNS(svgns, "text");
				newText.setAttributeNS(null, "x", center-16);
				newText.setAttributeNS(null, "y", 45);
				newText.setAttribute("font-weight", "bold");
				newText.setAttribute("font-size", "large");
				var textNode = document.createTextNode(''+settings.percentage+'%');
				newText.appendChild(textNode);
				chart.appendChild(newText);

				// Some positions/sizes
				var keyX = 100;
				var keyTextY = 12;
				var textX = keyX+20;
				var positiveY = 28;
				if (settings.Title.length == 0) {
					positiveY -= 10;
				}
				var negativeY = positiveY+24;

				if (settings.positiveText.length > 0) {
					//Positive rectangle
					var rect = document.createElementNS(svgns, "rect");
					rect.setAttributeNS(null, "x", keyX);
					rect.setAttributeNS(null, "y", positiveY);
					rect.setAttributeNS(null, "height", '15');
					rect.setAttributeNS(null, "width", '15');
					rect.setAttributeNS(null, "fill", settings.positiveColor);
					rect.setAttributeNS(null, "stroke-width", "1");
					rect.setAttributeNS(null, "stroke", "rgb(0,0,0)");
					chart.appendChild(rect);

					//Positive text
					var newText3 = document.createElementNS(svgns, "text");
					newText3.setAttributeNS(null, "x", textX);
					newText3.setAttributeNS(null, "y", positiveY+keyTextY);
					var textNode3 = document.createTextNode(settings.positiveText);
					newText3.appendChild(textNode3);
					chart.appendChild(newText3);
				}

				if (settings.positiveText.length > 0) {
					//Negative rectangle
					var rect2 = document.createElementNS(svgns, "rect");
					rect2.setAttributeNS(null, "x", keyX);
					rect2.setAttributeNS(null, "y", negativeY);
					rect2.setAttributeNS(null, "height", '15');
					rect2.setAttributeNS(null, "width", '15');
					rect2.setAttributeNS(null, "fill", settings.negativeColor);
					rect2.setAttributeNS(null, "stroke-width", "1");
					rect2.setAttributeNS(null, "stroke", "rgb(0,0,0)");
					chart.appendChild(rect2);

					//Negative text
					var newText4 = document.createElementNS(svgns, "text");
					newText4.setAttributeNS(null, "x", textX);
					newText4.setAttributeNS(null, "y", negativeY+keyTextY);
					var textNode4 = document.createTextNode(settings.negativeText);
					newText4.appendChild(textNode4);
					chart.appendChild(newText4);
				}

				// Graph Title
				if (settings.Title.length > 0) {
					var newText2 = document.createElementNS(svgns, "text");
					newText2.setAttributeNS(null, "x", keyX-2);
					newText2.setAttributeNS(null, "y", 18);
					newText2.setAttribute("font-weight", "bold");
					var textNode2 = document.createTextNode(settings.Title);
					newText2.appendChild(textNode2);
					chart.appendChild(newText2);
				}

				$(this).append(chart);
				return this;
		};

		$.fn.barChart = function (options) {
				var settings = $.extend({
						positiveColor: 'rgb(39, 192, 31)',
						negativeColor:	'rgb(212, 39, 31)',
						backgroundColor: "white",
						height: 160,
						width: 200,
				}, options);

				//Main Layout
				var svgns = "http://www.w3.org/2000/svg";
				var chart = document.createElementNS(svgns, "svg:svg");
				var width = settings.width;
				var height = settings.height;
				chart.setAttribute("width", width);
				chart.setAttribute("height", height);
				chart.setAttribute("viewBox", "0 0 " + width + " " + height);

				if (0) {
					// Outline so we can see the size/position
					var rect = document.createElementNS(svgns, "rect");
					rect.setAttributeNS(null, "x", 0);
					rect.setAttributeNS(null, "y", 0);
					rect.setAttributeNS(null, "height", height-1);
					rect.setAttributeNS(null, "width", width-1);
					rect.setAttributeNS(null, "fill", "#fff");
					rect.setAttributeNS(null, "stroke-width", 1);
					rect.setAttributeNS(null, "stroke", "rgb(200,200,200)");
					chart.appendChild(rect);
				}

				console.log("avgGain="+parseFloat(settings.avgGain).toFixed(1));
				console.log("avgLoss="+parseFloat(settings.avgLoss).toFixed(1));
				console.log("maxGain="+parseFloat(settings.maxGain).toFixed(1));
				console.log("maxLoss="+parseFloat(settings.maxLoss).toFixed(1));
				var totalHeight = settings.maxGain+settings.maxLoss;
				if (totalHeight == 0) {
					return;
				}
				var barWidth = 20;
				var barY = 20;
				var barX = (width/2)-barWidth;
				var verticalScale = (height-(2*barY))/totalHeight;
				var baseline = barY+(verticalScale*settings.maxGain);

				//Max gain bar
				var rect = document.createElementNS(svgns, "rect");
				rect.setAttributeNS(null, "x", barX);
				rect.setAttributeNS(null, "y", barY);
				rect.setAttributeNS(null, "height", baseline-barY);
				rect.setAttributeNS(null, "width", barWidth);
				rect.setAttributeNS(null, "fill", "#ada");
				rect.setAttributeNS(null, "stroke-width", "1px");
				rect.setAttributeNS(null, "stroke", "#080");
				chart.appendChild(rect);

				//Average gain bar
				var avgY = verticalScale*(settings.maxGain-settings.avgGain);
				var rect = document.createElementNS(svgns, "rect");
				rect.setAttributeNS(null, "x", barX);
				rect.setAttributeNS(null, "y", avgY);
				rect.setAttributeNS(null, "height", baseline-avgY);
				rect.setAttributeNS(null, "width", barWidth);
				rect.setAttributeNS(null, "fill", "#2c2");
				rect.setAttributeNS(null, "stroke-width", "1px");
				rect.setAttributeNS(null, "stroke", "#080");
				chart.appendChild(rect);

				var path = document.createElementNS(svgns, "path");
				path.setAttribute("d","M "+barX+","+avgY+"	h -8");
				rect.setAttributeNS(null, "stroke-width", "1px");
				path.setAttribute("stroke", "#080");
				chart.appendChild(path);

				// Texts - best gain
				var newText = document.createElementNS(svgns, "text");
				newText.setAttributeNS(null, "x", 30);
				newText.setAttributeNS(null, "y", 8);
				newText.setAttribute("font-weight", "bold");
				newText.setAttribute("font-size", "x-small");
				var textNode = document.createTextNode('Biggest profit: '+settings.maxGain.toFixed(2)+'%');
				newText.appendChild(textNode);
				chart.appendChild(newText);

				// Texts - average gain
				var newText = document.createElementNS(svgns, "text");
				newText.setAttributeNS(null, "x", 12);
				newText.setAttributeNS(null, "y", avgY-6);
				newText.setAttribute("font-weight", "bold");
				newText.setAttribute("font-size", "x-small");
				var textNode = document.createTextNode('Avg. profit:');
				newText.appendChild(textNode);
				chart.appendChild(newText);

				// Texts - average gain
				var newText = document.createElementNS(svgns, "text");
				newText.setAttributeNS(null, "x", 36);
				newText.setAttributeNS(null, "y", avgY+6);
				newText.setAttribute("font-weight", "bold");
				newText.setAttribute("font-size", "x-small");
				var textNode = document.createTextNode(settings.avgGain.toFixed(1)+'%');
				newText.appendChild(textNode);
				chart.appendChild(newText);

				// Max loss bar
				barX += barWidth;
				var rect = document.createElementNS(svgns, "rect");
				rect.setAttributeNS(null, "x", barX);
				rect.setAttributeNS(null, "y", baseline);
				rect.setAttributeNS(null, "height", settings.maxLoss*verticalScale);
				rect.setAttributeNS(null, "width", barWidth);
				rect.setAttributeNS(null, "fill", "#daa");
				rect.setAttributeNS(null, "stroke-width", "1px");
				rect.setAttributeNS(null, "stroke", "#800");
				chart.appendChild(rect);

				//Average loss bar
				var rect = document.createElementNS(svgns, "rect");
				rect.setAttributeNS(null, "x", barX);
				rect.setAttributeNS(null, "y", baseline);
				rect.setAttributeNS(null, "height", settings.avgLoss*verticalScale);
				rect.setAttributeNS(null, "width", barWidth);
				rect.setAttributeNS(null, "fill", "#c22");
				rect.setAttributeNS(null, "stroke-width", "1px");
				rect.setAttributeNS(null, "stroke", "#800");
				chart.appendChild(rect);
				
				var avgY = baseline+(settings.avgLoss*verticalScale);
				var path = document.createElementNS(svgns, "path");
				path.setAttribute("d","M "+(barX+barWidth)+","+avgY+"	h 8");
				rect.setAttributeNS(null, "stroke-width", "1px");
				path.setAttribute("stroke", "#800");
				chart.appendChild(path);

				// Texts - worst loss
				var newText = document.createElementNS(svgns, "text");
				newText.setAttributeNS(null, "x", 68);
				newText.setAttributeNS(null, "y", height-3);
				newText.setAttribute("font-weight", "bold");
				newText.setAttribute("font-size", "x-small");
				var textNode = document.createTextNode('Biggest loss: '+settings.maxLoss.toFixed(2)+'%');
				newText.appendChild(textNode);
				chart.appendChild(newText);

				// Texts - average loss
				var newText = document.createElementNS(svgns, "text");
				newText.setAttributeNS(null, "x", barX+barWidth+12);
				newText.setAttributeNS(null, "y", avgY-6);
				newText.setAttribute("font-weight", "bold");
				newText.setAttribute("font-size", "x-small");
				var textNode = document.createTextNode('Avg. loss:');
				newText.appendChild(textNode);
				chart.appendChild(newText);

				// Texts - average loss
				var newText = document.createElementNS(svgns, "text");
				newText.setAttributeNS(null, "x", barX+barWidth+16);
				newText.setAttributeNS(null, "y", avgY+6);
				newText.setAttribute("font-weight", "bold");
				newText.setAttribute("font-size", "x-small");
				var textNode = document.createTextNode(settings.avgLoss.toFixed(1)+'%');
				newText.appendChild(textNode);
				chart.appendChild(newText);

				$(this).append(chart);
				return this;
		};
}(jQuery));

var decodeBase64 = function(s) {
	var e={},i,b=0,c,x,l=0,a,r='',w=String.fromCharCode,L=s.length;
	var A="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	for(i=0;i<64;i++){e[A.charAt(i)]=i;}
	for(x=0;x<L;x++){
		c=e[s.charAt(x)];b=(b<<6)+c;l+=6;
		while(l>=8){((a=(b>>>(l-=8))&0xff)||(x<(L-2)))&&(r+=w(a));}
	}
	return r;
};

var makeCharts = function(stats) {
	console.log("Making charts");
	$('#winners').empty();
	$('#winners').donutChart({
			width:280,
			percentage: stats.percent_wins,
			Title: ""+stats.num_operations+" operations",
			positiveText: "Profits: "+stats.num_wins,
			negativeText: "Losses: "+stats.num_losses
	});
	$('#ratio').donutChart({
			width:280,
			percentage: stats.win_ratio,
			Title: "",
			positiveText: "Total profit: "+stats.total_gain,
			negativeText: "Total loss: "+stats.total_loss
	});
	$('#market-time').donutChart({
			width:80,
			positiveColor: 'rgb(65,121,204)',
			negativeColor:  '#ccc',
			percentage: stats.percent_in,
			Title: "",
			positiveText: "",
			negativeText: ""
	});
	$('#ganancia').barChart({
		maxGain: stats.max_gain,
		maxLoss: stats.max_loss,
		avgGain: stats.avg_gain,
		avgLoss: stats.avg_loss,
		height: 192,
		width: 200,
	});
};

