<?php
/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
*/

Route::resource('products', 'ProductController');
Route::post('products/import')->uses('ProductController@import')->name('products.import');
