<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\TinController;
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

Route::get('/tin-tuc', [TinController::class, 'index']);
Route::get('/tin-tuc/{id}', [TinController::class, 'detail']);
// Route::resource('/quan-tri-tin', [QtTinController::class]);
// Route::get('/tin-tuc', function () {
//     return view('tin');
// });