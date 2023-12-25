<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

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
Route::get('login', [UserController::class,'index'])->name('login');
Route::post('login', [UserController::class,'login'])->name('login')->middleware('throttle:2,1');
Route::get('register', [UserController::class,'registerView'])->name('register');
Route::post('register', [UserController::class,'register'])->name('register');

});

Route::group(['middleware'=>'auth'], function(){
    Route::get('home', [UserController::class,'dashboard'])->name('dashboard');

    Route::get('logout', [UserController::class,'logout'])->name('logout');
});
//mail
// Route::get('/mail', function(){
//     Mail::send([], [], function($msg) {
//         $msg->from('sourabh@gmail.com', 'Your Name')
//             ->to("test@test.com", "mail send")
//             ->subject("hii sourabh who")
//             ->text("Advance Laravel ");
//     });
//     echo "mail sent";
// });
// Route::get('/mail', function(){
//     Mail::to("sourabh@gmail.com")
//     ->send (new \App\Mail\SendTestMail());
//     echo "mail sent";
// });
