@extends('adminlte::page')

@section('title', 'Event Manager')

@section('content_header')
    <h1>Event</h1>
@stop

@section('content')
    <a href="{{ route('event.create') }}" class="btn bg-pink text-default mb-2 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-calendar-plus mr-1"></i>Buat event
    </a>
@php
$typeClasses = [
    'Public' => 'bg-primary',
    'Tömer' => 'bg-info',
    'Internal' => 'bg-success',
    'Private' => 'bg-danger',
];
@endphp

<div class="row">
    @foreach($events as $event)
    <a href="{{route('absensi.show', $event->id)}}" class="rounded my-1 col-12 col-sm-5 mx-sm-1 {{$typeClasses[$event->type]}}">
        <div class="position-relative p-2">
            <div class="text-center bg-dark rounded p-1" style="position: absolute; bottom: 2px; right: 2px;">
                <div>{{$event->absensi->count()}}</div>
                <div><small>Participants</small></div>
            </div>
            <h5 class="card-title font-weight-normal" style="height: 3rem">{{ $event->title }}</h5>
            <div class="card-text"><small>{{ date('j F Y', strtotime($event->datetime)) }}</small></div>
            <p class="card-text text-truncate"><small>{{$event->venue}}.</small></p>
        </div>
    </a>
    @endforeach
</div>

@stop

@section('css')
@stop

@section('js')
@stop