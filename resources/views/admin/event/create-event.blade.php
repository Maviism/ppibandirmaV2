@extends('adminlte::page')

@section('title', 'Buat event')

@section('content_header')
    <h1>Buat event</h1>
@stop

@section('content')
<a href="/admin/event" class="btn btn-info mb-1"><i class="fa fa-lg fa-chevron-left mr-1"></i>Kembali</a>
<form method="POST" action="{{ route('event.store') }}" enctype="multipart/form-data" >
<div class="card p-2 ">
    <div class="row">
        <div class="col-md-6">
            @csrf
            <x-adminlte-input name="iTitle" label="Title" placeholder="nama acara" enable-old-support/>
            <x-adminlte-input name="iVenue" label="Venue" placeholder="tempat acara" enable-old-support/>

            <x-adminlte-textarea name="iDescription" label="Description" rows=4
                    placeholder="Insert description..." enable-old-support>
            </x-adminlte-textarea>
        </div>
        <div class="col-md-6">
            <x-adminlte-input-date name="iDatetime" :config="['format' => 'YYYY-MM-DD HH:mm']" placeholder="Choose a date... YYYY-MM-DD HH:mm"
                label="Datetime" enable-old-support>
                <x-slot name="prependSlot">
                    <x-adminlte-button theme="primary" icon="fas fa-calendar"
                        title="Set to Datetime"/>
                </x-slot>
            </x-adminlte-input-date>
            <x-adminlte-select name="iType" label="Type" enable-old-support>
                <option value="public">Public</option>
                <option value="tömer">Tömer</option>
                <option value="private">Private</option>
                <option value="internal">Internal</option>
            </x-adminlte-select>
            <div>
                <x-adminlte-input-file name="ifImage" id="imageInput" label="Upload image" placeholder="Choose a image..."/>
                <img id="previewImage" src="" alt="Preview" style="max-width:200px; max-height:200px; display:none"/>
            </div>
        </div>
    </div>
</div>
<div class="row px-1 justify-content-end">
    <button type="submit" class="btn btn-primary mb-4">Create Event</button>

</div>
</form>

@stop

@section('css')
@stop

@section('js')
@section('plugins.TempusDominusBs4', true)
@section('plugins.BsCustomFileInput', true)
<script>
    const fileInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();
        previewImage.style.display = 'none';

        reader.addEventListener('load', (event) => {
            previewImage.src = event.target.result;
            previewImage.style.display = 'block';
        });

        reader.readAsDataURL(file);
    });
</script>
@stop