@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-8 md:py-12 font-sans">
        
        {{-- ================= BREADCRUMB (CUTE STYLE) ================= --}}
        <nav class="flex items-center text-sm font-medium text-gray-400 mb-8 bg-pink-50 w-fit px-4 py-2 rounded-full" aria-label="Breadcrumb">
            <a href="/" class="hover:text-pink-500 transition">Beranda</a>
            <svg class="w-3 h-3 mx-2 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('home', ['category' => $product->category->slug]) }}"
                class="hover:text-pink-500 transition">{{ ucwords($product->category->name) }}</a>
            <svg class="w-3 h-3 mx-2 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-pink-600 font-bold truncate max-w-[150px] md:max-w-xs">{{ $product->name }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-16">

            {{-- ================= LEFT: GALLERY SLIDER ================= --}}
            <div class="lg:w-1/2">
                <div class="sticky top-24">
                    <div class="relative group">
                        <div class="swiper productMainSwiper aspect-square bg-white rounded-3xl border-2 border-pink-100 overflow-hidden shadow-lg shadow-pink-50 mb-4">
                            <div class="swiper-wrapper">
                                @foreach ($product->images as $image)
                                    <div class="swiper-slide bg-white flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $image->image) }}"
                                            class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700" 
                                            alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next !text-pink-500 bg-white/90 w-12 h-12 rounded-full shadow-md !after:text-lg hover:bg-pink-50 transition"></div>
                            <div class="swiper-button-prev !text-pink-500 bg-white/90 w-12 h-12 rounded-full shadow-md !after:text-lg hover:bg-pink-50 transition"></div>
                        </div>
                        
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-yellow-400 text-pink-700 text-xs font-black px-3 py-1.5 rounded-full shadow-sm border border-white transform -rotate-3 inline-block">
                                ENAK BANGET! 😋
                            </span>
                        </div>
                    </div>

                    <div class="swiper productThumbSwiper px-1">
                        <div class="swiper-wrapper">
                            @foreach ($product->images as $image)
                                <div class="swiper-slide cursor-pointer rounded-xl overflow-hidden border-2 border-transparent transition duration-300 hover:border-pink-200">
                                    <img src="{{ asset('storage/' . $image->image) }}" class="aspect-square object-cover opacity-70 hover:opacity-100 transition"
                                        alt="Thumbnail">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= RIGHT: PRODUCT INFO ================= --}}
            <div class="lg:w-1/2">
                <div class="bg-white p-1 md:p-0">
                    <div class="mb-6 border-b border-dashed border-pink-200 pb-6">
                        <span class="inline-block py-1 px-3 rounded-full bg-pink-100 text-pink-500 text-xs font-bold uppercase tracking-wider mb-3">
                            {{ $product->category->name }}
                        </span>
                        <h1 class="text-3xl md:text-4xl font-black text-gray-800 leading-tight mb-2">
                            {{ $product->name }}
                        </h1>
                        
                        <div class="flex items-center gap-2 mt-4">
                            <p class="text-sm text-gray-400 line-through">Rp {{ number_format($product->variants->min('price') * 1.1, 0, ',', '.') }}</p>
                            <h2 id="display_price" class="text-4xl font-black text-pink-500 tracking-tight">
                                Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>

                    <p class="text-gray-600 leading-relaxed mb-8 bg-gray-50 p-4 rounded-2xl border border-gray-100 text-sm">
                        {{ $product->description }}
                    </p>

                    {{-- FORM ADD TO CART --}}
                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="product_name" value="{{ $product->name }}">
                        <input type="hidden" id="selected_price" name="price"
                            value="{{ $product->variants->min('price') }}">

                        {{-- VARIANT SELECTOR --}}
                        <div>
                            <div class="flex justify-between items-center mb-3">
                                <label class="text-sm font-bold text-gray-800">Pilih Varian Rasa/Ukuran:</label>
                                <span class="text-xs text-pink-400 font-medium">*Wajib dipilih ya</span>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach ($product->variants as $variant)
                                    <label class="relative cursor-pointer {{ $variant->stock == 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                        <input type="radio" name="variant_id" value="{{ $variant->id }}"
                                            data-price="{{ $variant->price }}" onchange="updatePrice(this)"
                                            class="peer sr-only" {{ $variant->stock == 0 ? 'disabled' : 'required' }}>

                                        <div class="bg-white border-2 border-gray-200 rounded-xl py-3 px-2 text-center transition-all duration-200 
                                            peer-checked:border-pink-500 peer-checked:bg-pink-50 peer-checked:text-pink-700 peer-checked:shadow-sm
                                            hover:border-pink-300 group">
                                            
                                            <p class="text-sm font-bold capitalize">
                                                {{ $variant->color ?? '' }} {{ $variant->size }}
                                            </p>
                                            
                                            @if($variant->stock > 0)
                                                <p class="text-[10px] text-gray-400 mt-1 peer-checked:text-pink-400">
                                                    Stok: {{ $variant->stock }}
                                                </p>
                                            @else
                                                 <p class="text-[10px] text-red-400 mt-1 font-bold">
                                                    Habis :(
                                                </p>
                                            @endif
                                            
                                            <div class="absolute top-2 right-2 hidden peer-checked:block text-pink-500">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- ACTION AREA --}}
                        <div class="bg-pink-50 p-6 rounded-3xl border border-pink-100 flex flex-col md:flex-row items-center gap-6">
                            
                            <div class="w-full md:w-auto">
                                <label class="text-xs font-bold text-gray-500 mb-2 block text-center md:text-left">Jumlah</label>
                                <div class="flex items-center justify-center bg-white rounded-full border border-pink-200 shadow-sm w-32 mx-auto md:mx-0">
                                    <button type="button" onclick="this.nextElementSibling.stepDown()"
                                        class="w-10 h-10 flex items-center justify-center text-pink-500 hover:bg-pink-100 rounded-full transition text-lg font-bold pb-1">-</button>
                                    <input type="number" name="qty" value="1" min="1"
                                        class="w-12 text-center border-none focus:ring-0 font-black text-gray-700 text-lg p-0 bg-transparent">
                                    <button type="button" onclick="this.previousElementSibling.stepUp()"
                                        class="w-10 h-10 flex items-center justify-center text-pink-500 hover:bg-pink-100 rounded-full transition text-lg font-bold pb-1">+</button>
                                </div>
                            </div>

                            <div class="w-full flex-1">
                                <label class="hidden md:block text-xs font-bold text-transparent mb-2">Action</label>
                                <button type="submit"
                                    class="w-full h-12 md:h-14 bg-pink-500 hover:bg-pink-600 text-white rounded-full font-bold text-base md:text-lg shadow-lg shadow-pink-200 transform hover:scale-[1.02] transition flex items-center justify-center gap-2 disabled:bg-gray-300 disabled:shadow-none disabled:cursor-not-allowed"
                                    {{ $product->variants->sum('stock') == 0 ? 'disabled' : '' }}>
                                    
                                    @if($product->variants->sum('stock') == 0)
                                        <span>Yah, Stok Habis 😭</span>
                                    @else
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                        <span>Masukin Keranjang</span>
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- ADDITIONAL INFO --}}
                    <div class="mt-8 flex flex-col gap-3">
                        <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                            <div class="bg-blue-100 p-2 rounded-full text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-sm font-medium text-gray-600">Produk 100% Original & Halal</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                            <div class="bg-green-100 p-2 rounded-full text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                            </div>
                            <span class="text-sm font-medium text-gray-600">Pengiriman Instant Tersedia</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Initialize Thumbnails
        var thumbSwiper = new Swiper(".productThumbSwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
            breakpoints: {
                640: { slidesPerView: 5 },
            }
        });

        // Initialize Main Slider
        var mainSwiper = new Swiper(".productMainSwiper", {
            spaceBetween: 10,
            effect: 'fade', // Efek fade lebih halus
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: thumbSwiper,
            },
        });

        function updatePrice(element) {
            const price = element.getAttribute('data-price');
            // Update hidden input
            document.getElementById('selected_price').value = price;
            // Update display price with smooth animation effect (simple version)
            const display = document.getElementById('display_price');
            display.style.opacity = '0.5';
            setTimeout(() => {
                display.innerText = 'Rp ' + Number(price).toLocaleString('id-ID');
                display.style.opacity = '1';
            }, 150);
        }
    </script>

    <style>
        /* Styling for active thumbnail - Pink Border */
        .productThumbSwiper .swiper-slide-thumb-active {
            opacity: 1;
            border-color: #ec4899; /* pink-500 */
        }
        
        .productThumbSwiper .swiper-slide-thumb-active img {
            opacity: 1;
        }

        /* Remove spin buttons from number input */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection