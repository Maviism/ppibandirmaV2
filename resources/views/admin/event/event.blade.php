@extends('adminlte::page')

@section('title', 'Event Manager')

@section('content_header')
    <h1>Event</h1>
@stop

@section('content')
    <a href="{{ route('event.create') }}" class="btn btn-primary text-default mb-2 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-calendar-plus mr-1"></i>Buat event
    </a>


    <div class="card card-primary">
        <div class="card-body">
        <div>
            <div class="btn-group w-100 mb-2">
                <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All events </a>
                <a class="btn btn-info" href="javascript:void(0)" data-filter="Public"> Public </a>
                <a class="btn btn-info" href="javascript:void(0)" data-filter="Tömer"> Tömer </a>
                <a class="btn btn-info" href="javascript:void(0)" data-filter="Internal"> Internal </a>
                <a class="btn btn-info" href="javascript:void(0)" data-filter="4"> Private </a>
            </div>
            <div class="mb-5">
                <div class="float-left">
                    <select class="custom-select" style="width: auto;" data-sortOrder>
                        <option value="index"> Sort by Year </option>
                        <option value="sortData"> 2022 </option>
                        <option value="sortData"> 2023 </option>
                    </select>
                    <div class="btn-group">
                        <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                        <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="filter-container p-0 row">
            @foreach($events as $event)
            <div class="filtr-item col-sm-3" data-category="{{$event->type}}" data-sort="white sample">
<!-- start -->
                    <div class="card-body shadow-sm">
                        <div class="position-relative">
                                <div>
                                    <div class="btn btn-xs btn-primary px-2">{{$event->type}}</div>
                                    <div class="card-text text-gray">{{$event->datetime}}</div>
                                </div>
                                <div>
                                    <h5 class="card-title text-bold">{{ $event->title }}</h5>
                                    <p class="card-text">{{$event->venue}}.</p>
                                </div>
                            <div class="" style="position: absolute; top: 0; right: 0;">
                                <div class="mb-n2 text-lg text-bold text-success">{{ number_format($event->absensi->count()/$event->total_participants*100, 2) }}<span class="text-sm">%</span></div>
                                <div>{{ $event->absensi->count()}}/{{$event->total_participants}}</div> 
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('event.edit', $event->id)}}" class="btn btn-warning mr-lg-2"><i class="fa fa-fw fa-pen"></i> Edit</a>
                        <a href="{{route('absensi.show', $event->id)}}" class="btn bg-teal text-default"><i class="fa fa-fw fa-user-check"></i> Absensi</a>
                    </div>
            <!-- end -->
            </div>
            @endforeach
            </div>
        </div>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@section('plugins.Filterizr', true)
<script> 
    $('.filter-container').filterizr({gutterPixels: 3});
    
    $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
    }); 
</script>
@stop