<?php

use App\Http\Controllers\SuratController;
use App\Http\Controllers\ControllerDownload;
use App\Http\Controllers\EditPdfController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/dashboard', SuratController::class);
Route::get('/storage', [ControllerDownload::class, 'downloadfunc']);

Route::get('/about', function () {
    return view('dashboard.about.index');
});

// Route::get('/editsurat/{id}', [EditPdfController::class, 'edit']);

// // Route untuk menangani proses edit dan update data
// Route::post('/updatesurat/{id}', [EditPdfController::class, 'update']);
