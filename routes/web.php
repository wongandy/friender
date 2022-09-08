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

    Route::get('/profile/{user}', ProfileController::class)->name('profile');

    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::post('/friends/{user}', [FriendController::class, 'store'])->name('friends.store');
    Route::patch('/friends/{user}', [FriendController::class, 'update'])->name('friends.update');
    Route::delete('/friends/{user}', [FriendController::class, 'destroy'])->name('friends.destroy');
});


require __DIR__.'/auth.php';
