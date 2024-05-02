<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginControllerr;

Route::get('/', [loginControllerr::class, 'xuatNguoiDung']);
Route::post('/submit', [loginControllerr::class, 'submitForm'])->name('submit');;
Route::post('/submit_delete', [loginControllerr::class, 'submitDelete'])->name('submit_delete');;
