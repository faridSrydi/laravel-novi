@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-[#fafafa] overflow-hidden pb-20">
    {{-- Decorative Background (Sesuai style Keranjang) --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-pink-100 rounded-full blur-3xl opacity-50 -mr-20 -mt-20"></div>
    <div class="absolute bottom-40 left-0 w-72 h-72 bg-yellow-100 rounded-full blur-3xl opacity-50 -ml-20"></div>

    <div class="max-w-7xl mx-auto px-4 py-12 relative z-10">
        
        {{-- HEADER SECTION --}}
        <div class="flex items-end gap-4 mb-10">
            <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-gray-800 leading-none">
                Buku <span class="text-pink-500">Alamat</span>
            </h1>
            <span class="mb-2 px-4 py-1 bg-yellow-400 text-white text-xs font-black rounded-full shadow-sm">
                {{ count($addresses) }} LOKASI ✨
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- LEFT COLUMN: SIDEBAR --}}
            <div class="lg:col-span-4">
                <div class="bg-white rounded-[3rem] p-8 sticky top-6 shadow-2xl shadow-pink-100/50 border-2 border-pink-50">
                    <h2 class="font-black text-xl uppercase tracking-tighter text-gray-800 mb-6 flex items-center gap-2">
                        Kelola <span class="text-yellow-400">Tujuan</span> 🍭
                    </h2>

                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-relaxed mb-8">
                        Simpan berbagai alamat pengiriman untuk memudahkan checkout manismu!
                    </p>

                    {{-- Action Button --}}
                    <a href="{{ route('user.addresses.create') }}"
                        class="w-full bg-gray-800 text-white py-6 rounded-[2rem] font-black text-sm uppercase tracking-[0.2em] shadow-xl hover:shadow-yellow-200 transition-all active:scale-95 flex items-center justify-center gap-2 group mb-6">
                        Tambah Alamat <span class="group-hover:translate-x-1 transition-transform">✨</span>
                    </a>

                    <div class="pt-6 border-t-4 border-gray-50 mt-6">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-pink-500 transition-all group">
                            <span class="mr-2 group-hover:-translate-x-1 transition-transform">←</span> Kembali Belanja
                        </a>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: ADDRESS LIST --}}
            <div class="lg:col-span-8 space-y-4">
                @forelse($addresses as $address)
                    <div class="bg-white rounded-[2.5rem] p-6 md:p-8 shadow-sm border-2 border-transparent hover:border-pink-100 transition-all group relative overflow-hidden">
                        {{-- Decorative background number/ID --}}
                        <div class="absolute -right-4 -bottom-4 text-8xl font-black text-gray-50 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none uppercase">
                            {{ substr($address->city, 0, 3) }}
                        </div>

                        <div class="flex flex-col md:flex-row items-center gap-6 relative z-10">
                            
                            {{-- Address Icon --}}
                            <div class="relative w-20 h-20 flex-shrink-0">
                                <div class="absolute inset-0 bg-yellow-100 rounded-[1.5rem] rotate-6 group-hover:rotate-12 transition-transform"></div>
                                <div class="relative w-full h-full bg-white border-2 border-gray-50 rounded-[1.5rem] flex items-center justify-center text-3xl shadow-inner">
                                    📍
                                </div>
                            </div>

                            {{-- Address Info --}}
                            <div class="flex-grow text-center md:text-left">
                                <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                                    <h3 class="font-black text-gray-800 uppercase tracking-tight text-xl">
                                        {{ $address->name }}
                                    </h3>
                                    @if($loop->first)
                                        <span class="bg-pink-100 text-pink-500 text-[8px] font-black px-2 py-0.5 rounded-full uppercase tracking-widest">Utama</span>
                                    @endif
                                </div>
                                <p class="text-pink-500 font-black text-sm mb-1">{{ $address->phone }}</p>
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest leading-relaxed">
                                    {{ $address->address }}, {{ $address->city }}, {{ $address->province }} ({{ $address->postal_code }})
                                </p>
                            </div>

                            {{-- Actions (Mirip gaya tombol di keranjang) --}}
                            <div class="flex flex-row md:flex-col gap-2 min-w-[100px]">
                                <a href="{{ route('user.addresses.edit', $address->id) }}" 
                                   class="px-5 py-2 bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-600 rounded-xl hover:bg-pink-500 hover:text-white transition-all text-center">
                                    Edit
                                </a>
                                
                                <form action="{{ route('user.addresses.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Hapus alamat ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full px-5 py-2 text-[10px] font-black uppercase tracking-widest text-gray-300 hover:text-red-500 transition-colors underline decoration-2 underline-offset-4">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-[3rem] py-20 text-center shadow-sm border-4 border-dashed border-gray-100">
                        <div class="text-6xl mb-4">🍯</div>
                        <p class="font-black text-gray-400 uppercase tracking-widest">Belum ada alamat yang disimpan!</p>
                        <a href="{{ route('user.addresses.create') }}" class="mt-6 inline-block bg-gray-800 text-white px-10 py-4 rounded-full font-black text-xs uppercase tracking-[0.2em] hover:bg-pink-500 transition-all">Tanam Alamat Pertama ✨</a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

<style>
    /* Haluskan transisi scale */
    .active\:scale-95:active { transform: scale(0.95); }
</style>
@endsection