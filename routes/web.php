<?php

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Network;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SLAController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PriorityController;

Route::get('/', function () {
    return view(
        'dashboard',
        [
            'karyawan' => Karyawan::all()->count(),
            'barang' => Barang::all()->count(),
            'olt' => Network::all()->count(),
            'now' => Carbon::now()->translatedFormat('l d F Y'),
        ]
    );
});

Route::resource('network', NetworkController::class);

Route::resource('karyawan', KaryawanController::class);
Route::resource('password', PasswordController::class);
Route::resource('task', TaskController::class);
Route::resource('priority', PriorityController::class);
Route::resource('map', MapController::class);
Route::resource('barang', BarangController::class);
Route::resource('sla', SLAController::class);
