@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
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
                                {{$design->title}} <span class="badge badge-danger float-right">{{$design->status}}</span>
                                </a>
                                <div>{{$design->department}}</div>
                                <pre>PJ       : {{$design->responsible}}
Deadline : {{$design->deadline}}</pre>
                            </div>
                        </li>
                        @empty
                        <p class="item-center">There is no task</p>
                        <a href="/admin/design/create">click here to create request</a>
                        @endforelse
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop