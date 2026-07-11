<?php

use App\Http\Controllers\Admin\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/detail', function () {
    return view('detail');
})->name('detail');

Route::get('/beli-ticket', function () {
    return view('ticket.payment');
})->name('ticket.payment');

Route::get('/invoice', function () {
    return view('ticket.invoice');
})->name('ticket.invoice');

Route::get('/e-ticket', function () {
    return view('ticket.e-ticket');
})->name('ticket.e-ticket');

Route::get('/admin', function () {
    return view('admin.dashboard');
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