<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    // Auth::guard('web')->logout();

    return view('dashboards.index');
})->middleware(['auth'])->name('home');

Route::resource('customers', CustomerController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('products', ProductController::class);
Route::resource('profiles', ProfileController::class);
Route::resource('settings', SettingController::class);
Route::resource('sales', SaleController::class);
Route::resource('purchases', PurchaseController::class);
Route::resource('users', UserController::class);

Route::get('getsaledetails/{sku}', [SaleController::class, 'getSaleDetails'])->name('sales.getsaledetails');
Route::get('getpurchasedetails/{sku}', [PurchaseController::class, 'getPurchaseDetails'])->name('purchases.getpurchasedetails');
Route::get('getproductbysku/{sku}', [ProductController::class, 'getProductBySKU'])->name('products.getproductbysku');
Route::get('getcities/{id}', [\App\Http\Controllers\CityController::class, 'getCities'])->name('cities.getcities');
Route::get('setlocale/{lang}', [HomeController::class, 'setlocale'])->name('lang');
Route::get('notifications-mark-as-read', [NotificationController::class, 'setlocale'])->name('notifications.mark-as-read');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboards.index');
Route::get('editV1/{id}', [ProfileController::class, 'editV1'])->name('users.editV1');
Route::get('barcodes', [ProductController::class, 'barcodes'])->name('settings.barcodes');
Route::get('get-new-barcode', [ProductController::class, 'getNewBarcode'])->name('settings.get-new-barcode');
Route::post('print-barcode', [ProductController::class, 'printBarcode'])->name('settings.print-barcode');
Route::get('downloads-barcode-image', [ProductController::class, 'downloadsBarcodeImage'])->name('downloads.barcode-image');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
