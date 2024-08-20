<?php
// routes/web.php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;

use App\Http\Controllers\Informacion\InformacionController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\LabelController;


Route::resource('/login', LoginController::class);
Route::resource('/register', RegisterController::class);

Route::middleware(['auth.redirect'])->group(function () {
    Route::get('/', [InformacionController::class, 'index'])->name('informacion.index');

    Route::get('/orders/search', [OrdersController::class, 'search'])->name('orders.search');
    Route::resource('/orders', OrdersController::class);

    Route::post('/label/print', [LabelController::class, 'print'])->name('label.print');
});
