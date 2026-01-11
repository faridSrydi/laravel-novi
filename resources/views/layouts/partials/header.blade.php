<header class="bg-white border-b-2 border-pink-100 sticky top-0 z-50 font-sans" x-data="{ mobileMenu: false }">
    <div class="bg-pink-100 py-2 px-4 text-center">
        <p class="text-xs font-bold text-pink-600 tracking-wide">
            ✨ Gratis Ongkir Jajanan Minimal Rp 50.000 ✨
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <div class="flex items-center justify-between h-20">

            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex-shrink-0 group hover:scale-105 transition duration-300">
                    <div class="flex items-center gap-1">
                        <span
                            class="text-2xl font-black bg-pink-500 text-white px-4 py-1.5 rounded-3xl transform -rotate-2 shadow-sm border-b-4 border-pink-600">
                            MINI<span class="text-yellow-200">MOO</span>
                        </span>
                    </div>
                </a>

                <nav class="hidden lg:flex items-center gap-6">
                    <a href="#"
                        class="text-sm font-bold text-gray-600 hover:text-pink-500 hover:bg-pink-50 px-3 py-2 rounded-xl transition">Jajanan</a>
                    <a href="#"
                        class="text-sm font-bold text-gray-600 hover:text-pink-500 hover:bg-pink-50 px-3 py-2 rounded-xl transition">Minuman</a>
                    <a href="#"
                        class="text-sm font-bold text-gray-600 hover:text-pink-500 hover:bg-pink-50 px-3 py-2 rounded-xl transition">Roti
                        & Kue</a>
                    <a href="#"
                        class="text-sm font-bold text-pink-500 bg-pink-50 px-3 py-2 rounded-xl hover:bg-pink-100 transition border border-pink-200">🔥
                        Promo</a>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <div
                    class="hidden md:flex items-center bg-gray-50 px-4 py-2.5 rounded-full border border-gray-200 focus-within:border-pink-400 focus-within:ring-2 focus-within:ring-pink-100 transition w-64">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Cari keripik, susu..."
                        class="bg-transparent border-none text-sm focus:ring-0 w-full placeholder-gray-400 ml-2">
                </div>

                <div class="flex items-center gap-3">
                    <div class="relative" x-data="{ userOpen: false }">
                        @auth
                            <button @click="userOpen = !userOpen" @click.away="userOpen = false"
                                class="flex items-center gap-1 text-gray-500 hover:text-pink-500 hover:bg-pink-50 p-2 rounded-full transition focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="userOpen ? 'rotate-180' : ''"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="userOpen" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="absolute right-0 mt-3 w-48 bg-white border border-pink-100 rounded-2xl shadow-xl z-50 py-2 overflow-hidden"
                                style="display: none;">

                                <div class="px-4 py-2 border-b border-gray-50 bg-pink-50/30">
                                    <p class="text-[10px] font-bold text-pink-400 uppercase tracking-wider">Akun Saya</p>
                                    <p class="text-sm font-bold text-gray-700 truncate">{{ Auth::user()->name }}</p>
                                </div>

                                {{-- Perbaikan Logika Disini --}}
                                {{-- Gunakan hasRole jika Anda menggunakan Spatie Permission sesuai di LoginResponse --}}
                                @if (Auth::user()->hasRole('admin'))
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 hover:bg-pink-50 hover:text-pink-500 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        Dashboard Admin
                                    </a>
                                @else
                                    <a href="{{ route('user.dashboard') }}"
                                        class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 hover:bg-pink-50 hover:text-pink-500 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profil Saya
                                    </a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition border-t border-gray-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-500 hover:text-pink-500 hover:bg-pink-50 p-2 rounded-full transition flex items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </a>
                        @endauth
                    </div>

                    <a href="{{ route('cart.index') }}"
                        class="relative text-gray-500 hover:text-pink-500 hover:bg-pink-50 p-2 rounded-full transition group">
                        <svg class="w-6 h-6 group-hover:scale-110 transition" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        @php
                            $cartCount = session('cart') ? collect(session('cart'))->sum('qty') : 0;
                        @endphp
                        @if ($cartCount > 0)
                            <span
                                class="absolute top-0 right-0 bg-yellow-400 text-pink-700 text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center shadow-sm border border-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <button class="lg:hidden text-gray-600 hover:text-pink-600 focus:outline-none"
                        @click="mobileMenu = !mobileMenu">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="!mobileMenu">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="mobileMenu" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        class="lg:hidden bg-white border-t border-pink-100 shadow-inner" style="display: none;">
        <div class="px-4 py-4 space-y-2">
            <a href="{{ route('home') }}"
                class="block text-base font-bold text-gray-700 hover:text-pink-500 hover:bg-pink-50 px-3 py-2 rounded-lg">Jajanan</a>
            <a href="{{ route('home') }}"
                class="block text-base font-bold text-gray-700 hover:text-pink-500 hover:bg-pink-50 px-3 py-2 rounded-lg">Minuman</a>
            <a href="{{ route('home') }}"
                class="block text-base font-bold text-gray-700 hover:text-pink-500 hover:bg-pink-50 px-3 py-2 rounded-lg">Roti
                & Kue</a>
            <div class="pt-2 border-t border-gray-100 mt-2">
                <a href="#" class="block text-sm text-gray-500 px-3 py-2">Bantuan Belanja</a>
            </div>
        </div>
    </div>
</header>
