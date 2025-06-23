<?php

use Carbon\Carbon;
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
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductReportController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductSupplierController;
use App\Http\Controllers\ProductStockMovementController;

use Telegram\Bot\Laravel\Facades\Telegram;


Route::get('/send-message', function () {
    $chatId = '1678655923'; // Replace with your chat ID
    $message = 'Hello, this is a message from Laravel!';

    Telegram::sendMessage([
        'chat_id' => $chatId,
        'text' => $message,
    ]);

    return 'Message sent to Telegram!';
});

Route::get('/get-updates', function () {
    $updates = Telegram::getUpdates();
    return $updates;
});

// Auth::routes();

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'loadlogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('network', NetworkController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('password', PasswordController::class);
    Route::resource('task', TaskController::class);
    Route::resource('priority', PriorityController::class);
    Route::resource('map', MapController::class);
    Route::resource('sla', SLAController::class);
    Route::resource('ticket', TicketController::class);
    Route::resource('role', RoleController::class);
    Route::resource('absensi', AbsensiController::class);
    Route::Resource('products', ProductController::class);
    Route::resource('product_stock_movements', ProductStockMovementController::class);
    Route::resource('product_reports', ProductReportController::class);
    Route::resource('product_categories', ProductCategoryController::class);
    Route::resource('product_suppliers', ProductSupplierController::class);
});
