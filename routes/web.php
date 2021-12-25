<?php

use App\Http\Controllers\ApiController;
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


Route::post('/saveProducts', [ApiController::class, 'save_products']);
Route::get('/getProducts', [ApiController::class, 'get_products']);
Route::delete('/deleteProducts', [ApiController::class, 'delete_products']);
Route::post('/saveCustomers', [ApiController::class, 'save_customers']);
Route::delete('/deleteCustomers', [ApiController::class, 'delete_customers']);
Route::get('/getCustomers', [ApiController::class, 'get_customers']);
Route::post('/saveTransactions', [ApiController::class, 'save_transactions']);
Route::get('/checkStockProduct', [ApiController::class, 'check_stock_product']);
