<?php

namespace App\Http\Controllers;

use App\Services\ApiClient;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(private readonly ApiClient $api) {}

    public function index(): View
    {
        // Ambil semua konser
        $konserResponse = $this->api->get('/konsers');
        $konsers = $konserResponse->successful() ? $konserResponse->json() : [];

        // Ambil semua tiket, untuk menghitung harga termurah per konser
        $ticketResponse = $this->api->get('/tickets');
        $allTickets = $ticketResponse->successful() ? $ticketResponse->json() : [];

        // Tempelkan harga termurah ke masing-masing konser
        foreach ($konsers as &$konser) {
            $ticketsForKonser = array_values(array_filter(
                $allTickets,
                fn($ticket) => $ticket['konser_id'] == $konser['id']
            ));

            if (!empty($ticketsForKonser)) {
                usort($ticketsForKonser, fn($a, $b) => $a['price'] <=> $b['price']);
                $konser['harga_termurah'] = $ticketsForKonser[0]['price'];
            } else {
                $konser['harga_termurah'] = null;
            }
        }
        unset($konser); // penting: hapus reference setelah foreach by-reference

        // Banner carousel pakai gambar dari 3 konser pertama yang punya gambar
        $banners = array_values(array_filter(
            $konsers,
            fn($k) => !empty($k['image_url'])
        ));
        $banners = array_slice($banners, 0, 3);

        return view('home', compact('konsers', 'banners'));
    }
}