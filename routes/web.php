<?php

use App\Http\Controllers\ProductController;
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

//Shopify authentication group middleware below:

Route::middleware(['verify.shopify', 'checkPlan'])->group(function (){

// HomePage below:  
Route::get('/', [ProductController::class,"showAllProducts"])->name("home");

Route::get('/view-products', [ProductController::class,"showAllProducts"])->name("viewProducts");



});
    
Route::get('/plans', [ProductController::class,"Plans"])->name("plans")->middleware(['verify.shopify']);

Route::post('/submit-product', [ProductController::class,"submitProduct"])->name("submitProduct");

Route::post('/publish-product', [ProductController::class,"publishProduct"])->name("publishProduct");

Route::post('/generate-keyword',[ProductController::class, 'generateKeyword'])->name('generateKeyword');

Route::post('/subscription-test/{shopDomain}',[ProductController::class, 'subscriptionTest'])->name('subscriptionTest');