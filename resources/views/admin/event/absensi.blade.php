@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Absensi {{$event->title}}</h1>
@stop

@section('content')
    <a href="{{ route('absen.scanner', $event->id)}}" class="btn bg-purple mb-1"><i class="fa fa-lg fa-qrcode mr-1"></i>Scan peserta</a>
    <a href="" class="btn btn-primary mb-1">Manual input</a>
    <x-adminlte-datatable id="table2" :heads="[
            ['label' => 'No', 'width'=> 2 ],
            'Name',
            'Datetime',
            'Angkatan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ]" head-theme="dark" striped hoverable bordered compressed with-buttons>

    </x-adminlte-datatable>
@stop

@section('css')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop