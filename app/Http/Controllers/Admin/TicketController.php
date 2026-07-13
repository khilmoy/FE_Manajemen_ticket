<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct(private readonly ApiClient $api)
    {
    }

    public function create(int $konserId): View
    {
        $response = $this->api->get("/konsers/{$konserId}");

        if ($response->failed()) {
            abort(404);
        }

        $konser = $response->json();

        return view('admin.konser.ticket-create', compact('konser'));
    }

    public function store(Request $request, int $konserId): RedirectResponse
    {
        $request->validate([
            'ticket_name' => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $response = $this->api->post('/tickets', [
            'konser_id'   => $konserId,
            'ticket_name' => $request->input('ticket_name'),
            'price'       => $request->input('price'),
            'stock'       => $request->input('stock'),
        ]);

        if ($response->failed()) {
            return back()
                ->withInput()
                ->withErrors(['ticket_name' => $response->json('message') ?? 'Gagal menyimpan tiket']);
        }

        return redirect()
            ->route('konser.show', $konserId)
            ->with('success', 'Tiket berhasil ditambahkan');
    }

    public function edit(int $konserId, int $id): View
    {
        $ticketResponse = $this->api->get("/tickets/{$id}");

        if ($ticketResponse->failed()) {
            abort(404);
        }

        $konserResponse = $this->api->get("/konsers/{$konserId}");

        if ($konserResponse->failed()) {
            abort(404);
        }

        $ticket = $ticketResponse->json();
        $konser = $konserResponse->json();

        return view('admin.konser.ticket-edit', compact('ticket', 'konser'));
    }

    public function update(Request $request, int $konserId, int $id): RedirectResponse
    {
        $request->validate([
            'ticket_name' => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'status'      => 'required|in:available,sold_out',
        ]);

        $response = $this->api->put("/tickets/{$id}", $request->only(
            'ticket_name', 'price', 'stock', 'status'
        ));

        if ($response->failed()) {
            return back()
                ->withInput()
                ->withErrors(['ticket_name' => $response->json('message') ?? 'Gagal mengupdate tiket']);
        }

        return redirect()
            ->route('konser.show', $konserId)
            ->with('success', 'Tiket berhasil diupdate');
    }

    public function destroy(int $konserId, int $id): RedirectResponse
    {
        $response = $this->api->delete("/tickets/{$id}");

        if ($response->failed()) {
            return back()->withErrors(['delete' => $response->json('message') ?? 'Gagal menghapus tiket']);
        }

        return redirect()
            ->route('konser.show', $konserId)
            ->with('success', 'Tiket berhasil dihapus');
    }
}