<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use  App\Http\Controllers\ClientController;
use App\Http\Controllers\Commandescontroller;
use  App\Http\Controllers\CategoriesController;
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
Route::post('/client', [ClientController::class, 'store'])->name('client.store');
Route::get('/apiclient', [clientController::class, 'apiclient'])->name('api.client');
Route::delete('client/{id}', [clientController::class, 'destroy']);
Route::get('client/{id}/edit', [clientController::class, 'edit']);
Route::patch('client/{id}/update', [clientController::class, 'update']);
Route::get('/exportclientAll', [clientController::class, 'exportclientAll'])->name('exportPDF.clientAll');
Route::get('/exportclientAllExcel', [clientController::class, 'exportExcel'])->name('exportExcel.clientAll');

Route::get('/categories', [categoriesController::class, 'index'])->name('categories.index');
Route::post('/categories', [categoriesController::class, 'store'])->name('categories.store');
Route::get('/apicategories', [categoriesController::class, 'apicategories'])->name('api.categories');
Route::delete('categories/{id}', [categoriesController::class, 'destroy']);
Route::get('categories/{id}/edit', [categoriesController::class, 'edit']);
Route::patch('categories/{id}/update', [categoriesController::class, 'update']);
Route::get('/exportcategoriesAll', [categoriesController::class, 'exportcategoriesAll'])->name('exportPDF.categoriesAll');
Route::get('/exportcategoriesAllExcel', [categoriesController::class, 'exportExcel'])->name('exportExcel.categoriesAll');


require __DIR__.'/auth.php';
