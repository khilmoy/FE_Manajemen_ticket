<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function __construct(private readonly ApiClient $api)
    {
    }

    public function index(): View
    {
        $response = $this->api->get('/kategori');
        $kategori = $response->successful() ? $response->json() : [];

        return view('admin.kategori', compact('kategori'));
    }

    public function create(): View
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $response = $this->api->post('/kategori', $request->only('name', 'description'));

        if ($response->failed()) {
            return back()
                ->withInput()
                ->withErrors(['name' => $response->json('message') ?? 'Gagal menyimpan kategori']);
        }

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(int $id): View
    {
        $response = $this->api->get("/kategori/{$id}");
        $kategori = $response->successful() ? $response->json() : abort(404);

        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $response = $this->api->put("/kategori/{$id}", $request->only('name', 'description'));

        if ($response->failed()) {
            return back()
                ->withInput()
                ->withErrors(['name' => $response->json('message') ?? 'Gagal mengupdate kategori']);
        }

        return redirect()
            ->route('admin.kategorid')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(int $id): RedirectResponse
    {
        $response = $this->api->delete("/kategori/{$id}");

        if ($response->failed()) {
            return back()->withErrors(['delete' => $response->json('message') ?? 'Gagal menghapus kategori']);
        }

        return redirect()
            ->route('admin.kategorid')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
