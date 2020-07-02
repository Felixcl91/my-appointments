@extends('layouts.panel')

@section('content')
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Reporte: Médicos mas activos</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div id="container"></div>
        </div>    
</div>
@endsection

@section('scripts')
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script>
const chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Médicos mas activos'
    },
    xAxis: {
        categories: [],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Citas atendidas'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: []
  });

  function fetchData() {

    //Fetch Api
    fetch('/charts/doctors/column/data')
    .then(function(response) {
      return response.json();
    })
    .then(function(data) {
      //console.log(data);
      chart.xAxis[0].setCategories(data.categories);
      chart.addSeries(data.series[0]); // atendiadas
      chart.addSeries(data.series[1]);  // canceladas
    });

  }

  $(function () {
    fetchData();
  });

  </script>

  
  
@endsection