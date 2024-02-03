<?php

use App\Http\Controllers\DomPdfController;
use App\Http\Controllers\print_document;
use Illuminate\Support\Facades\Route;

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
Route::get('/print',[DomPdfController::class,'getPdf']);
Route::get('/show_print_data',[print_document::class,'show_print_status_pekerjaan']);
Route::get('/tes_database',[print_document::class,'print']);