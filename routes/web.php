<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SalesItemController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SupplierTransactionController;

Route::get('/', function () {
    return view('auth/login');
});
// Route::get('/register', function () {
//     return view('auth/register');
// });

Auth::routes();
// Route::get('/', LoginController::class)->name();
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/edit_profile', [HomeController::class, 'edit_profile'])->name('edit_profile');
Route::POST('/update_profile/{id}', [HomeController::class,'update_profile'])->name('update_profile');
Route::get('/password_change/', [HomeController::class,'update_password'])->name('update_password');



Route::resource('category', CategoryController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('customer', CustomerController::class);
Route::resource('product', ProductController::class);
Route::resource('sales', SalesController::class);
Route::get('/sales/items', [SalesItemController::class, 'index'])->name('salesItem.index');
// Route::get('/sales/customer/{customer_id}', [SalesController::class, 'show'])->name('sales.show');

Route::get('/findPrice', [SalesController::class, 'findPrice'])->name('findPrice');


Route::get('/report/daily', [ReportController::class, 'generateDailyReport'])->name('report.daily');
Route::get('/report/weekly', [ReportController::class, 'generateWeeklyReport'])->name('report.weekly');
Route::get('/report/monthly', [ReportController::class, 'generateMonthlyReport'])->name('report.monthly');
Route::get('/report/academic_year', [ReportController::class, 'generateAcademicReport'])->name('report.academicYear');

Route::get('/report/daily/{type}', [ReportController::class, 'download'])->name('report.download');
Route::get('/report/weekly/{type}', [ReportController::class, 'downloadWeekly'])->name('report.downloadWeekly');
Route::get('/report/monthly/{type}', [ReportController::class, 'downloadMonthly'])->name('report.downloadMonthly');
Route::post('/report/academic_year/{type}', [ReportController::class, 'downloadAcademic'])->name('report.downloadAcademicYear');

Route::post('/report/academic_year/term/{type}', [ReportController::class, 'downloadAcademicTerm'])->name('report.downloadAcademicYearTerm');



Route::resource('transaction', SupplierTransactionController::class);

