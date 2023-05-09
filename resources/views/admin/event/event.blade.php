@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Event</h1>
@stop

@section('content')
    <a href="{{ route('event.create') }}" class="btn btn-primary text-default mb-2 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-calendar-plus mr-1"></i>Buat event
    </a>
    <div class="card mt-1">
        <div class="card-header">
            Filter(soon)
        </div>
        <div class="card-body">
            <div class="row">
            @foreach($events as $event)
            <div class="col-12 col-md-4">
                <div class="card mr-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <p class="btn btn-xs btn-primary px-2">{{$event->type}}</p>
                                <div>
                                    <h5 class="card-title text-bold">{{ $event->title }}</h5>
                                    <p class="card-text">{{$event->venue}}.</p>
                                    <p class="card-text text-gray">{{$event->datetime}}</p>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <p class="text-lg text-bold text-success">{{ number_format($event->absensi->count()/$event->total_participants*100, 2) }}%</p>
                                <p>{{ $event->absensi->count()}}/ {{$event->total_participants}}</p> 
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('event.edit', $event->id)}}" class="btn btn-warning mr-2"><i class="fa fa-fw fa-pen"></i> Edit</a>
                        <a href="{{route('absensi.show', $event->id)}}" class="btn bg-teal text-default"><i class="fa fa-fw fa-user-check"></i> Absensi</a>
                    </div>
                </div>
            </div>
            @endforeach
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