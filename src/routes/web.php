<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);
Route::get('/register', [ContactController::class, 'showRegisterForm']);
Route::post('/register', [ContactController::class, 'register']);
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [ContactController::class, 'login']);
Route::delete('/admin/{id}', [ContactController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin', [ContactController::class, 'admin'])->name('admin');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
