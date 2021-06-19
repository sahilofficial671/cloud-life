<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Vehicle\VehicleController;

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
    return view('index');
})->name("index");

Route::group(["middleware" => ['auth', 'verified']], function(){
    Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');

    Route::resource('vehicles', VehicleController::class);
    Route::post('vehicles/destroy/bulk', [VehicleController::class, 'destroyBulk'])->name('vehicles.destroy.bulk');
});
