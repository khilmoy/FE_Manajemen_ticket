<?php

namespace App\Http\Controllers;

use App\Models\Konser;

class DetailController extends Controller
{
    public function show(int $id)
    {
        $konser = Konser::with(['kategori', 'tickets' => function ($query) {
                $query->where('status', 'available')->orderBy('price', 'desc');
            }])
            ->findOrFail($id);

        return view('detail', compact('konser'));
    }
}