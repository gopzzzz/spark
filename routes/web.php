<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\RelatedNoteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WatchHistoryController;

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
Route::get('/bannerlist', [BannerController::class, 'bannerlist'])->name('banners');
Route::post('/storebanner', [BannerController::class, 'storebanner'])->name('storebanner');
Route::post('/banneredit', [BannerController::class, 'banneredit'])->name('banneredit');
Route::get('/categorylist', [CategoryController::class, 'categorylist'])->name('categories');
Route::post('/storecategory', [CategoryController::class, 'storecategory'])->name('storecategory');
Route::post('/categoryedit', [CategoryController::class, 'categoryedit'])->name('categoryedit');
Route::get('/videolist', [VideoController::class, 'videolist'])->name('videos');
Route::post('/storevideo', [VideoController::class, 'storevideo'])->name('storevideo');
Route::post('/videoedit', [VideoController::class, 'videoedit'])->name('videoedit');
Route::get('/relatednoteslist', [RelatedNoteController::class, 'relatednoteslist'])->name('relatednotes');
Route::post('/storerelatednote', [RelatedNoteController::class, 'storerelatednote'])->name('storerelatednote');
Route::post('/relatednoteedit', [RelatedNoteController::class, 'relatednoteedit'])->name('relatednoteedit');
Route::get('/customerlist', [CustomerController::class, 'customerlist'])->name('customers');
Route::post('/storecustomer', [CustomerController::class, 'storecustomer'])->name('storecustomer');
Route::post('/customeredit', [CustomerController::class, 'customeredit'])->name('customeredit');
Route::get('/watchhistorylist', [WatchHistoryController::class, 'watchhistorylist'])->name('watchhistory');
Route::post('/storewatchhistory', [WatchHistoryController::class, 'storewatchhistory'])->name('storewatchhistory');
Route::post('/watchhistoryedit', [WatchHistoryController::class, 'watchhistoryedit'])->name('watchhistoryedit');


require __DIR__.'/auth.php';