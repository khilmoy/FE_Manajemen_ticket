<?php

<<<<<<< HEAD
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\ProfileController;
=======
>>>>>>> c1e4de6c858c7a7f63bf57f380beac374462f266
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

<<<<<<< HEAD
// Route::get('admin/kategori', function () {
//     return view('admin.kategori');
// })->name('admin.kategori');

// Route::get('admin/kategori/create', function () {
//     return view('admin.kategori.create');
// })->name('admin.kategori.create');

// Route::get('admin/kategori/{id}/update', function ($id) {
//     return view('admin.kategori.update', ['id' => $id]);
// })->name('admin.kategori.update');

// routes/web.php — di dalam grup ->prefix('admin')->name('admin.')

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


require __DIR__.'/auth.php';
=======
Route::get('/admin/kategori', function () {
    return view('admin.kategori');
})->name('admin.kategori');

Route::get('/admin/kategori/create', function () {
    return view('admin.kategori.create');
})->name('admin.kategori.create');

Route::get('/admin/kategori/{id}/update', function ($id) {
    return view('admin.kategori.update', ['id' => $id]);
})->name('admin.kategori.update');
>>>>>>> c1e4de6c858c7a7f63bf57f380beac374462f266
