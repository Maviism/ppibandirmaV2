@extends('adminlte::page')

@section('title', 'Kabinet')

@section('content_header')
    <h1>Kabinet</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <a href="{{ route('kabinet.create') }}" class="btn btn-primary text-default mx-1 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-folder-plus mr-1"></i>Kabinet Baru
    </a>
  </div>
</div>
<div class="card card-solid">
  <div class="card-body pb-0">
    <div class="row">
      @foreach($kabinets as $kabinet)
      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card d-flex flex-fill">
          <div class="card-body ">
            <div class="row">
              <div class="col-7">
                <p class="text-muted">{{ $kabinet->periode }}</p>
                <h2 class="lead text-bold"><b>{{$kabinet->name}}</b></h2>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small mb-1"><span class="fa-li"><i class="fas fa-lg text-primary fa-shield-alt mr-1"></i></span> {{$kabinet->position_count}} Departemen</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-users text-success mr-1"></i></span>{{$kabinet->people_count}} Anggota</li>
                </ul>
              </div>
              <div class="col-5 text-center">
                <img src="/storage/images/kabinet/{{$kabinet->logo_url}}" alt="Logo {{$kabinet->name}}" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="{{ route('kabinet.edit', $kabinet->id)}}" class="btn btn-sm bg-teal">
                <i class="fas fa-pen"></i> Edit
              </a>
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-search"></i> View
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </div>
  <!-- /.card-body -->
</div>
@stop

@section('css')
@stop

@section('js')
@stop