@extends('adminlte::page')

@section('title', 'Kabinet')

@section('content_header')
    <h1>Kabinet</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <a href="{{ route('kabinet.create') }}" class="btn btn-primary text-default mx-1 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-user-plus mr-1"></i>Kabinet Baru
    </a>
  </div>
</div>
<div class="card card-solid">
  <div class="card-body pb-0">
    <div class="row">
      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-header text-muted border-bottom-0">
            2019-2020
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-7">
                <h2 class="lead text-bold"><b>HepsiBurada</b></h2>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small mb-1"><span class="fa-li"><i class="fas fa-lg fa-people-carry"></i></span>Departmen : 8</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-users"></i></span> Anggota : 50</li>
                </ul>
              </div>
              <div class="col-5 text-center">
                <img src="/assets/banggabareng.png" alt="user-avatar" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="#" class="btn btn-sm bg-teal">
                <i class="fas fa-comments"></i>
              </a>
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-user"></i> View Profile
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-header text-muted border-bottom-0">
            2020-2021
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-7">
                <h2 class="lead text-bold"><b>Serasi</b></h2>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small mb-1"><span class="fa-li"><i class="fas fa-lg fa-people-carry"></i></span>Departmen : 8</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-users"></i></span> Anggota : 50</li>
                </ul>
              </div>
              <div class="col-5 text-center">
                <img src="../../dist/img/user2-160x160.jpg" alt="user-avatar" class="img-circle img-fluid">
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="#" class="btn btn-sm bg-teal">
                <i class="fas fa-comments"></i>
              </a>
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-user"></i> View Profile
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-header text-muted border-bottom-0">
            2022-2023
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-7">
                <h2 class="lead text-bold"><b>Bandirma Birlikte</b></h2>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small mb-1"><span class="fa-li"><i class="fas fa-lg fa-people-carry"></i></span>Departmen : 8</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-users"></i></span> Anggota : 50</li>
                </ul>
              </div>
              <div class="col-5 text-center">
                <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="#" class="btn btn-sm bg-teal">
                <i class="fas fa-comments"></i>
              </a>
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-user"></i> View Profile
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- /.card-body -->
</div>
@stop

@section('css')
@stop

@section('js')
@stop