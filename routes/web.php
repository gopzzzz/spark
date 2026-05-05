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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



//admin panel 
Route::get('/', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
Route::get('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'logout'])->name('logout');

Route::get('/createblogs', [App\Http\Controllers\HomeController::class, 'createblogs'])->name('createblogs');
Route::get('/createbooks', [App\Http\Controllers\HomeController::class, 'createbooks'])->name('createbooks');
Route::get('/uploads', [App\Http\Controllers\HomeController::class, 'uploads'])->name('uploads');
Route::post('/uploadimage', [App\Http\Controllers\HomeController::class, 'uploadimage'])->name('uploadimage');
Route::post('/insertblog', [App\Http\Controllers\HomeController::class, 'insertblog'])->name('insertblog');
Route::post('/insertbooks', [App\Http\Controllers\HomeController::class, 'insertbooks'])->name('insertbooks');
Route::get('/toggle-gallary/{id}',[App\Http\Controllers\HomeController::class, 'toggleGallary'])->name('toggle.gallary');
Route::post('/blogfetch', [App\Http\Controllers\HomeController::class, 'blogfetch'])->name('blogfetch');
Route::post('/editblogs', [App\Http\Controllers\HomeController::class, 'editblogs'])->name('editblogs');
Route::post('/bookfetch', [App\Http\Controllers\HomeController::class, 'bookfetch'])->name('bookfetch');
Route::post('/editbooks', [App\Http\Controllers\HomeController::class, 'editbooks'])->name('editbooks');
Route::get('/deleteblog/{id}',[App\Http\Controllers\HomeController::class, 'deleteblog'])->name('deleteblog');
Route::get('/deletebooks/{id}',[App\Http\Controllers\HomeController::class, 'deletebooks'])->name('deletebooks');
Route::get('/orderlist', [App\Http\Controllers\HomeController::class, 'orderlist'])->name('orderlist');
Route::post('/orderfetch', [App\Http\Controllers\HomeController::class, 'orderfetch'])->name('orderfetch');
Route::post('/editorder', [App\Http\Controllers\HomeController::class, 'editorder'])->name('editorder');

Route::post('/create-order', [App\Http\Controllers\WebController::class, 'createOrder'])->name('create-order');
Route::get('/payment-success', [App\Http\Controllers\WebController::class, 'paymentSuccess'])->name('payment.success');




require __DIR__.'/auth.php';