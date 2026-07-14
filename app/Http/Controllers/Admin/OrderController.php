<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(private readonly ApiClient $api) {}

    /**
     * Halaman admin: daftar semua order untuk di-approve/reject
     */
    public function adminIndex(): View
    {
        $response = $this->api->get('/orders');
        $orders = $response->successful() ? $response->json() : [];

        return view('Admin.Konser.index', compact('orders'));
    }

    public function approve(int $id): RedirectResponse
    {
        $response = $this->api->post("/orders/{$id}/approve");

        if ($response->failed()) {
            return back()->withErrors([
                'order' => $response->json('message') ?? 'Gagal menyetujui order.',
            ]);
        }

        return back()->with('success', 'Order berhasil disetujui.');
    }

    public function reject(int $id): RedirectResponse
    {
        $response = $this->api->post("/orders/{$id}/reject");

        if ($response->failed()) {
            return back()->withErrors([
                'order' => $response->json('message') ?? 'Gagal menolak order.',
            ]);
        }

        return back()->with('success', 'Order berhasil ditolak.');
    }
}