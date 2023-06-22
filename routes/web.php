<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminKuotaController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminInterfaceController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\UserProfileController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserHomeController::class, 'index'])->name('login');
Route::get('/about', [UserHomeController::class, 'about']);
Route::get('/contact', [UserHomeController::class, 'contact']);
Route::post('/checkkuota', [UserHomeController::class, 'checkKuota']);
Route::post('/checkkuota/bulan', [UserHomeController::class, 'kuotaPerBulan']);
Route::post('/checkkuota/jalur', [UserHomeController::class, 'kuotaPerBulan']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);

// menangani reload pada saat check kuota redirect ke home
Route::get('/checkkuota/bulan', [UserHomeController::class, 'direct']);
Route::get('/checkkuota/jalur', [UserHomeController::class, 'direct']);
Route::get('/checkkuota', [UserHomeController::class, 'direct']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'store'])->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/order', [UserOrderController::class, 'order']);
    Route::post('/order', [UserOrderController::class, 'konfirmasiOrder']);
    Route::post('/order/confirm', [UserOrderController::class, 'orderStore']);
    Route::get('/order/myorders', [UserOrderController::class, 'myOrders']);

    Route::get('/order/checkout/{order:kode_order}', [UserOrderController::class, 'checkout']);
    
    Route::get('/order/struk/{request}', [UserOrderController::class, 'struk']);
    Route::get('/order/reschedule/{order:kode_order}', [UserOrderController::class, 'getReschedule']);
    Route::put('/order/reschedule/{order:kode_order}', [UserOrderController::class, 'reschedule']);
    Route::resource('/user', UserProfileController::class);
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
    Route::resource('/dashboard/kuota', AdminKuotaController::class)->except('show');
    Route::post('/dashboard/kuota/hapus/{request}', [AdminKuotaController::class, 'hapusPerJalur']);
    Route::get('/dashboard/kuota/hapusExpired', [AdminKuotaController::class, 'kuotaExpired']);

    Route::resource('/dashboard/user', AdminUserController::class);
    Route::resource('/dashboard/order', AdminOrderController::class);
    Route::resource('/dashboard/report', AdminReportController::class);

    Route::post('/dashboard/kuota/import', [AdminKuotaController::class, 'importKuota']);

    Route::get('/dashboard/interface/slide', [AdminInterfaceController::class, 'slide']);
    Route::post('/dashboard/interface/slide', [AdminInterfaceController::class, 'update_slide']);

    Route::get('/dashboard/interface/about', [AdminInterfaceController::class, 'about']);
    Route::post('/dashboard/interface/about', [AdminInterfaceController::class, 'update_about']);
});
