<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Vehicle\VehicleController;
use App\Http\Controllers\Vehicle\VehicleServiceController;

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

    // Vehicle Services
    Route::prefix('vehicles/{vehicle_id}/services')->name('vehicles.services')->group(function(){
        Route::post('/', [VehicleServiceController::class, 'store'])->name('.store');
        Route::get('/create', [VehicleServiceController::class, 'create'])->name('.create');

        Route::prefix('/{service_id}')->group(function(){
            Route::get('/serviced', [VehicleServiceController::class, 'serviced'])->name('.serviced');
            Route::get('/complete', [VehicleServiceController::class, 'complete'])->name('.complete');
            Route::get('/cancel', [VehicleServiceController::class, 'cancel'])->name('.cancel');
        });
    });
});
