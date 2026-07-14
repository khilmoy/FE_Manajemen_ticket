<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\ApiClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function __construct(private readonly ApiClient $api) {}

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // ==========================
        // Ambil token Sanctum dari BE, simpan di session
        // ==========================
        // Supaya request dari ApiClient (admin) ke BE bisa lolos
        // middleware auth:sanctum, sama seperti request dari customer
        // yang menyimpan token di localStorage.
        $response = $this->api->post('/login', [
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $request->session()->put('api_token', $response->json('token'));
        }

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout juga dari sisi API (hapus token Sanctum di BE)
        if ($request->session()->has('api_token')) {
            $this->api->post('/logout');
            $request->session()->forget('api_token');
        }

        auth()->guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}