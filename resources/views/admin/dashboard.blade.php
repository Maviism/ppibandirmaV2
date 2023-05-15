@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
        <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
              <h3 class="card-title">Grafik anggota PPI Bandirma</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex mt-n3">
              <p class="d-flex flex-column">
                <span class="text-bold text-lg">{{ $educationStatus->whereIn('status', ['Kuliah', 'Tömer'])->sum('count') }} <span class="fw-semibold text-md">({{ $educationStatus->where('status', 'Lulus')->sum('count') }})</span></span>Total anggota
              </p>
              <!-- <p class="ml-auto d-flex flex-column text-right">
              <span class="text-success">
                  <i class="fas fa-arrow-up"></i> 12.5%
              </span>
              <span class="text-muted">Since last year</span>
              </p> -->
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
        </div>
        <div class="col-md-4">
            <!-- DESIGN REQUEST LIST -->
            <div class="card">
                <div class="card-header bg-pink">
                    <h3 class="card-title">Design Request Task</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @forelse($designRequest as $design)
                        <li class="item">
                            <div class="">
                                <a href="javascript:void(0)" class="product-title">
                                {{$design->title}} 
                                @if($design->status == 'reject')
                                <span class="badge badge-danger float-right">{{$design->status}}</span>
                                @elseif($design->status == 'pending')
                                <span class="badge badge-warning float-right">{{$design->status}}</span>
                                @else
                                <span class="badge badge-success float-right">{{$design->status}}</span>
                                @endif

                                </a>
                                <div>{{$design->department}}</div>
                                <pre>PJ       : {{$design->responsible}}
Deadline : {{$design->deadline}}</pre>
                            </div>
                        </li>
                        @empty
                        <p class="item-center">There is no task</p>
                        @endforelse
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="/admin/design/create" class="uppercase">Create new request</a>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
@section('plugins.Chartjs', true)
<script>
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
          suggestedMax: 60,
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