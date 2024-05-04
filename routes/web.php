<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use  App\Http\Controllers\ClientController;
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
});


Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user', [UserController::class, 'index'])->middleware('role');
Route::get('/apiUser', [UserController::class, 'apiUsers'])->name('api.users');
Route::get('user/{id}/edit', [UserController::class, 'edit']);
Route::delete('user/{id}', [UserController::class, 'destroy']);


Route::get('/client', [ClientController::class, 'index'])->name('client.index');
Route::get('/apiclient', [clientController::class, 'apiclient'])->name('api.client');

Route::get('/exportclientAll', [clientController::class, 'exportclientAll'])->name('exportPDF.clientAll');
Route::get('/exportclientAllExcel', [clientController::class, 'exportExcel'])->name('exportExcel.clientAll');

require __DIR__.'/auth.php';
