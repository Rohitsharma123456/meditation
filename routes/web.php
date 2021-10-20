<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AlgoController;
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


Route::middleware(['auth'])->group(function(){
  Route::get('/',[ProductController::class,'index'])->name('products');
  Route::get('/addtocart',[ProductController::class,'addtocart'])->name('addtocart');
  Route::get('/cartpage',[ProductController::class,'getcart'])->name('cartpage');
  Route::post('/create-checkout-session',[ProductController::class,'createcheckoutsession'])->name('createcheckoutsession');
 
});
Route::prefix('algo')->group(function(){
  Route::get('/index',[AlgoController::class,'index'])->name('index');

 
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
