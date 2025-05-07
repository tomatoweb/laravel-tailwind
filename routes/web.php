<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Models\Profile;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
Route::get('/', [ProductController::class, 'index'])->name('home')->middleware('ip');
//Route::view('/', 'welcome');


// group route
Route::prefix('/products')->name('products.')->controller(ProductController::class)->group( function () {

    Route::get('/', 'index')->name('index');

    Route::get('/{name}/{product}', 'show')->where([
        'name' => '[0-9a-zA-Z\-\[\]\(\)+",®\: ]+',
        'post' => '[0-9]+'

    ])->name('show');

    Route::delete('/{id}', 'destroy')->name('destroy');
});

Route::get('/login', function (Request $request) {
    return User::first()->createToken('auth_token')->plainTextToken;
})->name('auth.login');

//Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

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
})->middleware('auth');

// test token
Route::get('/testtoken', function (Request $request){
    $token = csrf_token();
    $token_ = $request->session()->token();
    return $token;
});

// test route
Route::get('/test', function (){
    Session::put('login', 'you are logged in');
});




