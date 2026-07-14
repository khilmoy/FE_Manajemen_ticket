<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KonserController extends Controller
{
    public function __construct(private readonly ApiClient $api) {}

    public function index(): View
    {
        $response = $this->api->get('/konsers');
        $konsers = $response->successful() ? $response->json() : [];
 
        $orderResponse = $this->api->get('/orders');
        $orders = $orderResponse->successful() ? $orderResponse->json() : [];

        return view('Admin.Konser.index', compact('konsers', 'orders'));
    }

    public function create(): View
    {
        $response = $this->api->get('/kategori');
        $kategori = $response->successful() ? $response->json() : [];

        return view('Admin.Konser.create', compact('kategori'));
    }

    /**
     * Simpan Konser + Tiket sekaligus.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kategori_id' => 'required|integer',
            'name'        => 'required|string|max:255',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // Tiket
            'ticket_name' => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        // Simpan konser
        $konserResponse = $this->api->postMultipart(
            '/konsers',
            [
                'kategori_id' => $request->kategori_id,
                'name'        => $request->name,
                'date'        => $request->date,
                'location'    => $request->location,
                'description' => $request->description,
            ],
            $request->file('image')
        );

        if ($konserResponse->failed()) {
            return back()
                ->withInput()
                ->withErrors([
                    'name' => $konserResponse->json('message') ?? 'Gagal menyimpan konser'
                ]);
        }

        $konser = $konserResponse->json();

        // Simpan tiket
        $ticketResponse = $this->api->post('/tickets', [
            'konser_id'   => $konser['id'],
            'ticket_name' => $request->ticket_name,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        if ($ticketResponse->failed()) {
            return redirect()
                ->route('konser.show', $konser['id'])
                ->withErrors([
                    'ticket_name' => $ticketResponse->json('message')
                        ?? 'Konser berhasil disimpan, tetapi tiket gagal ditambahkan.'
                ]);
        }

        return redirect()
            ->route('konser.index')
            ->with('success', 'Konser dan tiket berhasil ditambahkan.');
    }

    public function show(int $id): View
    {
        $konserResponse = $this->api->get("/konsers/{$id}");

        if ($konserResponse->failed()) {
            abort(404);
        }

        $ticketsResponse = $this->api->get('/tickets');
        $allTickets = $ticketsResponse->successful()
            ? $ticketsResponse->json()
            : [];

        $tickets = array_values(array_filter(
            $allTickets,
            fn($ticket) => $ticket['konser_id'] == $id
        ));

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

        $konser = $konserResponse->json();
        $kategori = $kategoriResponse->successful()
            ? $kategoriResponse->json()
            : [];

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
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $response = $this->api->putMultipart(
            "/konsers/{$id}",
            [
                'kategori_id' => $request->kategori_id,
                'name'        => $request->name,
                'date'        => $request->date,
                'location'    => $request->location,
                'description' => $request->description,
            ],
            $request->file('image')
        );

        if ($response->failed()) {
            return back()
                ->withInput()
                ->withErrors([
                    'name' => $response->json('message') ?? 'Gagal mengupdate konser'
                ]);
        }

        return redirect()
            ->route('konser.index')
            ->with('success', 'Konser berhasil diupdate.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $response = $this->api->delete("/konsers/{$id}");

        if ($response->failed()) {
            return back()->withErrors([
                'delete' => $response->json('message') ?? 'Gagal menghapus konser'
            ]);
        }

        return redirect()
            ->route('konser.index')
            ->with('success', 'Konser berhasil dihapus.');
    }
}