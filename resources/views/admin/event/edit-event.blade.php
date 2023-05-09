@extends('adminlte::page')

@section('title', 'Edit event')

@section('content_header')
    <h1>Edit event</h1>
@stop

@section('content')
<form method="POST" action="{{ route('event.update', $event) }}" enctype="multipart/form-data">
@method('PUT')
@csrf
<a href="/admin/event" class="btn btn-info mb-2"><i class="fa fa-md fa-chevron-left"></i> Kembali</a>

<div class="card p-2 ">
    <div class="row">
        <div class="col-md-6">
            <x-adminlte-input name="iTitle" value="{{$event->title}}" label="Title" placeholder="nama acara" enable-old-support/>
            <x-adminlte-input name="iVenue" value="{{$event->venue}}" label="Venue" placeholder="tempat acara" enable-old-support/>

            <x-adminlte-textarea name="iDescription" label="Description" rows=4
                    placeholder="Insert description..." enable-old-support>
                    {{$event->description}}
            </x-adminlte-textarea>
        </div>
        <div class="col-md-6">
            <x-adminlte-input-date name="iDatetime" value="{{$event->datetime}}" :config="['format' => 'DD/MM/YYYY HH:mm']" placeholder="Choose a date... DD/MM/YYYY HH:mm"
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
                <img id="previewImage" src="/storage/images/events/{{$event->image_url}}" alt="{{$event->image_url}}" style="max-width:200px; max-height:200px;"/>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-between px-2 mt-1">
    <a href="{{route('event.destroy', $event->id)}}" class="delete-btn btn btn-danger"><i class="fa fa-md fa-trash"></i> Delete Event</a>
    <button type="submit" class="btn btn-primary"><i class="fa fa-md fa-pen"></i> Edit Event</button>
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

    $('.delete-btn').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                Swal.fire({
                    title: 'Deleted!',
                    text: response.message,
                    icon: 'success',
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '/admin/event';
                });
                },
                error: function (response) {
                Swal.fire({
                    title: 'Error!',
                    text: response.responseJSON.message,
                    icon: 'error'
                });
                }
            });
            }
        });
        });
</script>
@stop