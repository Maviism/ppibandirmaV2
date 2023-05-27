@extends('adminlte::page')

@section('title', 'Data Anggota')

@section('content_header')
    <h1>Data Anggota</h1>
@stop
@section('content')
    <div class="mb-3 row">
        <a href="{{ route('dataanggota.create') }}" class="btn btn-primary text-default mx-1 shadow" title="Edit">
            <i class="fa fa-lg fa-fw fa-user-plus mr-1"></i>Tambah Anggota
        </a>
        <button type="button" class="btn bg-purple text-default mx-1 shadow position-relative" data-toggle="modal" data-target="#konfirmasiAnggota">
            <i class="fa fa-lg fa-fw fa-user-check"></i>Konfirmasi User
            <span class="position-absolute top-0 start-100 badge rounded-pill bg-danger text-md" style="transform: translate(-0%, -40%);">
                {{$unapprovedUser->count()}}
            </span>
        </button>
        <x-adminlte-modal id="konfirmasiAnggota" title="Review information" theme="purple" icon="fas fa-user-check" size='lg'>
            <x-adminlte-datatable id="table1" :heads="[
                    'Name',
                    ['label' => 'Angkatan', 'width' => 5],
                    ['label' => 'Actions', 'no-export' => true, 'width' => 1],
                ]" hoverable bordered compressed>
                @foreach($unapprovedUser as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->arrival_year }}</td>
                        <td style="white-space: nowrap;">
                            <a href="/admin/datareview/{{$user->id}}" class="btn btn-xs btn-danger shadow" title="Edit">
                                Review
                                <i class="fa fa-lg fa-fw fa-exclamation-circle"></i>
                            </a>
                        </td>
                        
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </x-adminlte-modal>
    </div>
<div class="pb-4">
    <x-adminlte-datatable id="table2" :heads="[
            ['label' => 'No', 'width'=> 2 ],
            'Name',
            'Phone',
            'Status',
            'Jenjang',
            'University',
            'Faculty',
            ['label' => 'Angkatan', 'width' => 5],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ]" head-theme="dark" striped hoverable bordered compressed with-buttons>
        @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-capitalize">{{ strtolower($user->name) }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->type_of_education }}</td>
                <td>{{ $user->university }}</td>
                <td>{{ $user->faculty }}</td>
                <td>{{ $user->arrival_year }}</td>
                <td style="white-space: nowrap;">
                    <a href="{{ route('dataanggota.edit', $user)}}" class="btn btn-xs btn-default text-primary shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    <button onclick="deleteAnggota({{$user->id}},'{{$user->name}}')" id="deleteAnggota" class="btn btn-xs btn-default text-danger shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                </td>
                
            </tr>
        @endforeach
    </x-adminlte-datatable>
</div>    

@stop

@section('css')
@stop

@section('js')
@can('adminkeu')
@section('plugins.DatatablesPlugins', true)
@endcan
@if(Session::has('success'))
    <script>
        $(document).ready(function(){
            Swal.fire({
                title: 'Berhasil',
                text: '{{ Session::get("success")}}',
                icon: 'success'
            })
        })
    </script>
@endif
@if(Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ Session::get("error") }}',
        });
    </script>
@endif
<script>
    function deleteAnggota(id, name){
        Swal.fire({
            title: `yakin ingin menghapus data ${name}?`,
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
                placeholder: 'masukan alasan|contoh: pindah, pulang ke indo, dll'
            },
            showCancelButton: true,
            confirmButtonText: 'Hapus anggota ini',
            confirmButtonColor : '#dc3545',
            showLoaderOnConfirm: true,
            preConfirm: (reason) => {
                return fetch(`/admin/dataanggota/${id}?reason=${reason}`,{
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => {
                    if (!response.ok) {
                    throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                    `Request failed: ${error}`
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                title: result.value.message,
                timer: 5000,
                didClose: () => {
                    location.reload(); // reload the page after the delay
                }
                });
            }
        })
    }
    
</script>

@stop