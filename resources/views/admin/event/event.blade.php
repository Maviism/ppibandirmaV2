@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Event</h1>
@stop

@section('content')
    <a href="{{ route('event.create') }}" class="btn btn-primary text-default mx-1 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-calendar-plus mr-1"></i>Buat event
    </a>
    <div class="card mt-1">
        <div class="card-header">
            Hello
        </div>
        <div class="card-body">
            <div class="row">
            @foreach($events as $event)
            <div class="col-12 col-md-4">
                <div class="card mr-2">
                    <div class="card-body">
                        <h5 class="card-title text-bold">{{ $event->title }}</h5>
                        <p class="card-text">{{$event->description}}.</p>
                        <p class="card-text text-gray">{{$event->datetime}}</p>
                        <div>
                            <a href="{{route('event.edit', $event->id)}}" class="btn btn-primary"><i class="fa fa-fw fa-pen"></i></a>
                            <a href="{{route('absensi.show', $event->id)}}" class="btn btn-warning text-success"><i class="fa fa-fw fa-user-check"></i></a>
                        </div>
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