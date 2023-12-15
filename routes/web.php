<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::group(['middleware'=>'guest'], function(){
Route::get('login', [LoginController::class,'index'])->name('login');
Route::post('login', [LoginController::class,'login'])->name('login')->middleware('throttle:2,1');
Route::get('register', [LoginController::class,'registerView'])->name('register');
Route::post('register', [LoginController::class,'register'])->name('register');

});

Route::group(['middleware'=>'auth'], function(){
    Route::get('home', [LoginController::class,'dashboard'])->name('dashboard');

    Route::get('logout', [LoginController::class,'logout'])->name('logout');
});