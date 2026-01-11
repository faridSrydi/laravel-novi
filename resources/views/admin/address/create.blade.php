@extends('layouts.app')

@section('content')
<div class="relative min-h-screen overflow-hidden bg-[#fafafa]">
    {{-- Decorative Candy Elements --}}
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-yellow-100 rounded-full blur-3xl opacity-50"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-pink-100 rounded-full blur-3xl opacity-40"></div>
    <div class="absolute top-20 left-10 text-4xl opacity-20 butterfly-float pointer-events-none">🦋</div>
    <div class="absolute bottom-20 right-20 text-3xl opacity-10 butterfly-float pointer-events-none" style="animation-delay: 2s">🦋</div>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- KOLOM KIRI: JUDUL & INFO --}}
            <div class="lg:col-span-4">
                <div class="lg:sticky lg:top-24">
                    <div class="inline-block px-3 py-1 bg-pink-500 text-white font-mono text-[10px] rounded-lg tracking-[0.2em] mb-6 uppercase">
                        New Entry // Mode
                    </div>

                    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter leading-[0.9] text-gray-800 mb-6">
                        Tambah <br><span class="text-yellow-500">Alamat</span> ✨
                    </h1>
                    
                    <p class="text-gray-500 font-medium leading-relaxed mb-8 pr-10">
                        Tambahkan titik pengiriman baru untuk mempermudah proses logistik dan distribusi pesanan pelanggan.
                    </p>
                    
                    <div class="space-y-4">
                        <a href="{{ route('admin.addresses.index') }}" 
                           class="inline-flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-pink-500 transition-all group">
                            <span class="mr-2 group-hover:-translate-x-1 transition-transform">←</span> Back to Registry
                        </a>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: FORM INPUT --}}
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[3rem] shadow-2xl shadow-yellow-100/30 border-4 border-yellow-50 p-8 md:p-12">
                    <form action="{{ route('admin.addresses.store') }}" method="POST">
                        @csrf
            
                        <div class="space-y-12">
                            
                            {{-- SECTION 01: CONTACT PERSON --}}
                            <div class="relative">
                                <div class="flex items-center gap-4 mb-8">
                                    <span class="w-10 h-10 rounded-2xl bg-gray-800 text-white flex items-center justify-center font-black">01</span>
                                    <h3 class="font-black text-sm uppercase tracking-widest text-gray-800">Identitas Penerima</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="group space-y-2">
                                        <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 group-focus-within:text-pink-500 ml-4 transition-colors">
                                            Nama / Label Alamat <span class="text-pink-500">*</span>
                                        </label>
                                        <input type="text" name="name" value="{{ old('name') }}" 
                                            class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-200 focus:bg-white p-4 rounded-[1.5rem] text-sm font-bold text-gray-700 transition-all outline-none" 
                                            placeholder="CONTOH: KANTOR PUSAT" required>
                                    </div>
            
                                    <div class="group space-y-2">
                                        <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 group-focus-within:text-pink-500 ml-4 transition-colors">
                                            Nomor Telepon Aktif <span class="text-pink-500">*</span>
                                        </label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" 
                                            class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-200 focus:bg-white p-4 rounded-[1.5rem] text-sm font-bold text-gray-700 transition-all outline-none" 
                                            placeholder="0812XXXXXXXX" required>
                                    </div>
                                </div>
                            </div>
            
                            {{-- SECTION 02: LOCATION DETAILS --}}
                            <div>
                                <div class="flex items-center gap-4 mb-8">
                                    <span class="w-10 h-10 rounded-2xl bg-yellow-400 text-white flex items-center justify-center font-black">02</span>
                                    <h3 class="font-black text-sm uppercase tracking-widest text-gray-800">Detail Lokasi</h3>
                                </div>
                                
                                <div class="space-y-8">
                                    <div class="group space-y-2">
                                        <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 group-focus-within:text-yellow-500 ml-4 transition-colors">
                                            Alamat Lengkap <span class="text-yellow-500">*</span>
                                        </label>
                                        <textarea name="address" rows="3" 
                                            class="w-full bg-gray-50 border-2 border-transparent focus:border-yellow-200 focus:bg-white p-5 rounded-[2rem] text-sm font-bold text-gray-700 transition-all outline-none" 
                                            placeholder="Tuliskan nama jalan, blok, nomor rumah, RT/RW..." required>{{ old('address') }}</textarea>
                                    </div>
            
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="group space-y-2">
                                            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 group-focus-within:text-yellow-500 ml-4 transition-colors">Kota</label>
                                            <input type="text" name="city" value="{{ old('city') }}" 
                                                class="w-full bg-gray-50 border-2 border-transparent focus:border-yellow-100 focus:bg-white p-4 rounded-[1.5rem] text-sm font-bold text-gray-700 transition-all outline-none" required>
                                        </div>
                
                                        <div class="group space-y-2">
                                            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 group-focus-within:text-yellow-500 ml-4 transition-colors">Provinsi</label>
                                            <input type="text" name="province" value="{{ old('province') }}" 
                                                class="w-full bg-gray-50 border-2 border-transparent focus:border-yellow-100 focus:bg-white p-4 rounded-[1.5rem] text-sm font-bold text-gray-700 transition-all outline-none" required>
                                        </div>
                
                                        <div class="group space-y-2">
                                            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 group-focus-within:text-yellow-500 ml-4 transition-colors">Kode Pos</label>
                                            <input type="text" name="postal_code" value="{{ old('postal_code') }}" 
                                                class="w-full bg-gray-50 border-2 border-transparent focus:border-yellow-100 focus:bg-white p-4 rounded-[1.5rem] text-sm font-bold text-gray-700 transition-all outline-none" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        {{-- SUBMIT BUTTON --}}
                        <div class="mt-12 pt-8 border-t-2 border-gray-50 flex justify-end">
                            <button type="submit" 
                                    class="group relative w-full md:w-auto overflow-hidden bg-gray-800 text-white px-16 py-5 rounded-[2rem] text-xs font-black uppercase tracking-[0.2em] shadow-xl hover:shadow-yellow-200 transition-all active:scale-95">
                                <span class="relative z-10">Simpan Alamat Baru ✨</span>
                                <div class="absolute inset-0 bg-yellow-400 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0); }
        50% { transform: translateY(-20px) rotate(10deg); }
    }
    .butterfly-float { animation: float 6s ease-in-out infinite; }
</style>
@endsection