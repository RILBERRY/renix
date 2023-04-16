<?php

use Illuminate\Support\Facades\Route;

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
    return view('main');
});
Route::get('/home', function () {
    return view('app.home');
});
Route::get('/sales', function () {
    return view('app.sales');
});
Route::get('/sales/estimate/create', function () {
    return view('app.create-estimate');
});
Route::get('/purchases', function () {
    return view('app.purchases');
});
Route::get('/inventory', function () {
    return view('app.inventory');
});
