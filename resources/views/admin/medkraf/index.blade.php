@extends('adminlte::page')

@section('title', 'List Request Design')

@section('content_header')
    <h1>List Request Design Medkraf</h1>
@stop

@section('content')
<div class="card bg-white p-2">

<x-adminlte-datatable id="table2" :heads="[
        ['label' => 'Act', 'no-export' => true, 'width' => 5],
        'status',
        'deadline',
        'judul',
        'Departemen',
    ]" >
    @foreach($designs as $design)
    <tr class="table-row">
        <td>
          <a href="{{route('design.edit', $design->id)}}" class="btn btn-primary btn-sm">Detail</a>
        </td>
        <td>
            @if($design->status == 'approved')
            <button class="btn btn-sm btn-success">{{$design->status}}</button> 
            @elseif($design->status == 'reject')
            <button class="btn btn-sm btn-danger">rejected</button> 
            @else
            <button class="btn btn-sm btn-warning">{{$design->status}}</button> 
            @endif
        </td>
        <td>{{$design->deadline}}</td>
        <td>{{$design->title}}</td>
        <td>{{$design->department}}</td>
    </tr>
    @endforeach
</x-adminlte-datatable>

<!-- /.card -->
@stop

@section('css')
@stop

@section('js')

@stop