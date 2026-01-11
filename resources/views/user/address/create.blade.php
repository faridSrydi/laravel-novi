@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-[#fafafa] overflow-hidden pb-20">
    {{-- Decorative Background (Sesuai dengan style Keranjang) --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-pink-100 rounded-full blur-3xl opacity-50 -mr-20 -mt-20"></div>
    <div class="absolute bottom-40 left-0 w-72 h-72 bg-yellow-100 rounded-full blur-3xl opacity-50 -ml-20"></div>

    <div class="max-w-7xl mx-auto px-4 py-12 relative z-10">
        
        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-end gap-4 mb-10">
            <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-gray-800 leading-tight">
                {{ isset($address) ? 'Edit' : 'Input' }} <span class="text-pink-500">Alamat</span>
            </h1>
            <span class="mb-2 px-4 py-1 bg-yellow-400 text-white text-xs font-black rounded-full shadow-sm w-fit">
                {{ isset($address) ? 'UPDATE DATA' : 'BARU' }} ✨
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- LEFT COLUMN: INFO & GUIDE --}}
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border-2 border-pink-50 relative overflow-hidden group">
                    {{-- Decorative Icon Background --}}
                    <div class="absolute -right-4 -bottom-4 text-8xl opacity-5 group-hover:scale-110 transition-transform duration-500">📍</div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-2xl">🍭</span>
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Delivery Guide</p>
                        </div>
                        <p class="text-sm font-bold text-gray-500 leading-relaxed italic">
                            "Pastikan setiap detail alamat terisi dengan benar agar kiriman manismu sampai tanpa kendala!"
                        </p>
                    </div>
                </div>

                {{-- Back Action --}}
                <div class="px-4">
                    <a href="{{ route('user.addresses.index') }}" 
                       class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-pink-500 transition-all group">
                        <span class="mr-2 group-hover:-translate-x-1 transition-transform">←</span> Kembali ke Daftar
                    </a>
                </div>
            </div>

            {{-- RIGHT COLUMN: FORM CARD --}}
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-2xl shadow-pink-100/30 border-2 border-gray-50">
                    
                    <form action="{{ isset($address) ? route('user.addresses.update', $address->id) : route('user.addresses.store') }}" 
                          method="POST">
                        @csrf
                        @if (isset($address))
                            @method('PUT')
                        @endif

                        <div class="space-y-8">
                            {{-- SECTION 1: PERSONAL --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-3 ml-2 tracking-widest group-focus-within:text-pink-500 transition-colors">
                                        Nama Penerima <span class="text-pink-500">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{ old('name', $address->name ?? '') }}"
                                        class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-200 focus:bg-white p-4 rounded-2xl text-sm font-bold text-gray-700 outline-none transition-all placeholder-gray-300"
                                        placeholder="Nama Lengkap" required>
                                </div>

                                <div class="group">
                                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-3 ml-2 tracking-widest group-focus-within:text-pink-500 transition-colors">
                                        No. Telepon <span class="text-pink-500">*</span>
                                    </label>
                                    <input type="text" name="phone" value="{{ old('phone', $address->phone ?? '') }}"
                                        class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-200 focus:bg-white p-4 rounded-2xl text-sm font-bold text-gray-700 outline-none transition-all placeholder-gray-300"
                                        placeholder="0812xxxx" required>
                                </div>
                            </div>

                            {{-- SECTION 2: FULL ADDRESS --}}
                            <div class="group">
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-3 ml-2 tracking-widest group-focus-within:text-pink-500 transition-colors">
                                    Alamat Lengkap <span class="text-pink-500">*</span>
                                </label>
                                <textarea name="address" rows="3"
                                    class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-200 focus:bg-white p-5 rounded-[2rem] text-sm font-bold text-gray-700 outline-none transition-all placeholder-gray-300 resize-none"
                                    placeholder="Jalan, No. Rumah, RT/RW, Patokan..." required>{{ old('address', $address->address ?? '') }}</textarea>
                            </div>

                            {{-- SECTION 3: AREA DETAILS --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="group">
                                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-3 ml-2 tracking-widest">
                                        Kota <span class="text-pink-500">*</span>
                                    </label>
                                    <input type="text" name="city" value="{{ old('city', $address->city ?? '') }}"
                                        class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-200 focus:bg-white p-4 rounded-2xl text-sm font-bold text-gray-700 outline-none transition-all" required>
                                </div>

                                <div class="group">
                                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-3 ml-2 tracking-widest">
                                        Provinsi <span class="text-pink-500">*</span>
                                    </label>
                                    <input type="text" name="province" value="{{ old('province', $address->province ?? '') }}"
                                        class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-200 focus:bg-white p-4 rounded-2xl text-sm font-bold text-gray-700 outline-none transition-all" required>
                                </div>

                                <div class="group">
                                    <label class="block text-[10px] font-black uppercase text-gray-400 mb-3 ml-2 tracking-widest">
                                        Kode Pos <span class="text-pink-500">*</span>
                                    </label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code ?? '') }}"
                                        class="w-full bg-gray-50 border-2 border-transparent focus:border-pink-200 focus:bg-white p-4 rounded-2xl text-sm font-bold text-gray-700 outline-none transition-all" required>
                                </div>
                            </div>

                            {{-- SUBMIT BUTTON --}}
                            <div class="pt-6 border-t-4 border-gray-50">
                                <button type="submit"
                                    class="w-full bg-gray-800 text-white py-6 rounded-[2rem] font-black text-sm uppercase tracking-[0.2em] shadow-xl hover:bg-pink-500 hover:shadow-pink-200 transition-all active:scale-95 flex items-center justify-center gap-3 group">
                                    {{ isset($address) ? 'Update Data Alamat' : 'Simpan Alamat Sekarang' }} 
                                    <span class="group-hover:rotate-12 transition-transform">✨</span>
                                </button>
                                
                                <p class="text-[9px] text-center text-gray-400 mt-6 font-bold uppercase tracking-widest leading-relaxed">
                                    Data Anda terenkripsi aman • Pastikan nomor HP aktif <br> butterfly & candy supermarket
                                </p>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection