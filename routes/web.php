<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::prefix('admin')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function(){
        Route::middleware('role:allAdmin')->group(function(){
            Route::get('/', function(){ return view('admin/dashboard'); });
            Route::resource('/kabinet', KabinetController::class);
        });

        Route::middleware('role:adminkeu')->group(function(){
            Route::resource('/dataanggota', UserController::class);
            Route::get('/datareview/{id}', [UserController::class, 'ShowUserReview']);
            Route::put('/datareview/{id}', [UserController::class, 'Update'])->name('datareview.approved');
            Route::get('/dataalumni', [UserController::class, 'dataAlumni']);
            Route::get('/analytic', [UserController::class, 'analytic']);
        });   
});