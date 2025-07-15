<?php

use App\Http\Controllers\Admin\DataPembelianSeederController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\DataBeliController;
use App\Http\Controllers\DataPembelianController;
use App\Http\Controllers\DataPenjualanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplyerController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda.index');

    Route::get('/products', [BerandaController::class, 'products'])->name('product.index');

    Route::post('/cart/add/{id}', [BerandaController::class, 'add'])->name('cart.add');
    Route::get('/cart/list', [BerandaController::class, 'cartList'])->name('cart.list');
    Route::post('/cart/update', [BerandaController::class, 'update'])->name('cart.update');

    Route::get('/checkout', [BerandaController::class, 'checkout'])->name('checkout.index');
    Route::get('/order/proses', [CheckOutController::class, 'process'])->name('order.proses');
    Route::get('/order/payment/{id}', [CheckOutController::class, 'payment'])->name('order.payment');
    Route::get('/payment/success/{penjualan}', [CheckOutController::class, 'success'])->name('user.payment.success');


    Route::get('/my_orders', [OrderController::class, 'index'])->name('my.orders.index');
    Route::get('/my_orders/history', [OrderController::class, 'history'])->name('my.orders.history');
    Route::get('/my_orders/{id}', [OrderController::class, 'show'])->name('my.orders.show');

});

Route::get('/kelola_admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/kelola_penjual', [PenjualController::class, 'index'])->name('penjual.index');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/supplyer', [SupplyerController::class, 'index'])->name('supplyer.index');
Route::get('/kelola_pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
Route::get('/data_pembelian', [DataPembelianController::class, 'index'])->name('data_pembelian.index');
Route::get('/data_penjualan', [DataPenjualanController::class, 'index'])->name('data_penjualan.index');
Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
Route::get('/data_beli', [DataBeliController::class, 'index'])->name('data_beli.index');
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda.index');

Route::get('/kelola_admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::get('/kelola_penjual/create', [PenjualController::class, 'create'])->name('Penjual.create');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::get('/supplyer/create', [SupplyerController::class, 'create'])->name('supplyer.create');
Route::get('/kelola_pembeli/create', [PembeliController::class, 'create'])->name('Pembeli.create');
Route::get('/data_penjualan/create', [DataPenjualanController::class, 'create'])->name('data_penjualan.create');
Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');

// kode yang ditambahkan. silahkan untuk mengurutkan sendiri
Route::post('/pembelian/set-supplyer', [PembelianController::class, 'setSupplyer'])->name('pembelian.setSupplyer');
Route::delete('/pembelian/remove/{id}', [PembelianController::class, 'removeItem'])->name('pembelian.removeItem');
Route::post('/penjualan/set-pembeli', [PenjualanController::class, 'setPembeli'])->name('penjualan.setPembeli');
// Route::delete('/penjualan/destroy/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
Route::get('/penjualan/clear', [PenjualanController::class, 'clearAll'])->name('penjualan.clearAll');
Route::post('/penjualan/add-item', [PenjualanController::class, 'addItem'])->name('penjualan.addItem');
Route::get('/data_beli', [PembelianController::class, 'dataPembelian'])->name('data_beli.index');
Route::get('/data_jual', [PenjualanController::class, 'dataPenjualan'])->name('data_jual.index');
Route::patch('/data_jual/{penjualan}/update-status', [PenjualanController::class, 'updateStatus'])->name('data_jual.updateStatus');


Route::post('/kelola_admin', [AdminController::class, 'store'])->name('admin.store');
Route::post('/kelola_penjual', [PenjualController::class, 'store'])->name('penjual.store');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::post('/supplyer', [SupplyerController::class, 'store'])->name('supplyer.store');
Route::post('/kelola_pembeli', [PembeliController::class, 'store'])->name('pembeli.store');
Route::post('/data_penjualan', [DataPenjualanController::class, 'store'])->name('data_penjualan.store');
// Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::post('/data-beli/store', [DataBeliController::class, 'store'])->name('data_beli.store');


Route::get('/kelola_admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::get('/kelola_Penjual/{id}/edit', [PenjualController::class, 'edit'])->name('penjual.edit');
Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::get('/supplyer/{id}/edit', [SupplyerController::class, 'edit'])->name('supplyer.edit');
Route::get('/kelola_Pembeli/{id}/edit', [PembeliController::class, 'edit'])->name('pembeli.edit');
Route::get('/data_penjualan/{id}/edit', [DataPenjualanController::class, 'edit'])->name('data_penjualan.edit');
// Route::get('/pembelian/{kode_trx_beli}/edit', [PembelianController::class, 'edit'])->name('pembelian.edit');
Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');


Route::put('/kelola_admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::put('/kelola_penjual/{id}', [PenjualController::class, 'update'])->name('penjual.update');
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::put('/supplyer/{id}', [SupplyerController::class, 'update'])->name('supplyer.update');
Route::put('/kelola_pembeli/{id}', [PembeliController::class, 'update'])->name('pembeli.update');
Route::put('/data_penjualan/{id}', [DataPenjualanController::class, 'update'])->name('data_penjualan.update');
Route::put('/pembelian/{kode_trx_beli}', [PembelianController::class, 'update'])->name('pembelian.update');
// Route::get('/penjualan/{id}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit');
Route::put('/penjualan/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');


Route::delete('/kelola_admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::delete('/kelola_penjual/{id}', [PenjualController::class, 'destroy'])->name('penjual.destroy');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::delete('/supplyer/{id}', [SupplyerController::class, 'destroy'])->name('supplyer.destroy');
Route::delete('/kelola_pembeli/{id}', [PembeliController::class, 'destroy'])->name('pembeli.destroy');
Route::delete('/data_penjualan/{id}', [DataPenjualanController::class, 'destroy'])->name('data_penjualan.destroy');
// Route::delete('/pembelian/{kode_trx_beli}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');
// Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
Route::delete('penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

Route::get('/admin/seed-data-pembelian', [DataPembelianSeederController::class, 'runSeeder'])->name('admin.data_pembelian.seeder');
Route::post('/pembelian/item', [PembelianController::class, 'storeItem'])->name('pembelian.storeItem');
Route::post('/pembelian/final', [PembelianController::class, 'storeFinal'])->name('pembelian.storeFinal');
Route::get('/pembelian/clear', [PembelianController::class, 'clearAll'])->name('pembelian.clearAll');
Route::delete('/pembelian/item/{id}', [PembelianController::class, 'deleteItem'])->name('pembelian.deleteItem');
Route::post('/pembelian/add-item', [PembelianController::class, 'addItem'])->name('pembelian.addItem');

// Route::delete('/pembelian/remove-item/{id}', [PembelianController::class, 'removeItem'])->name('pembelian.removeItem');
Route::post('/pembelian/tambah-item', [PembelianController::class, 'tambahItem'])->name('pembelian.tambahItem');

Route::get('/my-orders/{order}/invoice/download', [OrderController::class, 'downloadInvoice'])
    ->name('my.orders.invoice.download')
    ->middleware('auth');


require __DIR__ . '/auth.php';
