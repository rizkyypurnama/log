<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\DPostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LivestreamController;

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
})->middleware('guest');

//dash
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/dashboard',[DashboardController::class, 'cari'])->middleware('auth');

//login
Route::get('login',[LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('login',[LoginController::class, 'auth']);
Route::post('logout',[LoginController::class, 'logout']);
//reg
Route::get('register',[RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('register',[RegisterController::class, 'register']);

//album isi
Route::get('/tambahfoto/{id}',[FotoController::class, 'tambahfoto'])->name('tambahfoto')->middleware('auth');
Route::post('/inserttambahfoto',[FotoController::class, 'inserttambahfoto'])->middleware('auth');
//album
Route::get('/album',[AlbumController::class, 'index'])->name('album')->middleware('auth');
Route::get('/tambahalbum',[AlbumController::class, 'tambahalbum'])->name('tambahalbum')->middleware('auth');
Route::post('/insertalbum',[AlbumController::class, 'insertalbum'])->middleware('auth');
Route::post('/insertkeranjang',[KeranjangController::class, 'insertkeranjang'])->middleware('auth');
Route::post('/editalbum/{id}',[AlbumController::class, 'editalbum'])->middleware('auth');
Route::get('/hapusalbum/{id}',[AlbumController::class, 'hapusalbum'])->middleware('auth');
Route::post('/editalbumprofile/{idalbum}/{id}',[AlbumController::class, 'editalbumprofile'])->middleware('auth');
Route::get('/hapusalbumprofile/{id}',[AlbumController::class, 'hapusalbumprofile'])->middleware('auth');

//foto
Route::post('/insertfoto',[FotoController::class, 'insertfoto'])->middleware('auth');
Route::post('/editpost/{id}',[FotoController::class, 'editpost'])->middleware('auth');
Route::get('/hapuspost/{id}',[FotoController::class, 'hapuspost'])->middleware('auth');

//like
Route::post('/likedetail/{id}',[LikeController::class, 'likedetail'])->middleware('auth');
Route::post('/unlikedetail/{id}',[LikeController::class, 'unlikedetail'])->middleware('auth');
Route::post('/like/{id}',[LikeController::class, 'like'])->middleware('auth');
Route::post('/unlike/{id}',[LikeController::class, 'unlike'])->middleware('auth');

//profile
Route::get('/profile/{id}',[ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::get('/profilealbum/{id}',[ProfileController::class, 'profilealbum'])->middleware('auth')->name('profilealbum');
Route::get('/profileliketerbanyak/{id}',[ProfileController::class, 'profileliketerbanyak'])->middleware('auth')->name('profileliketerbanyak');
Route::get('/profilekomenterbanyak/{id}',[ProfileController::class, 'profilekomenterbanyak'])->middleware('auth')->name('profilekomenterbanyak');
Route::post('/updateprofile/{id}',[ProfileController::class, 'editprofile'])->middleware('auth');

//komen
Route::post('/insertkomen/{id}',[KomentarController::class, 'insertkomen'])->middleware('auth');
Route::get('/hapuskomen/{id}/{idkomen}',[KomentarController::class, 'hapuskomen'])->middleware('auth');
Route::post('/editkomen/{id}/{idkomen}',[KomentarController::class, 'editkomen'])->middleware('auth');

//notif
Route::get('/notif/{id}',[NotifController::class, 'index'])->name('notif')->middleware('auth');

//nyoba
Route::get('/livestream' ,[LivestreamController::class, 'index'])->name('livestream')->middleware('auth');

//Deptailpostingan
Route::get('/detailpost/{id}' ,[DPostController::class, 'index'])->name('detailpost')->middleware('auth');

//ajax
Route::get('/ajax' , [DashboardController::class, 'ajax'])->name('ajax')->middleware('auth');
Route::get('/listteman' , [DashboardController::class, 'listteman'])->name('listteman')->middleware('auth');