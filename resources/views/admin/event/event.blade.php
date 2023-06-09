@extends('adminlte::page')

@section('title', 'Event Manager')

@section('content_header')
    <h1>Event</h1>
@stop

@section('content')
    <a href="{{ route('event.create') }}" class="btn btn-primary text-default mb-2 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-calendar-plus mr-1"></i>Buat event
    </a>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <!-- This is what the search control looks like -->
        <div>
            <div class="btn-group w-100 mb-2">
                <a class="btn bg-pink active" href="javascript:void(0)" data-filter="all"> All </a>
                <a class="btn btn-primary" href="javascript:void(0)" data-filter="Public"> Public </a>
                <a class="btn btn-info" href="javascript:void(0)" data-filter="Tömer"> Tömer </a>
                <a class="btn btn-success" href="javascript:void(0)" data-filter="Internal"> Internal </a>
                <a class="btn btn-danger" href="javascript:void(0)" data-filter="4"> Private </a>
            </div>
            <div class="px-0 px-lg-2 row justify-content-between">
                <div>
                    <select class="custom-select" style="width: auto;" data-sortOrder id="yearSelect">
                        <option value="index"> Sort by Year </option>
                        <option value="2022"> 2022 </option>
                        <option value="2023"> 2023 </option>
                        <option value=""> All </option>
                    </select>
                    <div class="btn-group">
                        <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                        <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                    </div>
                </div>
                <div class="float-right mb-2 mb-lg-0">
                    <x-adminlte-input type="text" name="search" class="mt-2 mt-lg-0" placeholder="Search..." data-search />
                </div>
            </div>
        </div>
        <div>
            <div class="filter-container p-0 row">
            @php
            $typeClasses = [
                'Public' => 'bg-primary',
                'Tömer' => 'bg-info',
                'Internal' => 'bg-success',
                'Private' => 'bg-danger',
            ];
            @endphp
            @foreach($events as $event)
            <div class="filtr-item col-sm-4 " data-category="{{$event->type}}" data-sort="{{date('Y', strtotime($event->datetime))}}">
                <div class="card">
                    <div class="position-relative px-2">
                        <div class="" style="position: absolute; top: 0; right: 4px;">
                            @if ($event->total_participants > 0)
                                <div class="mb-n2 text-lg text-bold text-success">{{ number_format($event->absensi->count()/$event->total_participants*100, 2) }}<span class="text-sm">%</span></div>
                            @else
                                <div class="mb-n2 text-lg text-bold text-success">0.00<span class="text-sm">%</span></div>
                            @endif
                            <div>{{ $event->absensi->count()}}/{{$event->total_participants}}</div>
                        </div>
                        <div>
                            <div class="btn btn-xs {{$typeClasses[$event->type]}} px-2 mt-1">{{$event->type}}</div>
                            <div class="card-text text-gray mt-2">{{ date('j F Y H:i', strtotime($event->datetime))  }}</div>
                        </div>
                        <div>
                            <h5 class="card-title font-weight-normal" style="height: 4rem">{{ $event->title }}</h5>
                            <p class="card-text text-truncate"><small>{{$event->venue}}.</small></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('event.edit', $event->id)}}" class="btn btn-warning btn-sm mr-1"><i class="fa fa-fw fa-pen"></i> Edit</a>
                        <a href="{{route('absensi.show', $event->id)}}" class="btn bg-purple btn-sm text-default"><i class="fa fa-fw fa-user-check"></i> Absensi</a>
                    </div>
                </div>
            <!-- end -->
            </div>
            @endforeach
            </div>
        </div>

        </div>
    </div>
</div>
</div>
@stop

@section('css')
@stop

@section('js')
@section('plugins.Filterizr', true)
<script> 
    $('.filter-container').filterizr({gutterPixels: 4});
    
    $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
    }); 

    $(document).ready(function() {
        $('#yearSelect').change(function() {
            var selectedYear = $(this).val();
            if (selectedYear !== 'index') {
                var baseUrl = window.location.origin;
                var url = baseUrl + "/admin/event?year=" + selectedYear;
                window.location.href = url;
            }
        });
    });
</script>
@stop