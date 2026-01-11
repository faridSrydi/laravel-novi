@extends('layouts.app')

@section('content')
    {{-- CONTAINER: Decorative background elements --}}
    <div class="relative min-h-screen overflow-hidden">
        {{-- Floating Butterflies --}}
        <div class="absolute top-20 right-10 text-5xl opacity-10 butterfly-float pointer-events-none">🦋</div>
        <div class="absolute bottom-40 left-10 text-4xl opacity-10 butterfly-float pointer-events-none" style="animation-delay: 2s">🦋</div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 py-12 relative z-10">

            {{-- GRID LAYOUT --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- KOLOM KIRI: INFO & ACTION --}}
                <div class="lg:col-span-3">
                    <div class="lg:sticky lg:top-24 space-y-6">
                        <div class="border-l-4 border-pink-400 pl-4">
                            <span class="font-mono text-[10px] text-pink-300 block mb-1 uppercase tracking-[0.2em]">
                                Registry // Address
                            </span>
                            <h1 class="text-4xl font-black uppercase tracking-tighter leading-[0.85] text-gray-800">
                                Lokasi <br><span class="text-pink-500">Kirim</span> ✨
                            </h1>
                        </div>

                        {{-- Stats Badge --}}
                        <div class="bg-pink-50 rounded-2xl p-4 border border-pink-100 shadow-sm shadow-pink-100/50">
                            <p class="font-mono text-[9px] uppercase text-pink-400 font-bold mb-1">Total Records</p>
                            <div class="flex items-end gap-2">
                                <span class="text-3xl font-black text-gray-800 leading-none">{{ count($addresses) }}</span>
                                <span class="text-[10px] text-gray-400 font-bold uppercase mb-1">Entries</span>
                            </div>
                        </div>

                        {{-- Primary Action --}}
                        <a href="{{ route('admin.addresses.create') }}"
                            class="group relative block w-full bg-yellow-400 text-white p-5 rounded-2xl text-xs font-black uppercase tracking-widest text-center shadow-lg shadow-yellow-100 hover:bg-yellow-500 transition-all active:scale-95 overflow-hidden">
                            <span class="relative z-10">+ Tambah Alamat Baru</span>
                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                        </a>

                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <p class="text-[10px] text-gray-400 leading-relaxed font-medium italic">
                                🍬 Tip: Pastikan koordinat pengiriman sudah sesuai untuk menghindari retur paket.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: TABEL DATA --}}
                <div class="lg:col-span-9">

                    {{-- ALERT NOTIFICATION --}}
                    @if (session('success'))
                        <div class="mb-8 p-5 bg-white border-2 border-pink-100 rounded-[2rem] flex items-center justify-between shadow-xl shadow-pink-50 animate-fade-in">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center text-pink-500">✨</div>
                                <div>
                                    <span class="font-mono text-[9px] text-pink-300 block uppercase font-bold">System Success</span>
                                    <span class="text-sm font-black text-gray-700 uppercase tracking-tight">{{ session('success') }}</span>
                                </div>
                            </div>
                            <button onclick="this.parentElement.remove()" class="text-[10px] font-black text-gray-300 hover:text-pink-500 transition-colors">DISMISS</button>
                        </div>
                    @endif

                    {{-- TABLE CONTAINER --}}
                    <div class="bg-white rounded-[3rem] border-4 border-pink-50 shadow-2xl shadow-pink-100/20 overflow-hidden relative">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-800 text-white">
                                        <th class="p-6 text-[10px] font-black uppercase tracking-widest">Penerima</th>
                                        <th class="p-6 text-[10px] font-black uppercase tracking-widest">Kontak</th>
                                        <th class="p-6 text-[10px] font-black uppercase tracking-widest">Destinasi</th>
                                        <th class="p-6 text-[10px] font-black uppercase tracking-widest text-right">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-pink-50">
                                    @forelse($addresses as $address)
                                        <tr class="group hover:bg-pink-50/30 transition-all duration-300">
                                            {{-- Name --}}
                                            <td class="p-6 align-top">
                                                <div class="flex flex-col">
                                                    <span class="font-black text-sm uppercase text-gray-800 group-hover:text-pink-500 transition-colors">
                                                        {{ $address->name }}
                                                    </span>
                                                    <span class="font-mono text-[9px] text-gray-300 mt-1">
                                                        REF_#{{ str_pad($address->id, 5, '0', STR_PAD_LEFT) }}
                                                    </span>
                                                </div>
                                            </td>

                                            {{-- Phone --}}
                                            <td class="p-6 align-top">
                                                <div class="inline-flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full group-hover:bg-white transition-colors">
                                                    <span class="text-[10px]">📞</span>
                                                    <span class="font-mono text-xs font-bold text-gray-600">{{ $address->phone }}</span>
                                                </div>
                                            </td>

                                            {{-- Address --}}
                                            <td class="p-6 align-top">
                                                <p class="text-xs font-bold text-gray-700 leading-relaxed uppercase mb-2 italic">
                                                    "{{ $address->address }}"
                                                </p>
                                                <div class="flex flex-wrap gap-2">
                                                    <span class="bg-pink-100 text-pink-500 text-[9px] font-black px-2 py-0.5 rounded-md uppercase tracking-tighter">
                                                        {{ $address->city }}
                                                    </span>
                                                    <span class="bg-yellow-100 text-yellow-600 text-[9px] font-black px-2 py-0.5 rounded-md uppercase tracking-tighter">
                                                        {{ $address->postal_code }}
                                                    </span>
                                                </div>
                                            </td>

                                            {{-- Actions --}}
                                            <td class="p-6 align-top text-right">
                                                <div class="flex flex-col md:flex-row justify-end items-center gap-4">
                                                    <a href="{{ route('admin.addresses.edit', $address->id) }}"
                                                        class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-yellow-500 transition-colors">
                                                        Modify
                                                    </a>

                                                    <form action="{{ route('admin.addresses.destroy', $address->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Hapus alamat ini secara permanen?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="w-8 h-8 flex items-center justify-center bg-gray-50 text-gray-300 hover:bg-red-500 hover:text-white rounded-xl transition-all shadow-sm">
                                                            ✕
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="p-20 text-center">
                                                <div class="flex flex-col items-center justify-center space-y-4">
                                                    <div class="text-6xl grayscale opacity-20">🍯</div>
                                                    <h3 class="text-xl font-black uppercase text-gray-300 tracking-tighter italic">Belum ada alamat terdaftar</h3>
                                                    <p class="font-mono text-[10px] text-gray-400 uppercase tracking-widest">Status: Empty_Data_Set</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Footer Info --}}
                    <div class="mt-8 flex justify-between items-center px-6">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            <span class="font-mono text-[9px] text-gray-400 uppercase tracking-widest">System Operational</span>
                        </div>
                        <span class="font-mono text-[9px] text-gray-400 uppercase">Timestamp: {{ now()->format('H:i:s T') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .butterfly-float { animation: float 6s ease-in-out infinite; }
        
        @keyframes fade-in {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
    </style>
@endsection