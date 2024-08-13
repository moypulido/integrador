<?php
// routes/web.php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;

use App\Http\Controllers\Informacion\InformacionController;
use App\Http\Controllers\OrdersController;


Route::resource('/login', LoginController::class);
Route::resource('/register', RegisterController::class);

Route::middleware(['auth.redirect'])->group(function () {
    Route::get('/', [InformacionController::class, 'index'])->name('informacion.index');
    Route::resource('/orders', OrdersController::class);
});
