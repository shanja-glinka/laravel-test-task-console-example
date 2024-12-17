<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->middleware('auth');
Route::get('/ajax/home-data', [HomeController::class,'ajaxData'])->middleware('auth');
Route::get('/operations', [OperationController::class,'index'])->middleware('auth');
Route::get('/operations/search', [OperationController::class,'search'])->middleware('auth');

