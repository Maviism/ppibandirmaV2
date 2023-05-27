@extends('adminlte::page')

@section('title', 'Request Design')

@section('content_header')
    <h1>Request Design Medkraf</h1>
@stop

@section('content')
<a href="/admin/kabinet" class="btn btn-info mb-2"><i class="fa fa-md fa-chevron-left"></i> Kembali</a>
<form method="POST" action="{{ route('design.store') }}" enctype="multipart/form-data" >
<div class="card p-2 ">
    <div class="row">
        <div class="col-md-6">
            @csrf
            <x-adminlte-select name="iDepartment" label="Departemen" enable-old-support>
                <option value="" selected>Pilih departemen</option>
                <option value="Administrasi & Keuangan">Administrasi & Keuangan</option>
                <option value="Advokasi & Humas">Advokasi & Humas</option>
                <option value="Akademik & Kajian Strategis">Akademik & Kajian Strategis</option>
                <option value="Pengembangan Sumber Daya Manusia">Pengembangan Sumber Daya Manusia</option>
                <option value="Keputrian">Keputrian</option>
                <option value="Sosial Pengabdian Masyarakat">Sosial Pengabdian Masyarakat</option>
                <option value="Wirausaha">Wirausaha</option>
            </x-adminlte-select>
            <x-adminlte-input name="iTitle" label="Judul Design" placeholder="contoh: Halal bi halal" enable-old-support/>

            <x-adminlte-textarea name="iContent" label="Isi konten" rows=4
                    placeholder="Insert content..." enable-old-support>
            </x-adminlte-textarea>
        </div>
        <div class="col-md-6">
            @php
            $config = [
                'format' => 'YYYY/MM/DD',
                'dayViewHeaderFormat' => 'MMM YYYY',
                'minDate' => "js:moment().add(5, 'days').endOf('day')",
                'maxDate' => "js:moment().endOf('year')",
            ];
            @endphp
            <x-adminlte-input-date name="idDeadline" label="Deadline"
                :config="$config" placeholder="Choose a deadline day..." enable-old-support>
                <x-slot name="appendSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </x-slot>
                <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">
                        Maksimal deadline h-5
                    </span>
                </x-slot>
            </x-adminlte-input-date>

            <div>
                <x-adminlte-input-file name="ifImageReference[]" id="imageInput" label="Contoh Design" placeholder="Choose a image..." multiple>
                    <x-slot name="bottomSlot">
                        <span class="text-sm text-gray">
                            Optional | max: 5mb
                        </span>
                    </x-slot>
                </x-adminlte-input-file>
                <img id="previewImage" src="" alt="Preview" style="max-width:200px; max-height:200px; display:none"/>
            </div>
        </div>
    </div>
</div>
<div class="row px-1 justify-content-end">
    <button type="submit" class="btn btn-primary mb-4">Submit</button>
</div>
</form>
@stop

@section('css')
@stop

@section('js')
@section('plugins.TempusDominusBs4', true)
@section('plugins.BsCustomFileInput', true)

@stop