<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SessionTokenController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $request->session()->put('api_token', $request->input('token'));

        return response()->json(['status' => 'ok']);
    }
}