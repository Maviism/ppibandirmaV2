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
                        <i class="fas fa-minus text-light"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @forelse($designRequest as $design)
                        <li class="item">
                                <a href="{{ config('app.url') }}/admin/design/{{$design->id}}/edit" class="product-title">
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
                            @can('medkraf')
                            <a href="/admin/design/{{$design->id}}/edit" class="text-danger text-sm mt-n2">review</a>
                            @endcan
                        </li>
                        @empty
                        <p class="item-center mt-2">There is no task</p>
                        @endforelse
                    </ul>

                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="/admin/design/create" class="uppercase">Create new request</a>
                </div>
            </div>
            <div class="card">
              <div class="card-header bg-teal">
                <h3 class="card-title">member info in last 3 month</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus text-light"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Fulan
                      <span class="float-right text-danger">
                        <i class="fas fa-arrow-down text-sm"></i>
                        Out</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Fulanah
                      <span class="float-right text-success">
                        <i class="fas fa-arrow-up text-sm"></i> In
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Fulani
                      <span class="float-right text-success">
                        <i class="fas fa-arrow-up text-sm"></i> In
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.footer -->
            </div>
        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
<script src="{{ url('/vendor/chart.js/Chart.min.js') }}"></script>
<script>
  let arrivalYearData = {!! json_encode($arrivalYearData->toArray()) !!};
  let ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }
  let arrivalYearChart = $('#visitors-chart')
  new Chart(arrivalYearChart, {
    type : 'bar',
    data : {
      labels: arrivalYearData.map((item)=>item.arrival_year),
      datasets: [{
        label : 'Laki-laki',
        data: arrivalYearData.map((item)=>item.male),
        backgroundColor: '#0d6efd',
      },
      {
        label : 'Perempuan',
        data: arrivalYearData.map((item)=>item.female),
        backgroundColor: '#d63384',
        fill: false
      },
    ]},
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