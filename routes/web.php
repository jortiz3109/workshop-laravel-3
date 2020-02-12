<?php

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

Auth::routes();

/* Admin routes */
Route::namespace('Admin')
    ->prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'verified'])
    ->group(base_path('routes/admin/web.php'));

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
});
