<template>
  <div class="demo">

    <ul class="list-group">
<!--      <li class="list-group-item" v-for="item in data">-->
<!--        <span class="badge badge-primary">#{{ item.id }}</span> {{ item.name }}-->
<!--      </li>-->
      {{ids}}
    </ul>

<!--    <input v-model="message" placeholder="отредактируй меня">-->
<!--    <p>Введённое сообщение: {{ message }}</p>-->
        <datepicker :format="customDate" v-model="time" @input="dateSelected()"></datepicker>

    doctor
    {{time}}
    {{ids}}



    <div id="chart_mini" style="height: 100px; padding-top: 10px"></div>
  </div>

</template>

<script>
var ids = 1;
var _time;
var chart;
var old_date;
var options;
var path = '/charts/fetch-data-test/'+ids+'/'+moment().format('YYYY-MM-DD');
import datepicker from 'vuejs-datepicker';
import moment from 'moment';

export default {
  props: ['id_s'],
  data(){
    return{
        time:moment().format('YYYY-MM-DD'),
        ids: this.id_s,

    }
  },
  components:{
    datepicker
  },
  methods:{
      customDate(date){
        _time = this.time;
      //   console.log(_time);
         return this.time = moment(date).format('YYYY-MM-DD');
      },
    dateSelected () {

     // this.$nextTick(() => _time = this.time);
      console.log(this.time);
      _time = moment(this.time).format('YYYY-MM-DD');
      path = '/charts/fetch-data-test/'+ids+'/'+_time;
      console.log(path);
      $.getJSON({
        url: path,
        method: 'GET',
        success: function (data) {

          options.series[0].data = data;
          chart = new Highcharts.Chart(options);
          old_date = data[data.length-1][0];
          if (data[0][1]<=1.00) {
            chart.series[0].color = "rgba(70,183,78,0.5)";
            chart.series[0].redraw();
          }
          if (data[0][1]<=0.80) {
            chart.series[0].color = "#fae6ae";
            chart.series[0].redraw();
          }
          if (data[0][1]<=0.50) {
            chart.series[0].color = "#f2b140";
            chart.series[0].redraw();
          }
          if (data[0][1]<=0.20) {
            chart.series[0].color = "rgba(234,87,87,0.5)";
            chart.series[0].redraw();
          }

        }
      });
    },
  },
  mounted () {
    // Как-то обрабатываем данные
    // console.log(ids=this.ids),
    ids=this.ids
  },

}

//console.log(_time);
console.log(path);
$(document).ready(function() {

  // console.log(ids_to_kv);

  options = {
    title: {
      text: 'Интегральный показатель ОПО' ,
      style: {
        display: 'none'
      }
    },
    chart: {
      renderTo: 'chart_mini',
      type: 'area',
      plotAreaWidth: 300,
      plotAreaHeight: 75,


      events: {
        load: function () {
          var series = this.series[0];
          setInterval(() => {
            $.getJSON({
              url: path,
              method: 'GET',
              success: function (data) {
                   if (data[data.length-1][0] > old_date) {
                  var x = data[data.length - 1][0],
                      y = data[data.length - 1][1];
                  series.addPoint([x, y], true, true);
                  old_date = data[data.length-1][0];
                     if (data[0][1]<=1.00) {
                       series.color = "rgba(70,183,78,0.5)";
                       series.redraw();
                     }
                     if (data[0][1]<=0.80) {
                       series.color = "#fae6ae";
                       series.redraw();
                     }
                     if (data[0][1]<=0.50) {
                       series.color = "#f2b140";
                       series.redraw();
                     }
                     if (data[0][1]<=0.20) {
                       series.color = "rgba(234,87,87,0.5)";
                       series.redraw();
                     }
                  console.log('Внутри');
                }

              }

            });
          }, 10000);
        }
      }
    },
    xAxis: {
      type: 'datetime',
      gridLineWidth: 1
    },
    legend: {
      enabled: false
    },

    yAxis: {
      min: 0,
      max: 1,
      title: {
        text: 'Интегральный показатель',
        style: {
          display: 'none'
        }
      },
      labels: {
        enabled:false
      },
      minorGridLineWidth: 0,
      gridLineWidth: 0,
      alternateGridColor: null,

    },
    credits: {
      enabled: false
    },

    series: [{
      name: 'Текущий показатель',
      marker: {
        enabled: false
      },
    }]
  };
  $.getJSON({
    url: path,
    method: 'GET',
    success: function (data) {

      options.series[0].data = data;
      chart = new Highcharts.Chart(options);
      old_date = data[data.length-1][0];
      if (data[0][1]<=1.00) {
        chart.series[0].color = "rgba(70,183,78,0.5)";
        chart.series[0].redraw();
      }
      if (data[0][1]<=0.80) {
        chart.series[0].color = "#fae6ae";
        chart.series[0].redraw();
      }
      if (data[0][1]<=0.50) {
        chart.series[0].color = "#f2b140";
        chart.series[0].redraw();
      }
      if (data[0][1]<=0.20) {
        chart.series[0].color = "rgba(234,87,87,0.5)";
        chart.series[0].redraw();
      }

    }
  });

});

</script>

<style scoped>

</style>