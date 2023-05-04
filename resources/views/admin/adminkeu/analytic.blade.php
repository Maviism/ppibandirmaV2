@extends('adminlte::page')

@section('title', 'Analytic')

@section('content_header')
    <h1>Analytic</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
              <h3 class="card-title">Data anggota PPI Bandirma</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex mt-n3">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">820</span>Total anggota
              </p>
              <p class="ml-auto d-flex flex-column text-right">
              <span class="text-success">
                  <i class="fas fa-arrow-up"></i> 12.5%
              </span>
              <span class="text-muted">Since last year</span>
              </p>
          </div>
        <div class="position-relative mb-4">
            <canvas id="visitors-chart" height="200"></canvas>
        </div>
        <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
            <i class="fas fa-square text-primary"></i> Laki-laki : {{$arrivalYearData->sum('male')}}
            </span>

            <span>
            <i class="fas fa-square text-pink"></i> Perempuan : {{$arrivalYearData->sum('female')}}
            </span>
        </div>
        </div>
    </div>
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Persebaran kampus</h3>
        </div>
      </div>
      <div class="card-body">
        
      <p class="mb-n1">Bandırma on yedi eylul</p>
      <x-adminlte-progress theme="primary" value=95/>
      <p class="mb-n1 mt-1">Çanakale on sekiz univ</p>
      <x-adminlte-progress theme="purple" value=52/>

      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Jenjang pendidikan</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="chart-responsive">
              <canvas id="education-type" height="150"></canvas>
            </div>
            <!-- ./chart-responsive -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Status pendidikan</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="chart-responsive">
              <canvas id="education-status" height="150"></canvas>
            </div>
            <!-- ./chart-responsive -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
    </div>
    <canvas id="doughnut-chart"></canvas>

  </div>

</div>
@stop

@section('css')
@stop

@section('js')
@section('plugins.Chartjs', true)
<script>
  var educationStatusData = {!! json_encode($educationStatus->toArray()) !!};
  var educationTypeData = {!! json_encode($educationType->toArray()) !!};

  var jenjangPendidikanData = {
    labels: educationTypeData.map((item)=>item.type_of_education),
    datasets: [
      {
        data: educationTypeData.map((item)=>item.count),
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
      }
    ]
  }

  var statusPendidikanData = {
    labels: educationStatusData.map((item)=>item.status),
    datasets: [
      {
        data: educationStatusData.map((item)=>item.count),
        backgroundColor: ['#f56954', '#3c8dbc', '#00c0ef' ,  ]
      }
    ]
  }

  Chart.register(ChartDataLabels);

  var DoughnutOptions = {
    tooltips: {
          enabled: true
      },
    plugins: {
      datalabels: {
        formatter: (value, ctx) => {
            let datasets = ctx.chart.data.datasets;
            if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
              let sum = datasets[0].data.reduce((a, b) => a + b, 0);
              let percentage = Math.round((value / sum) * 100) + '%';
              return `${value} (${percentage})`;
            } else {
              return value;
            }
          },
          color: '#fff'
      },
      legend: {
        display: true,
        position: 'top',
        alignt: 'start',
        labels: {
          font : {
            size: 16
          },
          color : '#181818',
          usePointStyle : true
        }
      }
    },
  };

  var ctx = $('#education-type');
  var educationTypeChart = new Chart(ctx, {
        type: 'doughnut',
        data: jenjangPendidikanData,
        options: DoughnutOptions
  });

  var educationStatusCanvas = $('#education-status');
  var educationStatusChart = new Chart(educationStatusCanvas, {
        type: 'doughnut',
        data: statusPendidikanData,
        options: DoughnutOptions
  });

  var arrivalYearData = {!! json_encode($arrivalYearData->toArray()) !!};
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }
  var $arrivalYearChart = $('#visitors-chart')
  var arrivalYearChart = new Chart($arrivalYearChart, {
    data: {
      labels: arrivalYearData.map((item)=>item.arrival_year),
      datasets: [{
        type: 'line',
        data: arrivalYearData.map((item)=>item.male),
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: arrivalYearData.map((item)=>item.female),
        backgroundColor: 'tansparent',
        borderColor: '#E83E8C',
        pointBorderColor: '#E83E8C',
        pointBackgroundColor: '#E83E8C',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }]
    },
    options: {
      plugins : {
        legend: {
          display: false
        },
        tooltips: {
          mode: 'index',
          intersect: true
        },
        hover: {
          mode: 'index',
          intersect: true
        },
        maintainAspectRatio: false,
      },
      scales: {
        y: {
          suggestedMax: 70,
          grid: {
            display: false
          }
        },
        x: {
          display: true,
          grid: {
            display: false
          },
          ticks: {
            font: {
              weight : 'bold',
            }
          }
          
        }
      }
    }
  })

</script>
@stop