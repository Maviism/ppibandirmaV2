@extends('adminlte::page')

@section('title', 'Pojok Baca Manager')

@section('content_header')
    <h1>Book Manager</h1>
@stop

@section('content')

<div class="row">
    <div class="col-lg-5">
        @include('admin.akastrat.category')
    </div>
    <div class="col-lg-7">
        @include('admin.akastrat.ebook')
    </div>
</div>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Buku</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body position-relative">
            <form action="{{ route('pojokbaca.store') }}" method="POST" enctype="multipart/form-data">
            <x-adminlte-modal id="bookModal" title="Add Book" theme="purple" icon="fas fa-plus" size='md'>
                @csrf
                <x-adminlte-input name="iTitle" label="Judul buku" placeholder="judul buku" required enable-old-support/>
                <x-adminlte-input name="iAuthor" label="Penulis buku" placeholder="penulis buku" required enable-old-support/>
                <div class="row">
                    <x-adminlte-input fgroup-class="col-6" name="iPublisher" label="Penerbit" placeholder="penerbit" enable-old-support/>
                    <x-adminlte-input fgroup-class="col-6" name="iNumOfPages" type="number" label="Jumlah halaman" placeholder="jumlah halaman" enable-old-support/>
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
                    <option value="{{ $category->id }}" >{{$category->name}}</option>
                    @endforeach
                </x-adminlte-select2>
                <x-adminlte-input-file name="ifImage" label="Upload file" placeholder="Choose a file..."/>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="mr-auto" theme="danger" label="cancel" type="button" data-dismiss="modal"/>
                    <x-adminlte-button type="submit" theme="success" label="Submit"/>
                </x-slot>
            </x-adminlte-modal>
            </form>
            <x-adminlte-button label="Add Book" data-toggle="modal" data-target="#bookModal" class="bg-purple mb-2" icon="fas fa-plus"/>
            <x-adminlte-datatable id="bookList" :heads="[
                    ['label' => 'No', 'width' => 1],
                    'Title',
                    'Author',
                    'Category',
                    ['label' => 'Actioin', 'width' => 1],
                ]" head-theme="dark" striped compressed>
                @foreach($books as $book)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author}}</td>
                    <td>
                        @foreach($book->bookCategory as $category)
                        <button class="btn btn-xs btn-primary">
                            {{$category->category->name}}
                        </button>
                        @endforeach
                    </td>
                    <td>
                        <a href="/admin/pojokbaca/{{$book->id}}/edit" class="btn btn-xs btn-default text-primary shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                        <button onclick="deleteBook({{$book->id}})" class="btn btn-xs btn-default text-danger shadow" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
</div>
<!-- /.col -->

@stop

@section('css')
@stop

@section('js')
@section('plugins.Select2', true)
@section('plugins.BsCustomFileInput', true)
<script>
    function deleteBook(bookId){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this book!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete this book',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/pojokbaca/${bookId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Replace with your CSRF token
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status == 200) {
                        Swal.fire({
                            title: 'Deleted!', 
                            text: data.message, 
                            icon: 'success',
                            timer: 5000,
                            didClose: () => {
                                location.reload(); // reload the page after the delay
                            }
                        });
                    } else {
                        Swal.fire('Error!', 'An error occurred while deleting the book.', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'An error occurred while deleting the book.', 'error');
                });
            }
        });

    }

    function deleteCategory(categoryId){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this category!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete this category',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/pojokbaca/category/${categoryId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Replace with your CSRF token
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status == 200) {
                        Swal.fire({
                            title: 'Deleted!', 
                            text: data.message, 
                            icon: 'success',
                            timer: 5000,
                            didClose: () => {
                                location.reload(); // reload the page after the delay
                            }
                        });
                    } else {
                        Swal.fire('Error!', 'An error occurred while deleting the category...', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'An error occurred while deleting the category.', 'error');
                });
            }
        });

    }

    function deleteEbook(ebookId){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this ebook!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete this ebook',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/pojokbaca/ebook/${ebookId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Replace with your CSRF token
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status == 200) {
                        Swal.fire({
                            title: 'Deleted!', 
                            text: data.message, 
                            icon: 'success',
                            timer: 5000,
                            didClose: () => {
                                location.reload(); // reload the page after the delay
                            }
                        });
                    } else {
                        Swal.fire('Error!', 'An error occurred while deleting the ebook...', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'An error occurred while deleting the ebook.', 'error');
                });
            }
        });

    }
</script>
@stop