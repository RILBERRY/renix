<?php

use App\Http\Controllers\EstimateController;
use App\Http\Controllers\FundsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StockController;
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
Route::middleware('auth')->group(function (){

    Route::get('/', function () {
        return redirect('/home');
    });
    // Route::get('/home', function () {
    //     return view('app.home');
    // });
  

    // sale
    Route::get('/sales',[EstimateController::class,'all'])->name('estimateAndInvoice.list');
    Route::get('/sales/estimate/create',[EstimateController::class,'createEstimate'])->name('create-estimate');
    Route::get('/sales/estimate/{estimate}/download',[EstimateController::class,'downloadEstimate'])->name('download-estimate');
    Route::get('/sales/estimate/{estimate}/edit',[EstimateController::class,'edit'])->name('edit-estimate');
    
    Route::get('/sales/invoice/{invoice}/edit',[InvoiceController::class,'viewInvoice'])->name('view-invoice');
    Route::get('/sales/invoice/{estimate}/create/',[InvoiceController::class,'createInvoice'])->name('create-invoice');
    
    // home
    Route::get('/home',[EstimateController::class,'all'])->name('home');
    
    // purchase
    Route::get('/purchases',[PurchasesController::class,'index'])->name('purchases.list');
    Route::get('/purchases/create',[PurchasesController::class,'create'])->name('create-purchases');
    Route::get('/purchases/{purchase}/edit',[PurchasesController::class,'edit'])->name('create-purchases');
    //inventory
    Route::get('/inventory',[StockController::class,'index'])->name('setting');
        
    // setting
    Route::get('/setting',[SettingsController::class,'index'])->name('setting');
    
    //fund
    Route::post('/setting/fund/create',[FundsController::class,'store'])->name('store-fund');
    Route::get('/setting/fund/create',[FundsController::class,'create'])->name('create-fund');
    
        
});