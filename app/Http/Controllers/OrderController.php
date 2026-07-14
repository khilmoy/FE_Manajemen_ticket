<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class OrderController extends Controller
{
    public function show(int $id): View
    {
        return view('ticket.invoice', compact('id'));
    }
    
    public function eTicket(int $id): View
    {
        return view('ticket.e-ticket', compact('id'));
    }
}