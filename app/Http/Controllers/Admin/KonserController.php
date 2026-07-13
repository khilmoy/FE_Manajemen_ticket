<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KonserController extends Controller
{
    public function __construct(private readonly ApiClient $api)
    {
    }

    public function index(): View
    {
        $response = $this->api->get('/konsers');
        $konsers  = $response->successful() ? $response->json() : [];

        return view('admin.konser.index', compact('konsers'));
    }

    public function create(): View
    {
        $response = $this->api->get('/kategori');
        $kategori = $response->successful() ? $response->json() : [];

        return view('admin.konser.create', compact('kategori'));
    }

    /**
     * Simpan Konser + Tiket sekaligus dari 1 form.
     * Tetap 2 request terpisah ke BE (KonserController & TicketController BE tidak digabung),
     * cuma alurnya dirangkai di sini.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kategori_id'  => 'required|integer',
            'name'         => 'required|string|max:255',
            'date'         => 'required|date',
            'location'     => 'required|string|max:255',
            'description'  => 'nullable|string',

            // field tiket, digabung di form yang sama
            'ticket_name'  => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
        ]);

        // 1. Simpan konser dulu
        $konserResponse = $this->api->post('/konsers', $request->only(
            'kategori_id', 'name', 'date', 'location', 'description'
        ));

        if ($konserResponse->failed()) {
            return back()
                ->withInput()
                ->withErrors(['name' => $konserResponse->json('message') ?? 'Gagal menyimpan konser']);
        }

        $konser = $konserResponse->json();

        // 2. Simpan tiket, pakai konser_id yang baru dibuat
        $ticketResponse = $this->api->post('/tickets', [
            'konser_id'   => $konser['id'],
            'ticket_name' => $request->input('ticket_name'),
            'price'       => $request->input('price'),
            'stock'       => $request->input('stock'),
        ]);

        if ($ticketResponse->failed()) {
            // Konser sudah kebuat tapi tiketnya gagal — beri tahu user, tapi tetap arahkan ke detail
            // supaya bisa nambah tiket manual lewat halaman show.
            return redirect()
                ->route('konser.show', $konser['id'])
                ->withErrors(['ticket_name' => $ticketResponse->json('message') ?? 'Konser tersimpan, tapi tiket gagal disimpan. Silakan tambah manual.']);
        }

        return redirect()
            ->route('konser.index')
            ->with('success', 'Konser dan tiket berhasil ditambahkan');
    }

    public function show(int $id): View
    {
        $konserResponse = $this->api->get("/konsers/{$id}");

        if ($konserResponse->failed()) {
            abort(404);
        }

        $ticketsResponse = $this->api->get('/tickets');
        $allTickets      = $ticketsResponse->successful() ? $ticketsResponse->json() : [];

        $tickets = array_values(array_filter($allTickets, fn ($t) => $t['konser_id'] === $id));

        $konser = $konserResponse->json();

        return view('admin.konser.show', compact('konser', 'tickets'));
    }

    public function edit(int $id): View
    {
        $konserResponse = $this->api->get("/konsers/{$id}");

        if ($konserResponse->failed()) {
            abort(404);
        }

        $kategoriResponse = $this->api->get('/kategori');

        $konser   = $konserResponse->json();
        $kategori = $kategoriResponse->successful() ? $kategoriResponse->json() : [];

        return view('admin.konser.edit', compact('konser', 'kategori'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'kategori_id' => 'required|integer',
            'name'        => 'required|string|max:255',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $response = $this->api->put("/konsers/{$id}", $request->only(
            'kategori_id', 'name', 'date', 'location', 'description'
        ));

        if ($response->failed()) {
            return back()
                ->withInput()
                ->withErrors(['name' => $response->json('message') ?? 'Gagal mengupdate konser']);
        }

        return redirect()
            ->route('konser.index')
            ->with('success', 'Konser berhasil diupdate');
    }

    public function destroy(int $id): RedirectResponse
    {
        $response = $this->api->delete("/konsers/{$id}");

        if ($response->failed()) {
            return back()->withErrors(['delete' => $response->json('message') ?? 'Gagal menghapus konser']);
        }

        return redirect()
            ->route('konser.index')
            ->with('success', 'Konser berhasil dihapus');
    }
}