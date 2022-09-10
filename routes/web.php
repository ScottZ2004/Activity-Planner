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

Route::get('/', function () {
    return redirect('login');
});

Route::get('/my-activities', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/manage-activities', function () {
    return view('manage-activities');
})->middleware(['auth'])->name('manage-activities');

Route::get('/new-activity', function () {
    return view('new-activity');
})->middleware(['auth'])->name('new-activity');

Route::get('/manage-account', function () {
    return view('manage-account');
})->middleware(['auth'])->name('manage-account');

require __DIR__.'/auth.php';
