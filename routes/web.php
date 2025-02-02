<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PriorityController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('network', NetworkController::class);

Route::resource('karyawan', KaryawanController::class);
Route::resource('password', PasswordController::class);
Route::resource('task', TaskController::class);
Route::resource('priority', PriorityController::class);
