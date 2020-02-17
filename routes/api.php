<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Admin routes */
Route::namespace('Api\Admin')
    ->prefix('admin')
    ->as('api.admin.')
    ->group(base_path('routes/admin/api.php'));

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
