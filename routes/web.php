<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\AduanController;
use Illuminate\Support\Facades\Route;

// auth
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('login_store', [AuthController::class, 'login_store']);
Route::post('login_store', [AuthController::class, 'login_store_action']);
Route::get('logout_store', [AuthController::class, 'logout_store']);

Route::get('register_store', [AuthController::class, 'register_store']);
Route::post('register_store', [AuthController::class, 'register_store_action']);

Route::get('login_member', [AuthController::class, 'login_member']);
Route::post('login_member', [AuthController::class, 'login_member_action']);
Route::get('logout_member', [AuthController::class, 'logout_member']);

Route::get('register_member', [AuthController::class, 'register_member']);
Route::post('register_member', [AuthController::class, 'register_member_action']);

// kategori
Route::get('/kategori', [CategoryController::class, 'list']);
Route::get('/subkategori', [SubcategoryController::class, 'list']);
Route::get('/slider', [SliderController::class, 'list']);
Route::get('/barang', [ProductController::class, 'list']);
Route::get('/testimoni', [TestimoniController::class, 'list']);
Route::get('/review', [ReviewController::class, 'list']);
Route::get('/pengembalian', [RefundController::class, 'list']);
Route::get('/pengaduan', [AduanController::class, 'list']);
Route::get('/payment', [PaymentController::class, 'list']);
Route::get('/payment_store', [PaymentController::class, 'list_store']);

Route::get('/pesanan/baru', [OrderController::class, 'list']);
Route::get('/pesanan/dikonfirmasi', [OrderController::class, 'dikonfirmasi_list']);
Route::get('/pesanan/dikemas', [OrderController::class, 'dikemas_list']);
Route::get('/pesanan/dikirim', [OrderController::class, 'dikirim_list']);
Route::get('/pesanan/diterima', [OrderController::class, 'diterima_list']);
Route::get('/pesanan/refund', [OrderController::class, 'refund_list']);
Route::get('/pesanan/selesai', [OrderController::class, 'selesai_list']);

Route::get('/laporan', [ReportController::class, 'index']);
Route::get('/laporan/penjualan', [ReportController::class, 'penjualan_list']);
Route::get('/laporan/pembayaran', [ReportController::class, 'pembayaran_list']);
Route::get('/laporan/orderselesai', [ReportController::class, 'orderselesai_list']);
Route::get('/laporan/barangdiminati', [ReportController::class, 'barangdiminati_list']);
Route::get('/laporan/codreport', [ReportController::class, 'codreport_list']);
Route::get('/laporan/refund', [ReportController::class, 'orderrefund_list']);
Route::get('/laporan/beli', [ReportController::class, 'beli_list']);
Route::get('/laporan/kerusakan', [ReportController::class, 'kerusakan_list']);

Route::get('/tentang', [TentangController::class, 'index']);
Route::post('/tentang/{about}', [TentangController::class, 'update']);

Route::get('/dashboard', [DashboardController::class, 'index']);

// home routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/products/{category}', [HomeController::class, 'products']);
Route::get('/product/{id}', [HomeController::class, 'product']);
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/orders', [HomeController::class, 'orders']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/penilaian', [HomeController::class, 'penilaian']);
Route::get('/refund', [HomeController::class, 'refund']);
Route::get('/store/{id}', [HomeController::class, 'store']);

Route::post('/add_to_cart', [HomeController::class, 'add_to_cart']);
Route::get('/delete_from_cart/{cart}', [HomeController::class, 'delete_from_cart']);
Route::get('/get_kota/{id}', [HomeController::class, 'get_kota']);
Route::get('/get_ongkir/{destination}/{weight}', [HomeController::class, 'get_ongkir']);
Route::post('/checkout_orders', [HomeController::class, 'checkout_orders']);
Route::post('/payments', [HomeController::class, 'payments']);
Route::post('/pesanan_selesai/{order}', [HomeController::class, 'pesanan_selesai']);
Route::post('/pesanan_refund/{order}', [HomeController::class, 'pesanan_refund']);
Route::post('/testimoni', [HomeController::class, 'testimoni']);
Route::post('/keluhan', [HomeController::class, 'keluhan']);
Route::post('/aduan', [HomeController::class, 'aduan']);

//laporan pdf
Route::get('/laporan/pdf', [ReportController::class, 'pdf1'])->name('pdf1');
Route::get('/laporan/jual', [ReportController::class, 'jual'])->name('jual');
Route::get('/laporan/transfer', [ReportController::class, 'transfer'])->name('transfer');
Route::get('/laporan/done', [ReportController::class, 'done'])->name('done');
Route::get('/laporan/minat', [ReportController::class, 'minat'])->name('minat');
Route::get('/laporan/kembali', [ReportController::class, 'kembali'])->name('kembali');
Route::get('/laporan/cod', [ReportController::class, 'cod'])->name('cod');
Route::get('/laporan/pembelian', [ReportController::class, 'pembelian'])->name('pembelian');
Route::get('/laporan/rusakan', [ReportController::class, 'rusakan'])->name('rusakan');