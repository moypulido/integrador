<?php
// routes/web.php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('informacion');
})->name('informacion');