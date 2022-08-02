<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::post('/import', [App\Http\Controllers\AdminController::class, 'import'])->name('import.excel');



Auth::routes();

Route::get('/recuperar-contraseña', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/registrar/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('index.admin');
Route::post('/registrar/admin', [App\Http\Controllers\AdminController::class, 'create'])->name('register.admin');

Route::get('/reportes', [App\Http\Controllers\ReportesController::class, 'index'])->name('reportes');
Route::get('/reportes/exportar', [App\Http\Controllers\ReportesController::class, 'exportar'])->name('exportar');

Route::post('/lector', [App\Http\Controllers\CuponController::class, 'store'])->name('cupon.store');

