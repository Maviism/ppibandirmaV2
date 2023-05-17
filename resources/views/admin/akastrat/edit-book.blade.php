@extends('adminlte::page')

@section('title', 'Edit buku')

@section('content_header')
    <h1>Edit Book</h1>
@stop

@section('content')
<a href="/admin/pojokbaca" class="btn btn-info mb-2"><i class="fa fa-lg fa-chevron-left mr-1"></i>Kembali</a>
<div class="card col-lg-6 ">
        <form action="{{ route('pojokbaca.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <x-adminlte-input name="iTitle" label="Judul buku" placeholder="judul buku" value="{{$book->title}}" required enable-old-support/>
            <x-adminlte-input name="iAuthor" label="Penulis buku" placeholder="penulis buku" value="{{$book->author}}" required enable-old-support/>
            <div class="row">
                <x-adminlte-input fgroup-class="col-6" name="iPublisher" label="Penerbit" placeholder="penerbit" value="{{$book->publisher}}" enable-old-support/>
                <x-adminlte-input fgroup-class="col-6" name="iNumOfPages" type="number" label="Jumlah halaman" value="{{$book->number_of_pages }}" placeholder="jumlah halaman" enable-old-support/>
            </div>
            @php
                $config = [
                    "placeholder" => "Select multiple options...",
                    "allowClear" => true,
                ];
            @endphp
            <x-adminlte-select2 id="sel2Category" name="sel2Category[]" label="Categories"
                igroup-size="sm" :config="$config" multiple enable-old-support>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-yellow">
                        <i class="fas fa-tag"></i>
                    </div>
                </x-slot>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                    @foreach($book->bookCategory as $bookCategory)
                    @if($bookCategory->category->id == $category->id)
                        selected 
                    @endif
                    @endforeach>{{$category->name}}</option>
                @endforeach
            </x-adminlte-select2>
            <x-adminlte-input-file name="ifImage" label="Upload file" placeholder="Choose a file..."/>
        </form>
        <div class="row p-2 justify-content-end">
            <button class="btn btn-primary">Edit buku</button>
        </div>
</div>



@stop

@section('css')
@stop

@section('js')
@section('plugins.Select2', true)
@section('plugins.BsCustomFileInput', true)
<script>

</script>
@stop