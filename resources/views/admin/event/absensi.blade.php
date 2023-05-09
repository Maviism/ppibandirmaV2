@extends('adminlte::page')

@section('title', 'Absensi')

@section('content_header')
    <h1>Absensi {{$event->title}}</h1>
@stop

@section('content')
    <a href="/admin/event" class="btn btn-info mb-1"><i class="fa fa-lg fa-chevron-left mr-1"></i>Kembali</a>
    <div>
        <a href="{{ route('absen.scanner', $event->id)}}" class="btn bg-purple mb-1"><i class="fa fa-lg fa-qrcode mr-1"></i>Scan peserta</a>
        <button type="button" class="btn bg-purple text-default mx-1 shadow mb-1" data-toggle="modal" data-target="#manualAbsensi">
            <i class="fa fa-lg fa-fw fa-user-check"></i>Absensi manual
        </button>
    </div>
        <x-adminlte-modal id="manualAbsensi" title="Absensi manual" theme="purple" icon="fas fa-user-check" size='lg'>
        <x-adminlte-datatable id="table1" :heads="[
                'Name',
                ['label' => 'Angkatan', 'width' => 5],
                ['label' => 'Actions', 'no-export' => true, 'width' => 1],
            ]" hoverable bordered compressed>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td style="white-space: nowrap;">
                        <form class="form-hadir" action="{{ route('absensi.store', $user->id) }}" method="POST">
                            @csrf
                            <input type="text" name="iEventId" value="{{$event->id}}" hidden>
                            <button type="submit" class="btn btn-xs btn-success shadow">
                                Hadir
                                <i class="fa fa-lg fa-fw fa-check-circle"></i>
                            </button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </x-adminlte-modal>
    <x-adminlte-datatable id="tAbsensi" :heads="[
            ['label' => 'No', 'width'=> 2 ],
            'Name',
            'Datetime',
            'Angkatan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ]" head-theme="dark" striped hoverable bordered compressed with-buttons>
        @foreach($registeredUsers as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->user->name }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->user->education->arrival_year }}</td>
                    <td style="white-space: nowrap;">
                    <form action="{{ route('absensi.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <input type="text" name="iEventId" value="{{$event->id}}" hidden>
                        <button type="submit" class="btn btn-xs btn-danger shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                    </td>
                    
                </tr>
        @endforeach
    </x-adminlte-datatable>
    <button class="btn btn-danger"><i class="fa fa-lg fa-fw fa-lock"></i>Lock</button>
@stop

@section('css')
@stop

@section('js')
<script>
    $('.form-hadir').submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var token = $('meta[name="csrf-token"]').attr('content');
        var iEventId = $('input[name="iEventId"]').val();

        $.ajax({
            url: url,
            method: method,
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                iEventId: iEventId // include the value in the data parameter
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Absen Berhasil',
                    text: response.message,
                    // timer: 2000
                })
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Absen Gagal',
                    text: response.responseJSON.message,
                    // timer: 2000
                });
            }
        });
    });
</script>
@stop