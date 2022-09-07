<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\ProfileController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile/{user}', ProfileController::class);

    Route::post('/friend/{user}', [FriendController::class, 'store'])->name('friend.store');
    Route::patch('/friend/{user}', [FriendController::class, 'update'])->name('friend.update');
    Route::delete('/friend/{user}', [FriendController::class, 'destroy'])->name('friend.destroy');
});


require __DIR__.'/auth.php';
