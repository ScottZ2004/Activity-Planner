<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
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
    return redirect()->route('dashboard');
})->middleware(['auth']);

Route::get('/my-activities', [ActivityController::class, 'my_activities'])->middleware(['auth'])->name('dashboard');

Route::get('/manage-activities', [ActivityController::class, 'manage_activties'])->middleware(['auth'])->name('manage-activities');

Route::get('/new-activity', [ActivityController::class, 'new_activity'])->middleware(['auth'])->name('new-activity');
Route::post('/create-activity', [ActivityController::class, 'create_activity'])->middleware(['auth'])->name('create_activity');

Route::get('/activity/{slug}', [ActivityController::class, 'activity'])->middleware(['auth'])->name('activity');
Route::post('/availability/{slug}/update', [ActivityController::class, 'update_availability'])->middleware(['auth'])->name('update-availability');

Route::get('/manage-account', [ActivityController::class, 'manage_account'])->middleware(['auth'])->name('manage-account');

require __DIR__.'/auth.php';
