$(document).ready(function() {

	 // var options = {
     var chart = {
         type: 'column'
     };
     var title= {
         text: 'Количество событий ПБ С1-С4 на ОПО'
     };
     var xAxis= {
         type: 'category',
         categories: ['1 квартал', '2 квартал', '3 квартал', '4 квартал'],
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
         title: {
             text: 'Количество'
         }
     };
     var legend= {
         enabled: false
     };
     var tooltip= {
         pointFormat: 'Количество событий: <b> {series.name} =  {point.y}</b>'
     };
     var series= [{
         type: 'column',
         name: 'С1',
         data: [3, 2, 1, 1],
         color: '#e09191'
     },
         {
             type: 'column',
             name: 'С2',
             data: [2, 3, 5, 0],
             color: '#e9b47d'
         }, {
             type: 'column',
             name: 'С3',
             data: [1, 3, 3, 2],
             color: '#dbde83'
         }, {
             type: 'column',
             name: 'C4',
             data: [4, 3, 10, 9],
             color: '#95ea8e'
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

 $('#chart4').highcharts(json);
});
