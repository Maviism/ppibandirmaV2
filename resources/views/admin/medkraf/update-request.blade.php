@extends('adminlte::page')

@section('title', 'Request Design')

@section('content_header')
    <h1>Approval Design Medkraf</h1>
@stop

@section('content')
<a href="/admin/design" class="btn btn-info mb-2"><i class="fa fa-md fa-chevron-left"></i> Kembali</a>
<form method="POST" action="{{ route('design.update', $design->id) }}" enctype="multipart/form-data" >
<div class="card p-2 ">
    <div class="row">
        <div class="col-md-6">
            @csrf
            @method('PUT')
            <x-adminlte-input name="iDepartment" label="Departemen" disabled value="{{$design->department}}" enable-old-support/>
            <x-adminlte-input name="iTitle" label="Penanggung jawab" value="{{$design->responsible}}" disabled enable-old-support/>
            <x-adminlte-input name="iTitle" label="Judul Design" value="{{$design->title}}" disabled enable-old-support/>

            <x-adminlte-textarea name="iContent" label="Isi konten" rows=6
                    placeholder="Insert content..." enable-old-support disabled>
                    {{$design->content}}
            </x-adminlte-textarea>
        </div>
        <div class="col-md-6">

            <x-adminlte-input-date name="idDeadline" label="Deadline" value="{{$design->deadline}}" disabled enable-old-support>
                <x-slot name="appendSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-date>

            <div>
                <label for="">Contoh Design</label>
                @if(isset($design->img_reference_url))
                <img id="previewImage" src="{{$design->img_reference_url}}" alt="Preview" style="max-width:200px; max-height:200px; display:none"/>
                @else
                <div class="mb-1"><em>Not Available</em></div>
                @endif
            </div>

            @if($design->assign_to == null)
            <x-adminlte-input name="iAssign" label="Task assign to"  value="{{auth()->user()->name}}" enable-old-support/>
            @else
            <x-adminlte-input name="iAssign" label="Task assign to"  value="{{$design->assign_to}}" enable-old-support/>
            @endif
            <div class="mb-3">
                <label class="form-label">Status</label>
                <div class="row container">
                    <div class="form-check mr-3">
                        <input class="form-check-input" type="radio" name="iStatus" id="flexRadioDefault1" value="approved" @if($design->status== 'approved') checked @endif>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Approved
                        </label>
                    </div>
                    <div class="form-check mr-3">
                        <input class="form-check-input" type="radio" name="iStatus" id="flexRadioDefault2" value="pending" @if($design->status== 'pending') checked @endif>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Pending
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iStatus" id="flexRadioDefault2" value="reject" @if($design->status== 'reject') checked @endif>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Reject
                        </label>
                    </div>
                </div>
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