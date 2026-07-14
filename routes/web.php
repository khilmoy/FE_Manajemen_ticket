<?php

use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KonserController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/detail/{id}', [DetailController::class, 'show'])->name('detail');

Route::get('/beli-ticket', function () {
    return view('ticket.payment');
})->name('ticket.payment');

// Invoice & E-Ticket sekarang butuh order id (data diambil dari API)
Route::get('/order/{id}', [OrderController::class, 'show'])->name('ticket.invoice');
Route::get('/order/{id}/e-ticket', [OrderController::class, 'eTicket'])->name('ticket.e-ticket');

Route::get('/admin', function () {
    return view('Admin.dashboard');
})->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| Admin Kategori
|--------------------------------------------------------------------------
*/

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

require __DIR__.'/auth.php';

Route::get('/konser', [KonserController::class, 'index'])->name('konser.index');
Route::get('/konser/create', [KonserController::class, 'create'])->name('konser.create');
Route::post('/konser', [KonserController::class, 'store'])->name('konser.store');
Route::get('/konser/{id}', [KonserController::class, 'show'])->name('konser.show');
Route::get('/konser/{id}/edit', [KonserController::class, 'edit'])->name('konser.edit');
Route::put('/konser/{id}', [KonserController::class, 'update'])->name('konser.update');
Route::delete('/konser/{id}', [KonserController::class, 'destroy'])->name('konser.destroy');

Route::get('/konser/{konser}/ticket/create', [TicketController::class, 'create'])->name('konser.ticket.create');
Route::post('/konser/{konser}/ticket', [TicketController::class, 'store'])->name('konser.ticket.store');
Route::get('/konser/{konser}/ticket/{id}/edit', [TicketController::class, 'edit'])->name('konser.ticket.edit');
Route::put('/konser/{konser}/ticket/{id}', [TicketController::class, 'update'])->name('konser.ticket.update');
Route::delete('/konser/{konser}/ticket/{id}', [TicketController::class, 'destroy'])->name('konser.ticket.destroy');

// Admin: dashboard approve/reject
Route::get('/admin/order', [AdminOrderController::class, 'adminIndex'])->name('admin.order.index');
Route::post('/admin/order/{id}/approve', [AdminOrderController::class, 'approve'])->name('admin.order.approve');
Route::post('/admin/order/{id}/reject', [AdminOrderController::class, 'reject'])->name('admin.order.reject');