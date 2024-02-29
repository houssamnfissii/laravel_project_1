<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripexController;
use App\Http\Controllers\TripuserController;
use App\Http\Controllers\UseradController;
use App\Models\Review;
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
    return view('auth.home');
})->name('home');

Route::group(['middleware'=>'web'],function(){
    Route::get('register',[AuthController::class,'register'])->name('register');
    Route::post('store',[AuthController::class,'store'])->name('store');
    Route::get('login',[AuthController::class,'login'])->name('login');
    Route::post('authenticate',[AuthController::class,'authenticate'])->name('authenticate');
    Route::post('logout',[AuthController::class,'logout'])->name('logout');
    // Route::resource('profile',ProfileController::class);
    Route::get('profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('tripuser',[TripuserController::class,'index'])->name('explore');
    Route::get('tripuser/{id}',[TripuserController::class,'show'])->name('show.tripuser');
    Route::post('/tripusers/{id}/book', [TripuserController::class, 'book'])->name('tripusers.book');
    Route::get('/tripusers/mytrips', [TripuserController::class, 'userTrips'])->name('user.trips');
    Route::delete('/tripusers/nytrips/{id}', [TripuserController::class, 'destroy'])->name('tripuser.destroy');

});
Route::group(['middleware' => ['admin', 'web']], function () {


    Route::get('/trips/export', [TripexController::class, 'export'])->name('trips.export');
    Route::post('/trips/import', [TripexController::class, 'import'])->name('trips.import');

    Route::get('/api/reviews', [ReviewController::class, 'index']);
    Route::post('/api/reviews', [ReviewController::class, 'store']);
    Route::resource('/trip', TripController::class);
    Route::resource('/user', UseradController::class);
    Route::resource('/activity', ActivityController::class);
});