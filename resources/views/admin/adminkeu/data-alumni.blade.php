@extends('adminlte::page')

@section('title', 'Data Alumni')

@section('content_header')
    <h1>Data Alumni</h1>
@stop

@section('content')
    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table2" :heads="[
            ['label' => 'ID', 'width'=> 2 ],
            'Name',
            'Phone',
            ['label' => 'Angkatan', 'width' => 5],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ]" head-theme="dark" striped hoverable bordered compressed with-buttons>
        @foreach($graduatedUsers as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->arrival_year }}</td>
                <td style="white-space: nowrap;">
                    <a href="{{ route('dataanggota.edit', $user)}}" class="btn btn-xs btn-default text-primary shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    <hr>
    <hr>
    <div class="h5">Anggota yg pindah</div>
    <x-adminlte-datatable id="table-moved" :heads="[
            ['label' => 'ID', 'width'=> 2 ],
            'Name',
            'Angkatan',
            'Reason',
        ]" striped hoverable bordered compressed with-buttons>
        @foreach($deletedUsers as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->arrival_year}}</td>
                <td>{{ $user->reason}}</td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@section('css')
@stop

@section('js')
@section('plugins.DatatablesPlugins', true)
@stop