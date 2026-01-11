@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-[#fafafa] overflow-hidden pb-20">
    {{-- Decorative Background --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-pink-100 rounded-full blur-3xl opacity-50 -mr-20 -mt-20"></div>
    <div class="absolute bottom-40 left-0 w-72 h-72 bg-yellow-100 rounded-full blur-3xl opacity-50 -ml-20"></div>

    <div class="max-w-7xl mx-auto px-4 py-12 relative z-10">
        {{-- HEADER --}}
        <div class="flex items-end gap-4 mb-10">
            <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-gray-800">
                Keranjang <span class="text-pink-500">Belanja</span>
            </h1>
            <span class="mb-2 px-4 py-1 bg-yellow-400 text-white text-xs font-black rounded-full shadow-sm">
                {{ collect($cart)->sum('qty') }} ITEMS ✨
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- LEFT COLUMN: CART ITEMS --}}
            <div class="lg:col-span-8 space-y-4">
                @forelse ($cart as $item)
                    <div class="bg-white rounded-[2.5rem] p-4 md:p-6 shadow-sm border-2 border-transparent hover:border-pink-100 transition-all group">
                        <div class="flex flex-col md:flex-row items-center gap-6">
                            
                            {{-- Product Image --}}
                            <div class="relative w-32 h-32 md:w-24 md:h-24 flex-shrink-0">
                                <div class="absolute inset-0 bg-yellow-100 rounded-[1.5rem] rotate-6 group-hover:rotate-12 transition-transform"></div>
                                <div class="relative w-full h-full bg-white border-2 border-gray-50 rounded-[1.5rem] overflow-hidden shadow-inner">
                                    @if (!empty($item['image']))
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['product_name'] }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-200 text-2xl">🍭</div>
                                    @endif
                                </div>
                            </div>

                            {{-- Product Info --}}
                            <div class="flex-grow text-center md:text-left">
                                <h3 class="font-black text-gray-800 uppercase tracking-tight text-lg leading-tight">
                                    {{ $item['product_name'] }}
                                </h3>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Var: {{ $item['variant_id'] }}</p>
                                <p class="text-pink-500 font-black mt-1">Rp {{ number_format($item['price']) }}</p>
                            </div>

                            {{-- Quantity Selector --}}
                            <div class="flex items-center bg-gray-50 p-1 rounded-2xl border-2 border-gray-100">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="variant_id" value="{{ $item['variant_id'] }}">
                                    <button name="qty" value="{{ $item['qty'] - 1 }}" class="w-10 h-10 flex items-center justify-center font-black text-gray-400 hover:text-pink-500 transition-colors text-xl">-</button>
                                    <span class="w-8 text-center font-black text-sm text-gray-700">{{ $item['qty'] }}</span>
                                    <button name="qty" value="{{ $item['qty'] + 1 }}" class="w-10 h-10 flex items-center justify-center font-black text-gray-400 hover:text-yellow-500 transition-colors text-xl">+</button>
                                </form>
                            </div>

                            {{-- Subtotal & Action --}}
                            <div class="text-right flex flex-col items-center md:items-end min-w-[120px]">
                                <p class="font-black text-gray-800 text-lg">Rp {{ number_format($item['price'] * $item['qty']) }}</p>
                                <form action="{{ route('cart.remove', $item['variant_id']) }}" method="POST" class="mt-1">
                                    @csrf @method('DELETE')
                                    <button class="text-[10px] font-black uppercase tracking-widest text-gray-300 hover:text-red-500 transition-colors underline decoration-2 underline-offset-4">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-[3rem] py-20 text-center shadow-sm border-4 border-dashed border-gray-100">
                        <div class="text-6xl mb-4">🛒</div>
                        <p class="font-black text-gray-400 uppercase tracking-widest">Keranjang masih kosong nih!</p>
                        <a href="{{ route('home') }}" class="mt-6 inline-block bg-gray-800 text-white px-10 py-4 rounded-full font-black text-xs uppercase tracking-[0.2em] hover:bg-pink-500 transition-all">Mulai Belanja ✨</a>
                    </div>
                @endforelse

                @if (count($cart) > 0)
                    <div class="pt-6">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-pink-500 transition-all group">
                            <span class="mr-2 group-hover:-translate-x-1 transition-transform">←</span> Terus Belanja Permen
                        </a>
                    </div>
                @endif
            </div>

            {{-- RIGHT COLUMN: SUMMARY --}}
            <div class="lg:col-span-4">
                <div class="bg-white rounded-[3rem] p-8 sticky top-6 shadow-2xl shadow-pink-100/50 border-2 border-pink-50">
                    <h2 class="font-black text-xl uppercase tracking-tighter text-gray-800 mb-8 flex items-center gap-2">
                        Checkout <span class="text-yellow-400">Total</span> 💸
                    </h2>

                    {{-- Alamat Pengiriman --}}
                    <div class="mb-10 group">
                        <label class="block text-[10px] font-black text-gray-400 mb-3 uppercase tracking-[0.2em] ml-2">Alamat Pengiriman</label>
                        <div class="relative">
                            <select id="addressSelector" class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-200 p-4 rounded-2xl text-sm font-bold text-gray-700 appearance-none outline-none transition-all">
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach ($addresses as $addr)
                                    <option value="{{ $addr->id }}">{{ $addr->name }} ({{ $addr->city }})</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-pink-400 text-xs">▼</div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <a href="{{ auth()->user()->hasRole('admin') ? route('admin.addresses.create') : route('user.addresses.create') }}" 
                               class="text-[10px] font-black text-pink-500 underline uppercase tracking-widest hover:text-yellow-500 transition-colors">
                                + Alamat Baru
                            </a>
                        </div>
                    </div>

                    {{-- Pricing Details --}}
                    <div class="space-y-4 mb-10">
                        <div class="flex justify-between text-sm font-bold text-gray-400 uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span class="text-gray-800">{{ collect($cart)->sum('qty') }} Items</span>
                        </div>
                        <div class="flex justify-between text-sm font-bold text-gray-400 uppercase tracking-widest">
                            <span>Ongkir</span>
                            <span class="text-xs italic text-pink-300">Free Candy ✨</span>
                        </div>
                        <div class="pt-6 border-t-4 border-gray-50 mt-6 flex justify-between items-end">
                            <span class="font-black text-xs uppercase tracking-[0.2em] text-gray-800">Total Harga</span>
                            <span class="text-3xl font-black text-gray-800 leading-none">
                                <span class="text-xs text-pink-500 block text-right mb-1">Rp</span>
                                {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['qty'])) }}
                            </span>
                        </div>
                    </div>

                    {{-- Checkout Button --}}
                    <button id="payButton" type="button"
                        class="w-full bg-gray-800 text-white py-6 rounded-[2rem] font-black text-sm uppercase tracking-[0.2em] shadow-xl hover:shadow-yellow-200 transition-all active:scale-95 disabled:opacity-30 flex items-center justify-center gap-2 group"
                        {{ empty($cart) ? 'disabled' : '' }}>
                        Bayar Sekarang <span class="group-hover:translate-x-1 transition-transform">✨</span>
                    </button>

                    <p class="text-[9px] text-center text-gray-400 mt-6 font-bold uppercase tracking-widest leading-relaxed">
                        Pajak sudah termasuk • 30 hari Garansi <br> butterfly & candy supermarket
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Script Midtrans Tetap Sama (Hanya update UI loading jika perlu) --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('services.midtrans.clientKey') }}"></script>
{{-- ... rest of your script ... --}}
@endsection