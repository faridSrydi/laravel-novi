@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-8 font-sans">

        {{-- ================= HERO SLIDER (CUTE MINIMART STYLE) ================= --}}
        <div class="rounded-3xl overflow-hidden shadow-lg shadow-pink-100 mb-12 border border-pink-100">
            <div class="swiper heroSwiper group relative">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="relative aspect-[16/8] md:aspect-[21/8] bg-pink-50">
                            <img src="{{ asset('slider/slider1.jpg') }}"
                                class="w-full h-full object-cover opacity-90" alt="Promo Jajanan">
                            
                            <div class="absolute inset-0 bg-gradient-to-r from-pink-100/90 via-white/40 to-transparent flex items-center p-8 md:p-16">
                                <div class="max-w-md space-y-4">
                                    <span class="inline-block bg-yellow-400 text-pink-700 text-xs font-black px-3 py-1 rounded-full shadow-sm transform -rotate-2">
                                        RESTOCK BARU LHO! 🍿
                                    </span>
                                    <h2 class="text-3xl md:text-5xl font-black text-gray-800 leading-tight tracking-tight">
                                        Nyemil Enak <br><span class="text-pink-500">Gak Pake Mahal</span>
                                    </h2>
                                    <p class="text-gray-600 font-medium hidden md:block">
                                        Stok keripik, cokelat, dan susu favoritmu sekarang juga.
                                    </p>
                                    <a href="#" class="inline-block bg-pink-500 text-white text-sm font-bold px-8 py-3 rounded-full hover:bg-pink-600 hover:scale-105 transition shadow-md shadow-pink-200">
                                        Jajan Sekarang 🛒
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative aspect-[16/8] md:aspect-[21/8] bg-blue-50">
                            <img src="{{ asset('slider/slider2.jpg') }}"
                                class="w-full h-full object-cover opacity-90" alt="Promo Minuman">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-100/90 via-white/40 to-transparent flex items-center p-8 md:p-16">
                                <div class="max-w-md space-y-4">
                                    <span class="inline-block bg-blue-400 text-white text-xs font-black px-3 py-1 rounded-full shadow-sm transform rotate-1">
                                        SEGER BANGET 🧊
                                    </span>
                                    <h2 class="text-3xl md:text-5xl font-black text-gray-800 leading-tight tracking-tight">
                                        Minuman Segar <br><span class="text-blue-500">Pelepas Dahaga</span>
                                    </h2>
                                    <a href="#" class="inline-block bg-blue-500 text-white text-sm font-bold px-8 py-3 rounded-full hover:bg-blue-600 hover:scale-105 transition shadow-md shadow-blue-200">
                                        Lihat Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-button-next !text-pink-500 !w-10 !h-10 bg-white rounded-full shadow-md hover:bg-pink-50 transition after:!text-sm"></div>
                <div class="swiper-button-prev !text-pink-500 !w-10 !h-10 bg-white rounded-full shadow-md hover:bg-pink-50 transition after:!text-sm"></div>
                
                <div class="swiper-pagination !bottom-4"></div>
            </div>
        </div>


        {{-- ================= TITLE & FILTER ================= --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-black text-gray-800 flex items-center gap-2">
                    Mau Jajan Apa Hari Ini? <span class="text-2xl">😋</span>
                </h1>
                <p class="text-gray-500 text-sm mt-1">Pilih kategori favoritmu di bawah ini ya!</p>
            </div>

            <form method="GET" class="w-full md:w-auto flex items-center gap-3">
                <div class="relative w-full md:w-64 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </div>
                    <select name="category" onchange="this.form.submit()"
                        class="w-full bg-white border-2 border-pink-100 text-gray-700 text-sm font-bold rounded-full py-2.5 pl-10 pr-10 focus:outline-none focus:border-pink-400 focus:ring-4 focus:ring-pink-50 cursor-pointer hover:border-pink-300 transition appearance-none">
                        <option value="">Semua Jajanan</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}"
                                {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ ucwords($category->name) }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-pink-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </form>
        </div>

        {{-- ================= PRODUCT GRID (MINIMART STYLE) ================= --}}
        @if ($products->count())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach ($products as $product)
                    <div class="group bg-white rounded-2xl border border-pink-50 shadow-sm hover:shadow-lg hover:border-pink-200 transition duration-300 relative flex flex-col h-full overflow-hidden">
                        
                        <a href="{{ route('product.show', $product->slug) }}" class="block relative">
                            <div class="aspect-square bg-gray-50 overflow-hidden relative m-2 rounded-xl">
                                <img src="{{ asset('storage/' . ($product->images->first()->image ?? '')) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-500 ease-in-out">

                                {{-- Badges --}}
                                @if ($loop->first)
                                    <span class="absolute top-2 left-2 bg-yellow-400 text-pink-700 text-[10px] font-black px-2.5 py-1 rounded-full shadow-sm">
                                        ✨ BARU
                                    </span>
                                @endif
                            </div>
                        </a>

                        <div class="p-4 pt-1 flex flex-col flex-grow">
                            <div class="mb-1">
                                <span class="text-[10px] font-bold text-pink-400 bg-pink-50 px-2 py-0.5 rounded-full uppercase tracking-wide">
                                    {{ $product->category->name }}
                                </span>
                            </div>

                            <a href="{{ route('product.show', $product->slug) }}" class="block flex-grow">
                                <h3 class="text-sm md:text-base font-bold text-gray-800 line-clamp-2 leading-snug mb-2 group-hover:text-pink-500 transition">
                                    {{ $product->name }}
                                </h3>
                            </a>

                            <div class="flex items-end justify-between mt-auto pt-3 border-t border-dashed border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-400 line-through">Rp {{ number_format($product->variants->min('price') * 1.2, 0, ',', '.') }}</p>
                                    <p class="text-base md:text-lg font-black text-pink-600">
                                        Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                                    </p>
                                </div>
                                
                                <button class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center hover:bg-pink-500 hover:text-white transition shadow-sm hover:shadow-md transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-16 flex justify-center">
                <div class="bg-pink-50 px-6 py-3 rounded-full">
                     {{ $products->withQueryString()->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-24 bg-pink-50 rounded-3xl border-2 border-dashed border-pink-200">
                <div class="text-6xl mb-4">🍪</div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Yah, Jajanannya Kosong</h3>
                <p class="text-gray-500 text-sm">Coba cari kategori lain atau balik lagi nanti ya!</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            effect: 'fade', // Efek fade lebih halus untuk banner besar
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

    <style>
        /* Custom Pagination Style Cute */
        .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background: #fbcfe8; /* pink-200 */
            opacity: 1;
            transition: all 0.3s;
        }

        .swiper-pagination-bullet-active {
            background: #ec4899; /* pink-500 */
            width: 25px;
            border-radius: 10px;
        }

        /* Override Laravel Pagination agar pas dengan tema */
        nav[role="navigation"] svg {
            width: 20px;
            color: #ec4899;
        }
        
        /* Hilangkan focus ring default */
        *:focus {
            outline: none !important;
        }
    </style>
@endsection
