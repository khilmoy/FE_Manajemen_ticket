<?php

use App\Http\Controllers\ProfileController;
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

Route::get('admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('admin/kategori', function () {
    return view('admin.kategori');
})->name('admin.kategori');

Route::get('admin/kategori/create', function () {
    return view('admin.kategori.create');
})->name('admin.kategori.create');

Route::get('admin/kategori/{id}/update', function ($id) {
    return view('admin.kategori.update', ['id' => $id]);
})->name('admin.kategori.update');


require __DIR__.'/auth.php';