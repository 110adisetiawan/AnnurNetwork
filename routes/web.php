<?php

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Ticket;
use App\Models\Absensi;
use App\Models\Network;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SLAController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PriorityController;



// Auth::routes();

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'loadlogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view(
            'dashboard',
            [
                'absensi' => Absensi::where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->first(),
                'ticket' => Ticket::all()->count(),
                'tickets' => Ticket::all(),
                'karyawan' => Karyawan::all()->count(),
                'barang' => Barang::all()->count(),
                'olt' => Network::all()->count(),
                'now' => Carbon::now()->translatedFormat('l d F Y'),
            ]
        );
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('network', NetworkController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('password', PasswordController::class);
    Route::resource('task', TaskController::class);
    Route::resource('priority', PriorityController::class);
    Route::resource('map', MapController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('sla', SLAController::class);
    Route::resource('ticket', TicketController::class);
    Route::resource('role', RoleController::class);
    Route::resource('absensi', AbsensiController::class);
});
