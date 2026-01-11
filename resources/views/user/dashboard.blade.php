@extends('layouts.app')

@section('title', 'Akun Saya')

@section('content')
<div class="relative min-h-screen bg-[#fafafa] overflow-hidden pb-20">
    {{-- Decorative Background --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-pink-100 rounded-full blur-3xl opacity-40 -mr-20 -mt-20 butterfly-float"></div>
    <div class="absolute bottom-40 left-0 w-64 h-64 bg-yellow-100 rounded-full blur-3xl opacity-30 -ml-32"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        <div class="flex flex-col md:flex-row gap-10">
            
            {{-- SIDEBAR NAV --}}
            <aside class="w-full md:w-72 space-y-3">
                <div class="pb-4 mb-4 ml-4">
                    <span class="px-3 py-1 bg-pink-500 text-white text-[9px] font-black rounded-full uppercase tracking-widest shadow-lg shadow-pink-100">Garden Menu</span>
                    <h2 class="text-xl font-black uppercase tracking-tighter text-gray-800 mt-2">Akun <span class="text-pink-500">Saya</span></h2>
                </div>
                
                <nav class="space-y-2">
                    <a href="#" class="flex items-center px-6 py-4 text-[11px] font-black uppercase tracking-[0.2em] bg-gray-800 text-white rounded-[2rem] shadow-xl transition-all scale-105">
                        <span class="mr-3 text-lg">🏠</span> Dashboard
                    </a>
                    <a href="#" class="flex items-center px-6 py-4 text-[11px] font-black uppercase tracking-[0.2em] text-gray-500 hover:text-pink-500 hover:bg-pink-50 rounded-[2rem] transition-all group">
                        <span class="mr-3 text-lg group-hover:scale-125 transition-transform">📦</span> Pesanan Saya
                    </a>
                    <a href="{{ route('user.addresses.index') }}" class="flex items-center px-6 py-4 text-[11px] font-black uppercase tracking-[0.2em] text-gray-500 hover:text-pink-500 hover:bg-pink-50 rounded-[2rem] transition-all group">
                        <span class="mr-3 text-lg group-hover:scale-125 transition-transform">📍</span> Buku Alamat
                    </a>
                    
                    <div class="pt-10">
                        <a href="#" class="flex items-center px-6 py-4 text-[11px] font-black uppercase tracking-[0.2em] text-red-400 hover:bg-red-50 rounded-[2rem] transition-all group">
                            <span class="mr-3 text-lg group-hover:rotate-12 transition-transform">🚪</span> Keluar
                        </a>
                    </div>
                </nav>
            </aside>

            {{-- MAIN CONTENT --}}
            <div class="flex-1 space-y-8">
                
                {{-- WELCOME BANNER --}}
                <section class="bg-white p-10 rounded-[3rem] shadow-2xl shadow-pink-100/50 relative overflow-hidden border-4 border-pink-50">
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-2xl butterfly-float inline-block">🦋</span>
                            <p class="text-[10px] font-black text-pink-300 uppercase tracking-[0.4em]">Welcome Back!</p>
                        </div>
                        <h1 class="text-3xl md:text-5xl font-black uppercase tracking-tighter text-gray-800 leading-none">
                            Halo, <span class="text-pink-500">{{ auth()->user()->name ?? 'Candy Lovers' }}!</span>
                        </h1>
                        <p class="text-sm font-bold text-gray-400 mt-4 max-w-md">Senang melihat Anda kembali di kebun permen kami. Cek status kebahagiaanmu di sini!</p>
                    </div>
                    {{-- Decorative Circle --}}
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-yellow-400 rounded-full opacity-10"></div>
                </section>

                {{-- STATS GRID --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-8 rounded-[2.5rem] border-2 border-pink-50 hover:shadow-xl hover:shadow-pink-100/50 transition-all group">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-pink-300 group-hover:text-pink-500 transition-colors">Total Pesanan</p>
                        <div class="flex items-baseline gap-2 mt-2">
                            <p class="text-4xl font-black text-gray-800 tracking-tighter">12</p>
                            <span class="text-sm font-bold text-gray-300 uppercase">Items</span>
                        </div>
                    </div>
                    <div class="bg-yellow-400 p-8 rounded-[2.5rem] shadow-lg shadow-yellow-100 transition-all hover:scale-105">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-yellow-800">Menunggu Bayar</p>
                        <div class="flex items-baseline gap-2 mt-2">
                            <p class="text-4xl font-black text-white tracking-tighter">1</p>
                            <span class="text-sm font-bold text-yellow-800 uppercase italic">Urgent!</span>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-[2.5rem] border-2 border-pink-50 hover:shadow-xl hover:shadow-pink-100/50 transition-all group">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-pink-300 group-hover:text-pink-500 transition-colors">Candy Points</p>
                        <div class="flex items-baseline gap-2 mt-2">
                            <p class="text-4xl font-black text-gray-800 tracking-tighter">2.500</p>
                            <span class="text-lg">🍭</span>
                        </div>
                    </div>
                </div>

                {{-- RECENT ORDERS TABLE --}}
                <section class="bg-white rounded-[3rem] overflow-hidden border-4 border-pink-50 shadow-xl shadow-pink-100/20">
                    <div class="p-8 border-b-2 border-dotted border-pink-50 flex justify-between items-center bg-pink-50/30">
                        <h3 class="text-[11px] font-black uppercase tracking-[0.3em] text-gray-800">Pesanan Terakhir ✨</h3>
                        <a href="#" class="text-[10px] font-black uppercase tracking-widest text-pink-500 hover:text-gray-800 transition-colors underline decoration-2 underline-offset-4">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto p-4">
                        <table class="w-full text-left border-separate border-spacing-y-3">
                            <thead>
                                <tr class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                                    <th class="px-6 py-2">ID Order</th>
                                    <th class="px-6 py-2">Tanggal</th>
                                    <th class="px-6 py-2">Status</th>
                                    <th class="px-6 py-2 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-bold">
                                <tr class="bg-gray-50/50 hover:bg-pink-50/50 transition-colors rounded-2xl group">
                                    <td class="px-6 py-5 rounded-l-[1.5rem] text-gray-800 font-black">#INV-99021</td>
                                    <td class="px-6 py-5 text-gray-400">24 Des 2025</td>
                                    <td class="px-6 py-5">
                                        <span class="px-4 py-1.5 bg-green-400 text-white text-[9px] font-black uppercase tracking-widest rounded-full shadow-md">Dikirim 🚚</span>
                                    </td>
                                    <td class="px-6 py-5 text-right rounded-r-[1.5rem] font-black text-gray-800">Rp 599.000</td>
                                </tr>
                                <tr class="bg-gray-50/50 hover:bg-pink-50/50 transition-colors rounded-2xl group">
                                    <td class="px-6 py-5 rounded-l-[1.5rem] text-gray-800 font-black">#INV-98812</td>
                                    <td class="px-6 py-5 text-gray-400">12 Des 2025</td>
                                    <td class="px-6 py-5">
                                        <span class="px-4 py-1.5 bg-gray-300 text-white text-[9px] font-black uppercase tracking-widest rounded-full">Selesai ✅</span>
                                    </td>
                                    <td class="px-6 py-5 text-right rounded-r-[1.5rem] font-black text-gray-800">Rp 1.250.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(5deg); }
    }
    .butterfly-float { animation: float 4s ease-in-out infinite; }
</style>
@endsection