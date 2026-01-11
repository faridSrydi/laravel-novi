@extends('layouts.app')

@section('content')
<div class="relative min-h-screen overflow-hidden bg-[#fafafa]">
    {{-- Decorative Background Elements --}}
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-pink-100 rounded-full blur-3xl opacity-50"></div>
    <div class="absolute top-1/2 -left-24 w-64 h-64 bg-yellow-100 rounded-full blur-3xl opacity-50"></div>
    <div class="absolute top-40 right-20 text-4xl opacity-20 butterfly-float pointer-events-none">🦋</div>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- KOLOM KIRI: JUDUL & INFO --}}
            <div class="lg:col-span-4">
                <div class="lg:sticky lg:top-24">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-gray-800 text-white font-mono text-[10px] rounded-lg tracking-tighter">
                            REF_ID: {{ $address->id }}
                        </span>
                        <div class="h-[2px] flex-grow bg-pink-100"></div>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter leading-[0.9] text-gray-800 mb-6">
                        Edit <br><span class="text-pink-500">Destination</span> ✨
                    </h1>
                    
                    <p class="text-gray-500 font-medium leading-relaxed mb-8 pr-10">
                        Pastikan setiap detail alamat sudah benar agar paket <span class="text-pink-400 italic">sweet treats</span> sampai ke tangan yang tepat.
                    </p>
                    
                    <a href="{{ route('admin.addresses.index') }}" 
                       class="inline-flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-pink-500 transition-all group">
                        <span class="mr-2 group-hover:-translate-x-1 transition-transform">←</span> Back to Registry
                    </a>
                </div>
            </div>

            {{-- KOLOM KANAN: FORM UPDATE --}}
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[3rem] shadow-2xl shadow-pink-100/30 border-4 border-pink-50 p-8 md:p-12">
                    <form action="{{ route('admin.addresses.update', $address->id) }}" method="POST">
                        @csrf
                        @method('PUT')
            
                        <div class="space-y-12">
                            
                            {{-- SECTION 01: CONTACT PERSON --}}
                            <div class="relative">
                                <div class="flex items-center gap-4 mb-8">
                                    <span class="w-10 h-10 rounded-2xl bg-pink-500 text-white flex items-center justify-center font-black">1</span>
                                    <h3 class="font-black text-sm uppercase tracking-widest text-gray-800">Informasi Penerima</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="block font-black text-[10px] uppercase tracking-widest text-pink-400 ml-4">
                                            Nama Lengkap / Label
                                        </label>
                                        <input type="text" name="name" value="{{ old('name', $address->name) }}" 
                                            class="w-full bg-pink-50/50 border-2 border-transparent focus:border-pink-200 focus:bg-white p-4 rounded-[1.5rem] text-sm font-bold text-gray-700 transition-all outline-none" 
                                            placeholder="Contoh: Rumah Utama" required>
                                    </div>
            
                                    <div class="space-y-2">
                                        <label class="block font-black text-[10px] uppercase tracking-widest text-pink-400 ml-4">
                                            Nomor WhatsApp/Telp
                                        </label>
                                        <input type="text" name="phone" value="{{ old('phone', $address->phone) }}" 
                                            class="w-full bg-pink-50/50 border-2 border-transparent focus:border-pink-200 focus:bg-white p-4 rounded-[1.5rem] text-sm font-bold text-gray-700 transition-all outline-none" 
                                            placeholder="0812..." required>
                                    </div>
                                </div>
                            </div>
            
                            {{-- SECTION 02: LOCATION DETAILS --}}
                            <div>
                                <div class="flex items-center gap-4 mb-8">
                                    <span class="w-10 h-10 rounded-2xl bg-yellow-400 text-white flex items-center justify-center font-black">2</span>
                                    <h3 class="font-black text-sm uppercase tracking-widest text-gray-800">Detail Alamat</h3>
                                </div>
                                
                                <div class="space-y-8">
                                    <div class="space-y-2">
                                        <label class="block font-black text-[10px] uppercase tracking-widest text-yellow-500 ml-4">
                                            Alamat Jalan & No. Rumah
                                        </label>
                                        <textarea name="address" rows="3" 
                                            class="w-full bg-yellow-50/30 border-2 border-transparent focus:border-yellow-200 focus:bg-white p-5 rounded-[2rem] text-sm font-bold text-gray-700 transition-all outline-none" 
                                            required>{{ old('address', $address->address) }}</textarea>
                                    </div>
            
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="space-y-2">
                                            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 ml-4">Kota</label>
                                            <input type="text" name="city" value="{{ old('city', $address->city) }}" 
                                                class="w-full bg-gray-50 border-2 border-transparent focus:border-gray-200 focus:bg-white p-4 rounded-[1.5rem] text-sm font-bold text-gray-700 transition-all outline-none" required>
                                        </div>
                
                                        <div class="space-y-2">
                                            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 ml-4">Provinsi</label>
                                            <input type="text" name="province" value="{{ old('province', $address->province) }}" 
                                                class="w-full bg-gray-50 border-2 border-transparent focus:border-gray-200 focus:bg-white p-4 rounded-[1.5rem] text-sm font-bold text-gray-700 transition-all outline-none" required>
                                        </div>
                
                                        <div class="space-y-2">
                                            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 ml-4">Kode Pos</label>
                                            <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code) }}" 
                                                class="w-full bg-gray-50 border-2 border-transparent focus:border-gray-200 focus:bg-white p-4 rounded-[1.5rem] text-sm font-bold text-gray-700 transition-all outline-none" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        {{-- SUBMIT BUTTON --}}
                        <div class="mt-12 pt-8 border-t-2 border-pink-50 flex flex-col md:flex-row items-center justify-between gap-6">
                            <p class="text-[10px] font-bold text-gray-300 uppercase italic">
                                Last updated: {{ $address->updated_at->diffForHumans() }}
                            </p>
                            <button type="submit" 
                                    class="w-full md:w-auto bg-gray-800 text-white px-12 py-5 rounded-[2rem] text-xs font-black uppercase tracking-[0.2em] hover:bg-pink-500 shadow-xl shadow-gray-200 hover:shadow-pink-200 transition-all active:scale-95">
                                Save Changes ✨
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
        50% { transform: translateY(-15px) rotate(5deg); }
    }
    .butterfly-float { animation: float 5s ease-in-out infinite; }
    
    input::placeholder { color: #d1d5db; font-weight: 400; }
</style>
@endsection