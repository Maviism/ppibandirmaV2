@extends('adminlte::page')

@section('title', 'Tambah anggota')

@section('content_header')
    <h1>Tambah anggota</h1>
@stop

@section('content')
    <div class="p-2 rounded" style="background-color: #FFF;">
        <form action="{{route('data-anggota.store')}}" method="POST">
        @csrf
        <div class="row p-2 rounded" style="background-color: #FFF;">
            <div class="container col-md-6 line">
                <p class="text-primary bold mt-1">Informasi Umum</p>
                <x-adminlte-input name="iFullname" label="Nama lengkap" placeholder="name lengkap" disable-feedback/>
                <x-adminlte-input name="iMail" type="email" label="Email"   placeholder="mail@example.com" disable-feedback/>
                <x-adminlte-input name="iPhone" type="number" label="Nomor HP" placeholder="90552xxxxxx">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-primary">
                            <i class="fas fa-plus text-default"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-textarea name="iAddress" label="Alamat di Turki" rows=2
                    igroup-size="sm" placeholder="Insert address...">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-primary">
                            <i class="fas fa-lg fa-address-card text-default"></i>
                        </div>
                    </x-slot>
                </x-adminlte-textarea>
                <x-adminlte-input-date name="iBirthday" :config="['format' => 'DD/MM']" placeholder="Choose a date..."
                    label="Birthday">
                    <x-slot name="prependSlot">
                        <x-adminlte-button theme="primary" icon="fas fa-birthday-cake"
                            title="Set to Birthday"/>
                    </x-slot>
                </x-adminlte-input-date>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="row container">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="iGender" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                🙋‍♂️Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="iGender" id="flexRadioDefault2" >
                            <label class="form-check-label" for="flexRadioDefault2">
                                🙋‍♀️Perempuan
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-primary bold mt-1">Pendidikan</p>
                <x-adminlte-input name="iArrivalYear" label="Tahun kedatangan" placeholder="20xx" disable-feedback/>
                <x-adminlte-select name="iStatus" label="Jenjang pendidikan">
                    <option>---</option>
                    <option>Sarjana</option>
                    <option>Magister</option>
                    <option>Doktoral</option>
                </x-adminlte-select>
                <x-adminlte-select name="iUniv" label="Universitas">
                    <option>Bandırma Onyedi Eylül Üniversitesi</option>
                    <option>Çanakkale Onsekiz Mart Üniversitesi</option>
                </x-adminlte-select>
                <div id="facultyHelp" class="form-text text-gray">refensi nama fakultas & departemen <a href="https://www.bandirma.edu.tr/tr/www/Sayfa/Goster/BILGI-PAKETI-ve-DERS-KATALOGU-1079" target="_blank">banü</a> | <a href="https://ubys.comu.edu.tr/AIS/OutcomeBasedLearning/Home/Index?culture=tr-TR" target="_blank">çomü</a>.</div>
                <x-adminlte-input name="iFaculty" label="Fakultas" placeholder="contoh : ÖMER SEYFETTİN UYGULAMALI BİLİMLER FAKÜLTESİ" disable-feedback/>
                <x-adminlte-input name="iDepartman" label="Departemen" placeholder="contoh : Uluslararası Ticaret ve Lojistik" disable-feedback/>
                <div class="mb-3">
                    <label class="form-label">Status pendidikan</label>
                    <div class="row container">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="iStatus" id="rStatus1" checked>
                            <label class="form-check-label" for="rStatus1">
                                Tömer
                            </label>
                        </div>
                        <div class="form-check mx-3">
                            <input class="form-check-input" type="radio" name="iStatus" id="rStatus2" >
                            <label class="form-check-label" for="rStatus2">
                                Kuliah
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="iStatus" id="rStatus3" >
                            <label class="form-check-label" for="rStatus3">
                                Lulus
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end mx-3 mb-3">
            <a href="{{route('data-anggota.index')}}" class="btn btn-danger mx-3"><i class="fas fa-lg fa-ban mr-1"></i>Cancel</a>
            <x-adminlte-button class="" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
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