<?php

namespace App\Http\Controllers;

use App\Models\Konser;

class HomeController extends Controller
{
    public function index()
    {
        $konsers = Konser::with(['kategori', 'tickets' => function ($query) {
                $query->where('status', 'available')->orderBy('price', 'asc');
            }])
            ->orderBy('date', 'asc')
            ->take(8)
            ->get();

        return view('home', compact('konsers'));
    }
}