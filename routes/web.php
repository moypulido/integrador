<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformacionController;

Route::get('/', [InformacionController::class, 'index'])->name('informacion');