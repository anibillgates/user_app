$(function () {
	"use strict";
	
	// chart 6
	Highcharts.chart('chart61', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: 0,
			styledMode: true,
			plotShadow: false
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Browser<br>shares<br>2017',
			align: 'center',
			verticalAlign: 'middle',
			y: 60
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				dataLabels: {
					enabled: true,
					distance: -50,
					style: {
						fontWeight: 'bold',
						color: 'white'
					}
				},
				startAngle: -90,
				endAngle: 90,
				center: ['50%', '75%'],
				size: '110%'
			}
		},
		series: [{
			type: 'pie',
			name: 'Browser share',
			innerSize: '50%',
			data: [
				['Chrome', 10],
				['Firefox', 20],
				['Internet Explorer', 10],
				['Edge',5 ],
				['Safari', 60], 
				// {
				// 	name: 'Other',
				// 	y: 7.61,
				// 	dataLabels: {
				// 		enabled: false
				// 	}
				// }
			]
		}]
	});
	
});