\<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar | Rumah Ticket</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- ================= LEFT ================= -->
        <div class="hidden lg:flex w-1/2 bg-primary-900 relative overflow-hidden">

            <!-- Dekorasi -->
            <div class="absolute -top-32 -left-32 w-80 h-80 rounded-full bg-primary-700 opacity-30"></div>
            <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-primary-600 opacity-20"></div>

            <div class="relative z-10 flex flex-col justify-center items-center w-full px-16">

                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex flex-col items-center">

                    <img src="{{ asset('assets/images/logo2.png') }}" alt="Rumah Ticket" class="h-24 w-auto">

                    <h1
                        class="mt-4 text-4xl font-extrabold tracking-wide bg-linear-to-r from-white via-orange-200 to-orange-400 bg-clip-text text-transparent">

                        Rumah Ticket

                    </h1>

                </a>

                <!-- Deskripsi -->
                <p class="mt-8 text-xl text-center text-primary-100 leading-relaxed max-w-lg">

                    Bergabunglah dan nikmati kemudahan membeli tiket konser, festival, dan berbagai event terbaik di Indonesia.

                </p>

            </div>

        </div>

        <!-- ================= RIGHT ================= -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-10">

            <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl p-8">

                <div class="text-center mb-8">

                    <h2 class="text-3xl font-bold text-gray-800">
                        Buat Akun
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Silakan isi data di bawah untuk membuat akun.
                    </p>

                </div>

                <!-- Alert error -->
                <div id="alertError" class="hidden mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600"></div>

                <form id="registerForm" class="mt-8 space-y-6">

                    <!-- Nama -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama
                        </label>

                        <input
                            type="text"
                            name="name"
                            required
                            placeholder="Masukkan nama lengkap"
                            class="w-full rounded-xl border border-gray-300 focus:border-primary-600 focus:ring-2 focus:ring-primary-200 px-4 py-3 outline-none transition">

                    </div>

                    <!-- Email -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            required
                            placeholder="Masukkan email"
                            class="w-full rounded-xl border border-gray-300 focus:border-primary-600 focus:ring-2 focus:ring-primary-200 px-4 py-3 outline-none transition">

                    </div>

                    <!-- Password -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Masukkan password"
                            class="w-full rounded-xl border border-gray-300 focus:border-primary-600 focus:ring-2 focus:ring-primary-200 px-4 py-3 outline-none transition">

                    </div>

                    <!-- Konfirmasi Password -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi password"
                            class="w-full rounded-xl border border-gray-300 focus:border-primary-600 focus:ring-2 focus:ring-primary-200 px-4 py-3 outline-none transition">

                    </div>

                    <!-- Button -->
                    <button
                        type="submit"
                        id="registerButton"
                        class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 rounded-xl transition disabled:opacity-60 disabled:cursor-not-allowed">

                        Daftar

                    </button>

                </form>

                <div class="mt-8 text-center">

                    <p class="text-gray-500">

                        Sudah punya akun?

                        <a href="{{ route('login') }}" class="text-primary-700 font-semibold hover:underline">

                            Login

                        </a>

                    </p>

                </div>

                <!-- Divider -->
                <div class="flex items-center my-8">

                    <div class="flex-1 border-t border-gray-200"></div>

                    <span class="px-4 text-gray-400 text-sm">
                        Rumah Ticket
                    </span>

                    <div class="flex-1 border-t border-gray-200"></div>

                </div>

                <div class="text-center">

                    <a href="{{ url('/') }}" class="text-secondary-700 hover:text-secondary-800 font-medium">

                        ← Kembali ke Beranda

                    </a>

                </div>

            </div>

        </div>

    </div>

    <script>
        const API_URL = '{{ config('global.api_url', 'http://localhost:8001/api') }}';

        document.getElementById('registerForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const button = document.getElementById('registerButton');
    const alertBox = document.getElementById('alertError');

    const name = this.name.value.trim();
    const email = this.email.value.trim();
    const password = this.password.value;
    const password_confirmation = this.password_confirmation.value;

    alertBox.classList.add('hidden');
    alertBox.textContent = '';

    button.disabled = true;
    button.textContent = 'Memproses...';

    try {
        const response = await fetch(`${API_URL}/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ name, email, password, password_confirmation }),
        });

        const data = await response.json();

        if (!response.ok) {
            const message = data.errors
                ? Object.values(data.errors).flat().join(' ')
                : (data.message || 'Registrasi gagal. Periksa kembali data kamu.');

            alertBox.textContent = message;
            alertBox.classList.remove('hidden');
            return;
        }


        window.location.href = '{{ route('login') }}?registered=1';

    } catch (err) {
        alertBox.textContent = 'Tidak bisa terhubung ke server. Coba lagi.';
        alertBox.classList.remove('hidden');
    } finally {
        button.disabled = false;
        button.textContent = 'Daftar';
    }
});
    </script>

</body>

</html>