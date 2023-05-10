@extends('adminlte::page')

@section('title', 'Edit Kabinet')

@section('content_header')
    <h1>Edit Kabinet</h1>
@stop

@section('content')
<div class="row justify-content-between mx-1">
    <a href="/admin/kabinet" class="btn btn-info mb-2"><i class="fa fa-md fa-chevron-left"></i> Kembali</a>
    <button onclick="deleteKabinet({{$kabinet->id}},'{{$kabinet->name}}')" class="btn btn-danger mb-2"><i class="fa fa-md fa-trash"></i> Delete</button>
</div>
<section class="content">
    <form method="POST" action="{{ route('kabinet.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Kabinet form</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <x-adminlte-input name="iName" label="Nama kabinet" placeholder="contoh : HepsiBurada" value="{{$kabinet->name}}" enable-old-support/>
                    <x-adminlte-input name="iPeriode" label="Periode" placeholder="contoh : 2021-2022" value="{{$kabinet->periode}}" enable-old-support/>
                    <x-adminlte-textarea name="iDescription" label="Description" rows=3 placeholder="Insert description..." enable-old-support>
                        {{$kabinet->description}}
                    </x-adminlte-textarea>
                    <x-adminlte-input-file name="ifLogoImage" id="imageInput" label="Logo Kabinet" placeholder="Choose a image..."/>
                </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-pink">
                <div class="card-header">
                    <h3 class="card-title">Susunan kabinet</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="members-container">
                        @foreach($kabinet->kabinetPerson->groupBy('position') as $position => $persons)
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="position[0][name]" placeholder="Ketua" value="{{$position}}">
                            </div>
                            <div class="col-md-8">
                            @foreach($persons as $person)
                            @if($loop->first)
                                <input type="text" class="form-control" name="position[0][members][0][name]" placeholder="Nama Ketua" value="{{$person->name}}">
                                <input type="text" class="form-control" name="position[0][members][0][instagram]" placeholder="instagram | contoh: @ppibandirma">
                                <input type="file" name="position[0][members][0][profile_pict]">
                                <button type="button" class="btn btn-sm btn-success add-member mt-1" data-posisi="0">Tambah Anggota</button>
                            @else
                            <div class="input-group mb-1">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="position[${posisi_id}][members][${member_count}][name]" placeholder="Nama Anggota" value="{{$person->name}}">
                                    <input type="text" class="form-control" name="position[${posisi_id}][members][${member_count}][instagram]" placeholder="instagram | contoh: @ppibandirma">
                                    <input type="file" name="position[${posisi_id}][members][${member_count}][profile_pict]">
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-danger remove-member" type="button">Hapus</button>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            </div>

                        </div>
                        <hr class="bg-pink">
                        @endforeach
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-info add-posisi">Tambah departmen</button>
                        </div>
                    </div>
                </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <input type="submit" disabled value="Edit Kabinet" class="btn btn-success float-right">
        </div>
    </div>
    </form>
</section>
@stop

@section('css')
@stop

@section('js')
<script>
    $(document).ready(function(){
        var posisi_count = 1;
        var member_id = 1;
        $(".add-posisi").click(function(){
            var posisi_field = `
            <hr class="bg-pink">
            <div class="form-group row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="position[${posisi_count}][name]" placeholder="Nama Departemen">
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="position[${posisi_count}][members][0][name]" placeholder="Nama Ketua Dept">
                    <input type="text" class="form-control" name="position[${posisi_count}][members][0][instagram]" placeholder="instagram | contoh: @ppibandirma">
                    <input type="file" name="position[${posisi_count}][members][0][profile_pict]">
                    <button type="button" class="btn btn-sm btn-success add-member my-1" data-posisi="${posisi_count}">Tambah Anggota</button>
                </div>
            </div>
            `;
            $("#members-container").append(posisi_field);
            posisi_count++;
            member_count = 1;
        });

        $(document).on('click', '.add-member', function(){
            var posisi_id = $(this).data('posisi');
            member_count++;
            var member_field = `
            <div class="input-group mb-1">
                <div class="form-group">
                    <input type="text" class="form-control" name="position[${posisi_id}][members][${member_count}][name]" placeholder="Nama Anggota">
                    <input type="text" class="form-control" name="position[${posisi_id}][members][${member_count}][instagram]" placeholder="instagram | contoh: @ppibandirma">
                    <input type="file" name="position[${posisi_id}][members][${member_count}][profile_pict]">
                </div>
                <div class="input-group-append">
                    <button class="btn btn-danger remove-member" type="button">Hapus</button>
                </div>
            </div>
            `;
            $(this).parent().append(member_field);
        });

        $(document).on('click', '.remove-member', function(){
            $(this).parent().parent().remove();
        });
    });

    function deleteKabinet(id, name){
        Swal.fire({
            title: `yakin ingin menghapus data ${name}?`,
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
                placeholder: 'write yes here'
            },
            showCancelButton: true,
            confirmButtonText: 'Hapus kabinet ini',
            confirmButtonColor : '#dc3545',
            showLoaderOnConfirm: true,
            preConfirm: (reason) => {
                return fetch(`/admin/kabinet/${id}`,{
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
                }).then(() => {
                    window.location.href = '/admin/kabinet';
                });;
            }
        })
    }
</script>
@stop