$(document).ready(function() {

	 // var options = {
     var chart = {
         type: 'column'
     };
     var title= {
         text: 'Показатель эффективности производственного контроля на ОПО'
     };
     var xAxis= {
         type: 'category',
         labels: {
             rotation: -45,
             style: {
                 fontSize: '13px',
                 fontFamily: 'Verdana, sans-serif'
             }
         }
     };
     var yAxis= {
         min: 0,
         max: 100,
         title: {
             text: 'Показатель эффективности'
         }
     };
     var legend= {
         enabled: false
     };
     var tooltip= {
         pointFormat: 'Эффективность производственного контроля: <br> <b>{point.y:.1f} %</b>'
     };
     var series= [{
         name: 'Population',
         data: [
             ['1 квартал', 95.2],
             ['2 квартал', 93.8],
             ['3 квартал', 87.9],
             ['4 квартал', 97.7],

         ]
         // dataLabels: {
         //     enabled: true,
         //     rotation: -90,
         //     color: '#FFFFFF',
         //     align: 'right',
         //     format: '{point.y:.1f}', // one decimal
         //     y: 10, // 10 pixels down from the top
         //     style: {
         //         fontSize: '13px',
         //         fontFamily: 'Verdana, sans-serif'
         //     }
         // }
     }];
     var json = {};
   json.chart = chart;
   json.title = title;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;

 $('#chart2').highcharts(json);
});
