<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Models\Profile;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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

// simple route
Route::get('/', [ProductController::class, 'index'])->name('home');


// group route
Route::prefix('/products')->name('products.')->controller(ProductController::class)->group( function () {
    
    Route::get('/', 'index')->name('index');

    Route::get('/{name}/{product}', 'show')->where([
        'name' => '[0-9a-zA-Z\-\[\]\(\)+",®\: ]+',
        'post' => '[0-9]+'
        
    ])->name('show');
});

// CRUD shortcut route
Route::prefix('admin')->name('admin.')->group(function () {
  Route::resource('product', ProductController::class)->except(['']);
});



 

// test dev connection DB
Route::get('/testdbconnect', function (){
    try {
        $dbconnect = DB::connection()->getPDO();
        $dbname = DB::connection()->getDatabaseName();
        return "Connected successfully to the database. Database name is ".$dbname;
    } catch(Exception $e) {
        return "Error in connecting to the database";
    }
});




