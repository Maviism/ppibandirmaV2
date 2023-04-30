@extends('adminlte::page')

@section('title', 'Data Anggota')

@section('content_header')
    <h1>Data Anggota</h1>
@stop

@section('content')
    <p>Should be data anggota.</p>
    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table2" :heads="[
            'ID',
            'Name',
            ['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ]" head-theme="dark" striped hoverable bordered compressed with-buttons>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>
                    <nobr>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </nobr>
                </td>
                
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop