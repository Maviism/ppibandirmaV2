@extends('adminlte::page')

@section('title', 'Kabinet')

@section('content_header')
    <h1>Buat Kabinet Baru</h1>
@stop

@section('content')
<a href="/admin/kabinet" class="btn btn-info mb-2"><i class="fa fa-md fa-chevron-left"></i> Kembali</a>
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
                    <x-adminlte-input name="iName" label="Nama kabinet" placeholder="contoh : HepsiBurada" enable-old-support/>
                    <x-adminlte-input name="iPeriode" label="Periode" placeholder="contoh : 2021-2022" enable-old-support/>
                    <x-adminlte-textarea name="iDescription" label="Description" rows=3 placeholder="Insert description..." enable-old-support>
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
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="position[0][name]" placeholder="Ketua" value="Ketua">
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="position[0][members][0][name]" placeholder="Nama Ketua">
                                <input type="text" class="form-control" name="position[0][members][0][instagram]" placeholder="instagram | contoh: @ppibandirma">
                                <input type="file" name="position[0][members][0][profile_pict]">
                                <button type="button" class="btn btn-sm btn-success add-member mt-1" data-posisi="0">Tambah Anggota</button>
                            </div>
                        </div>
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
            <input type="submit" value="Create new Kabinet" class="btn btn-success float-right">
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
            member_count++;

            $(this).parent().append(member_field);
        });

        $(document).on('click', '.remove-member', function(){
            $(this).parent().parent().remove();
        });
    });
</script>
@stop