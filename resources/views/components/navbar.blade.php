<nav class="bg-primary-900 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/images/logo2.png') }}" alt="Rumah Ticket" class="h-13 w-auto">

                <!-- Nama Website -->
                <div class="leading-tight mt-2">
                    <h1
                        class="text-2xl font-extrabold bg-linear-to-r from-white via-orange-200 to-orange-400 bg-clip-text text-transparent tracking-wide">
                        Rumah Ticket
                    </h1>
                </div>
            </a>

            <!-- Login -->
            @guest
                <a href="{{ route('login') }}"
                    class="flex items-center gap-2 bg-white text-primary-900 px-5 py-2 rounded-full font-semibold hover:bg-gray-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                    </svg>

                    Login

                </a>
            @else
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-2 bg-white text-primary-900 px-5 py-2 rounded-full font-semibold hover:bg-gray-100 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                    </svg>

                    {{ Auth::user()->name }}

                </a>

            @endguest

        </div>
    </div>
</nav>
