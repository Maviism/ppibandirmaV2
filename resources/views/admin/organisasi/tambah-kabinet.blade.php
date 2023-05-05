@extends('adminlte::page')

@section('title', 'Kabinet')

@section('content_header')
    <h1>Buat Kabinet Baru</h1>
@stop

@section('content')
<section class="content">
    <form method="POST" action="{{ route('kabinet.store') }}">
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
                    <div class="form-group">
                        <label for="inputName">Nama Kabinet</label>
                        <input type="text" id="inputName" name="kabinetName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">Periode</label>
                        <input type="text" id="inputClientCompany" class="form-control" name="periode" placeholder="contoh : 2022-203">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Deskripsi</label>
                        <textarea id="inputDescription" class="form-control" name="description" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputProjectLeader">Logo kabinet(optional)</label>
                        <input type="text" id="inputProjectLeader" class="form-control">
                    </div>
                </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-secondary">
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
                                <input type="text" class="form-control" name="position[0][name]" placeholder="Nama Posisi">
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="position[0][members][0][name]" placeholder="Nama Anggota">
                                <input type="text" class="form-control" name="position[0][members][0][instagram]" placeholder="instagram | contoh: @ppibandirma">
                                <button type="button" class="btn btn-sm btn-success add-member mt-1" data-posisi="0">Tambah Anggota</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-info add-posisi">Tambah Posisi</button>
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
            <input type="submit" value="Create new Project" class="btn btn-success float-right">
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
            <div class="form-group row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="position[${posisi_count}][name]" placeholder="Nama Posisi">
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="position[${posisi_count}][members][0][name]" placeholder="Nama Anggota">
                    <input type="text" class="form-control" name="position[${posisi_count}][members][0][instagram]" placeholder="instagram | contoh: @ppibandirma">
                    <button type="button" class="btn btn-sm btn-success add-member mt-1" data-posisi="${posisi_count}">Tambah Anggota</button>
                </div>
            </div>
            `;
            $("#members-container").append(posisi_field);
            posisi_count++;
        });

        $(document).on('click', '.add-member', function(){
            var posisi_id = $(this).data('posisi');
            var member_field = `
            <div class="input-group mb-1">
                <div class="form-group">
                    <input type="text" class="form-control" name="position[${posisi_id}][members][0][name]" placeholder="Nama Anggota">
                    <input type="text" class="form-control" name="position[${posisi_id}][members][0][instagram]" placeholder="instagram | contoh: @ppibandirma">
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
</script>
@stop