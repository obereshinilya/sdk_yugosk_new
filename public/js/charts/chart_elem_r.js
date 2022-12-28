$(document).ready(function() {
   var    chart= {
                 type: 'spline'
            };
   var title = {
      text: 'Обобщенный показатель превышения пределов безопасности'
   };
   var xAxis = {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
         'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
   };
   var yAxis = {

      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }],
      min:0,
      max:1,
      title: {
                 text: ''
             },
      minorGridLineWidth: 0,
      gridLineWidth: 0,
      alternateGridColor: null,
      plotBands: [{ // Light air
                 from: 0,
                 to: 0.2,
                 color: 'rgba(250, 128, 114, 0.4)',
                 label: {
                     text: 'Высокий риск',
                     style: {
                         color: '#606060'
                     }
                 }
             }, { // Light breeze
                 from: 0.2,
                 to: 0.5,
                 color: 'rgba(255, 165, 0, 0.4)',
                 label: {
                     text: 'Средний риск',
                     style: {
                         color: '#606060'
                     }
                 }
             }, { // Gentle breeze
                 from: 0.5,
                 to: 0.8,
                 color: 'rgba(240, 230, 140, 0.6)',
                 label: {
                     text: 'Низкий риск',
                     style: {
                         color: '#606060'
                     }
                 }
             }, { // Moderate breeze
                 from: 0.8,
                 to: 1.0,
                 color: 'rgba(152, 251, 152, 0.3)',
                 label: {
                     text: 'Работа штатно',
                     style: {
                         color: '#606060'
                     }
                 }
             }]
   };

   var tooltip = {
      valueSuffix: ''
   };
   var legend = {
          enabled: false
   };
   var series =  [{
         name: 'OP_r',
         data: [0.95, 0.91, 0.85, 0.8, 0.75, 0.75, 0.8,
            0.8, 0.8, 0.85, 0.87, 0.92],
          marker: {
            enabled: false
                  }   
      }
   ];
   
   var json = {};
   json.chart = chart;
   json.title = title;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;
   

   $('#chart3').highcharts(json);
});
