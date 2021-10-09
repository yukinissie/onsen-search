<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OnsenController;

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

Route::get('/admin/onsen',  [OnsenController::class, 'create']);
Route::post('/admin/onsen', [OnsenController::class, 'store']);
Route::delete('/admin/onsen', [OnsenController::class, 'destroy']);
