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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Tenant aware Routes need to include this 'tenant' middleware
Route::prefix('/tenant')->middleware('tenant')->group(function() {
    require __DIR__.'/auth.php';

    Route::get('/database', function () {
        try {
            \DB::connection()->getPDO();
            echo \DB::connection()->getDatabaseName();
        } catch (\Exception $e) {
            echo 'None';
        }
    });

    Route::get('/test', function () {
        return auth()->user();
    });
});
