@extends('adminlte::page')

@section('title', 'Daily Vocabulary')

@section('content_header')
    <h1>Daily Vocabulary</h1>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row p-2 bg-white mb-1" >
    <div >
        <form action="{{ route('vocabulary.store') }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            <input type="file" name="vocabFile" id="vocabFile" required>
            <button type="submit" class="btn btn-primary m-2">import</button>
        </form>
    </div>
    <div>
        <ul>
            <li>Pesan dikirim setiap pukul 06.00 TRT</li>
            <li>Pesan dikirim ke grup *TURSU (Türkçe Kursu)*📝 whatsapp</li>
            <li>Vocabulary dikirim sesuai dengan urutan</li>
        </ul>
    </div>
    <div class="px-2">
        <x-adminlte-modal id="sentVocabModal" title="Add Category" theme="pink" icon="fas fa-check" size='md'>
            @csrf
            <x-adminlte-datatable id="sentVocabulary" :heads="[
                ['label' => 'No', 'width' => 1], 'Kata ', 'Makna', 'Type'
            ]" head-theme="dark" striped compressed>
            @foreach($sentVocabs as $vocabulary)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $vocabulary->word_id }}</td>
                <td>{{ $vocabulary->word_tr }}</td>
                <td>{{ $vocabulary->type }}</td>
            </tr>
            @endforeach            
        </x-adminlte-datatable>
        </x-adminlte-modal>
        <x-adminlte-button label="List sent vocabularies" data-toggle="modal" data-target="#sentVocabModal" class="bg-pink mb-2" icon="fas fa-check"/>
    </div>
</div>
<div class="row bg-white p-2">
    <div class="col-lg-6">
        <x-adminlte-datatable id="vocabulary" :heads="[
                ['label' => 'No', 'width' => 1], 'Kata Benda', 'Makna', ['label' => 'Action', 'width' => 1]
            ]" head-theme="dark" striped compressed>
            @foreach($nouns as $vocabulary)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $vocabulary->word_id }}</td>
                <td>{{ $vocabulary->word_tr }}</td>
                <td>
                    <button onclick="deleteVocab({{$vocabulary->id}})" class="btn btn-xs btn-default text-danger shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button></td>
                </td>
            </tr>
            @endforeach            
        </x-adminlte-datatable>
    </div>
    <div class="col-lg-6 mt-4 mt-sm-0">
        <x-adminlte-datatable id="verbs" :heads="[
                ['label' => 'No', 'width' => 1], 'Kata Kerja', 'Makna', ['label' => 'Action', 'width' => 1]
            ]" head-theme="dark" striped compressed>
            @foreach($verbs as $vocabulary)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $vocabulary->word_id }}</td>
                <td>{{ $vocabulary->word_tr }}</td>
                <td>
                    <button onclick="deleteVocab({{$vocabulary->id}})" class="btn btn-xs btn-default text-danger shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button></td>
                </td>
            </tr>
            @endforeach            
        </x-adminlte-datatable>
    </div>
</div>
<div class="mt-5 bg-white p-2">
    <x-adminlte-datatable id="expressions" :heads="[
        ['label' => 'No', 'width' => 1], 'Ungkapan Harian', 'Makna', ['label' => 'Action', 'width' => 1]
        ]" head-theme="dark" striped compressed>
        @foreach($expressions as $vocabulary)
        <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $vocabulary->word_id }}</td>
                <td>{{ $vocabulary->word_tr }}</td>
                <td>
                    <button onclick="deleteVocab({{$vocabulary->id}})" class="btn btn-xs btn-default text-danger shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button></td>
                </td>
            </tr>
            @endforeach            
    </x-adminlte-datatable>
</div>

@stop

@section('css')
@stop

@section('js')
@section('plugins.Select2', true)
@section('plugins.BsCustomFileInput', true)
<script>
    function deleteVocab(vocabId){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this vocabulary!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete this vocabulary',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/vocabulary/${vocabId}`, {
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
</script>
@stop