<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Event\AbsensiController;
use App\Http\Controllers\Organisation\KabinetController;
use App\Http\Controllers\Organisation\DesignRequestController;

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
Route::get('/kabinet', function () { return view('Pages.kabinet');})->name('kabinet');

Route::get('/membercard/{id}', [UserController::class, 'generateMembershipCard']);


Route::prefix('admin')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function(){
        Route::middleware('role:allAdmin')->group(function(){
            Route::get('/', [DashboardController::class, 'index'])->name('admin');
            Route::resource('/kabinet', KabinetController::class);
            Route::resource('/event', EventController::class);
            Route::resource('/absensi', AbsensiController::class)->except('store');
            Route::post('/absensi/user/{id}', [AbsensiController::class, 'store'])->name('absensi.store');
            Route::get('/design/create', [DesignRequestController::class, 'create'])->name('design.create');
            Route::post('/design/create', [DesignRequestController::class, 'store'])->name('design.store');
        });

        Route::middleware('role:adminkeu')->group(function(){
            Route::resource('/dataanggota', UserController::class);
            Route::get('/datareview/{id}', [UserController::class, 'ShowUserReview']);
            Route::put('/datareview/{id}', [UserController::class, 'Update'])->name('datareview.approved');
            Route::get('/unapproveuser/{id}', [UserController::class, 'unapproveuser'])->name('deletedataanggota');
            Route::get('/dataalumni', [UserController::class, 'dataAlumni']);
            Route::get('/analytic', [UserController::class, 'analytic']);
        });
        
        Route::middleware('role:medkraf')->group(function(){
            Route::resource('/design', DesignRequestController::class)->except(['create', 'store']);
        });

        Route::middleware('role:akastrat')->group(function(){
            Route::resource('/pojokbaca', BookController::class);
            Route::post('/pojokbaca/category/create', [BookController::class, 'storeCategory'])->name('category.store');
            Route::post('/pojokbaca/ebook/create', [BookController::class, 'storeEbook'])->name('ebook.store');
            Route::delete('/pojokbaca/category/{id}', [BookController::class, 'destroyCategory'])->name('category.destroy');
            Route::delete('/pojokbaca/ebook/{id}', [BookController::class, 'destroyEbook'])->name('ebook.destroy');
        });
});