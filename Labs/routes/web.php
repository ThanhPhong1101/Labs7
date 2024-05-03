<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginControllerr;

Route::get('/', [loginControllerr::class, 'xuatNguoiDung']);
Route::post('/submit', [loginControllerr::class, 'submitForm'])->name('submit');;
Route::get('/submit_delete/{id}', [loginControllerr::class, 'submitDelete']);
