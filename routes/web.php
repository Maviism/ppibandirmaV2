<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Event\AbsensiController;
use App\Http\Controllers\Organisation\KabinetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('welcome');})->name('index');
Route::get('/event', function () { return view('Pages.event');})->name('event');
Route::get('/member', function () { return view('Pages.member');})->name('member');
Route::get('/artikel', function () { return view('Pages.artikel');})->name('artikel');

Route::prefix('admin')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function(){
        Route::middleware('role:allAdmin')->group(function(){
            Route::get('/', function(){ return view('admin/dashboard'); });
            Route::resource('/kabinet', KabinetController::class);
            Route::resource('/event', EventController::class);
            Route::resource('/absensi', AbsensiController::class)->except('store');
            Route::post('/absensi/user/{id}', [AbsensiController::class, 'store'])->name('absensi.store');
            Route::get('/scanner/{id}', [AbsensiController::class, 'showScanner'])->name('absen.scanner');
        });

        Route::middleware('role:adminkeu')->group(function(){
            Route::resource('/dataanggota', UserController::class);
            Route::get('/datareview/{id}', [UserController::class, 'ShowUserReview']);
            Route::put('/datareview/{id}', [UserController::class, 'Update'])->name('datareview.approved');
            Route::get('/dataalumni', [UserController::class, 'dataAlumni']);
            Route::get('/analytic', [UserController::class, 'analytic']);
        });   
});