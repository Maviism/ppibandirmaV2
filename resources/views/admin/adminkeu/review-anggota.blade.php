@extends('adminlte::page')

@section('title', 'User review')

@section('content_header')
    <h1>Review data anggota</h1>
@stop

@section('content')
<div class="p-2 rounded" style="background-color: #FFF;">
        <form action="/admin/datareview/{{$user->user_id}}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="typeRequest" value="review" hidden />
        <div class="row p-2 rounded" style="background-color: #FFF;">
            <div class="container col-md-6 line">
                <p class="text-primary bold mt-1">Informasi Umum</p>
                <x-adminlte-input name="iFullname" value="{{$user->name}}" label="Nama lengkap" placeholder="name lengkap"/>
                <x-adminlte-input name="iMail" value="{{$user->email}}" type="email" label="Email"   placeholder="mail@example.com" enable-old-support/>
                <x-adminlte-input name="iPhone" value="{{$user->phone_number}}" type="number" label="Nomor HP" placeholder="90552xxxxxx" enable-old-support>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-primary">
                            <i class="fas fa-plus text-default"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-textarea name="iAddress" label="Alamat di Turki" rows=2
                    igroup-size="sm" placeholder="Insert address..." enable-old-support>
                    {{$user->address_tr}}
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-primary">
                            <i class="fas fa-lg fa-address-card text-default"></i>
                        </div>
                    </x-slot>
                </x-adminlte-textarea>
                <x-adminlte-input-date name="iBirthday" :config="['format' => 'DD/MM']" value="{{$user->birthday}}" placeholder="Choose a date..."
                    label="Birthday" enable-old-support>
                    <x-slot name="prependSlot">
                        <x-adminlte-button theme="primary" icon="fas fa-birthday-cake"
                            title="Set to Birthday"/>
                    </x-slot>
                </x-adminlte-input-date>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="row container">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="iGender" id="flexRadioDefault1" value="Laki-laki" @if($user->gender == 'Laki-laki') checked @endif>
                            <label class="form-check-label" for="flexRadioDefault1">
                                🙋‍♂️Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="iGender" id="flexRadioDefault2" value="Perempuan" @if($user->gender == 'Perempuan') checked @endif>
                            <label class="form-check-label" for="flexRadioDefault2">
                                🙋‍♀️Perempuan
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-primary bold mt-1">Pendidikan</p>
                <x-adminlte-input name="iArrivalYear" value="{{$user->arrival_year}}" label="Tahun kedatangan" placeholder="20xx" enable-old-support/>
                <x-adminlte-select name="iEducationType" label="Jenjang pendidikan" enable-old-support>
                    <option value="SD" @if($user->type_of_education == 'SD') selected @endif>SD</option>
                    <option value="SMP" @if($user->type_of_education == 'SMP') selected @endif>SMP</option>
                    <option value="SMA" @if($user->type_of_education == 'SMA') selected @endif>SMA</option>
                    <option value="Sarjana" @if($user->type_of_education == 'Sarjana') selected @endif>Sarjana</option>
                    <option value="Magister" @if($user->type_of_education == 'Magister') selected @endif>Magister</option>
                    <option value="Doktoral" @if($user->type_of_education == 'Doktoral') selected @endif>Doktoral</option>
                </x-adminlte-select>
                <x-adminlte-select name="iUniv" label="Universitas" enable-old-support>
                    <option value="Bandırma Onyedi Eylül Üniversitesi" @if($user->university == 'Bandırma Onyedi Eylül Üniversitesi') selected @endif>Bandırma Onyedi Eylül Üniversitesi</option>
                    <option value="Çanakkale Onsekiz Mart Üniversitesi" @if($user->university == 'Çanakkale Onsekiz Mart Üniversitesi') selected @endif>Çanakkale Onsekiz Mart Üniversitesi</option>
                </x-adminlte-select>
                <div id="facultyHelp" class="form-text text-gray">refensi nama fakultas & departemen <a href="https://www.bandirma.edu.tr/tr/www/Sayfa/Goster/BILGI-PAKETI-ve-DERS-KATALOGU-1079" target="_blank">banü</a> | <a href="https://ubys.comu.edu.tr/AIS/OutcomeBasedLearning/Home/Index?culture=tr-TR" target="_blank">çomü</a>.</div>
                <x-adminlte-input name="iFaculty" value="{{$user->faculty}}" label="Fakultas" placeholder="contoh : ÖMER SEYFETTİN UYGULAMALI BİLİMLER FAKÜLTESİ" enable-old-support/>
                <x-adminlte-input name="iDepartment" value="{{$user->department}}" label="Departemen" placeholder="contoh : Uluslararası Ticaret ve Lojistik" enable-old-support/>
                <div class="mb-3">
                    <label class="form-label">Status pendidikan</label>
                    <div class="row container">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="iStatus" id="rStatus1" value="Tömer" @if($user->status == 'Tömer') checked @endif>
                            <label class="form-check-label" for="rStatus1">
                                Tömer
                            </label>
                        </div>
                        <div class="form-check mx-3">
                            <input class="form-check-input" type="radio" name="iStatus" id="rStatus2" value="Kuliah" @if($user->status === 'Kuliah') checked @endif>
                            <label class="form-check-label" for="rStatus2">
                                Kuliah
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="iStatus" id="rStatus3" value="Lulus" @if($user->status === 'Lulus') checked @endif>
                            <label class="form-check-label" for="rStatus3">
                                Lulus
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end mx-3 mb-3">
            <a href="{{route('dataanggota.index')}}" class="btn btn-primary"><i class="fas fa-lg fa-chevron mr-1"></i>Kembali</a>
            <a href="{{route('deletedataanggota' , $user->user_id)}}" class="btn btn-danger mx-3"><i class="fas fa-lg fa-ban mr-1"></i>Hapus</a>
            <x-adminlte-button class="" type="submit" label="Approved" theme="success" icon="fas fa-lg fa-check"/>
        </div>
        </form>
    </div>
@stop
@section('plugins.TempusDominusBs4', true)
@section('css')
    <link rel="stylesheet" href="/assets/css/custom.css">
@stop

@section('js')
@stop