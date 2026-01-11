@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-16 px-4 bg-pink-50/50">
    <div class="max-w-md w-full">
        
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight mb-2 uppercase">
                GABUNG <span class="text-pink-500">YUK!</span> ✨
            </h1>
            <p class="text-xs text-pink-400 font-bold uppercase tracking-widest leading-relaxed">
                Dapatkan akses jajan paling seru <br> dan promo khusus buat kamu!
            </p>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-pink-100 p-8 md:p-10 shadow-xl shadow-pink-100/50 relative overflow-hidden">
            {{-- Dekorasi Aksen --}}
            <div class="absolute -top-6 -left-6 w-20 h-20 bg-yellow-100 rounded-full opacity-40"></div>
            
            {{-- Error Handling --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-2 border-dashed border-red-200 rounded-2xl">
                    <p class="text-[11px] font-bold text-red-500 uppercase flex items-center gap-2">
                        <span>⚠️</span> {{ $errors->first() }}
                    </p>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4 relative z-10">
                @csrf

                {{-- Name Field --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-gray-400 mb-1.5 ml-1">
                        Nama Lengkap *
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full bg-pink-50/30 border-2 border-pink-100 rounded-2xl text-sm py-4 px-5 focus:ring-4 focus:ring-pink-50 focus:border-pink-400 transition placeholder:text-gray-300"
                           placeholder="Siapa nama kamu?" required>
                </div>

                {{-- Email Field --}}
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-gray-400 mb-1.5 ml-1">
                        Alamat Email *
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full bg-pink-50/30 border-2 border-pink-100 rounded-2xl text-sm py-4 px-5 focus:ring-4 focus:ring-pink-50 focus:border-pink-400 transition placeholder:text-gray-300"
                           placeholder="nama@email.com" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Password Field --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-gray-400 mb-1.5 ml-1">
                            Kata Sandi *
                        </label>
                        <input type="password" name="password" 
                               class="w-full bg-pink-50/30 border-2 border-pink-100 rounded-2xl text-sm py-4 px-5 focus:ring-4 focus:ring-pink-50 focus:border-pink-400 transition placeholder:text-gray-300"
                               placeholder="Min. 8 karakter" required>
                    </div>

                    {{-- Confirm Password Field --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-gray-400 mb-1.5 ml-1">
                            Konfirmasi *
                        </label>
                        <input type="password" name="password_confirmation" 
                               class="w-full bg-pink-50/30 border-2 border-pink-100 rounded-2xl text-sm py-4 px-5 focus:ring-4 focus:ring-pink-50 focus:border-pink-400 transition placeholder:text-gray-300"
                               placeholder="Ulangi lagi" required>
                    </div>
                </div>

                {{-- Agreement --}}
                <div class="pt-2 px-1">
                    <p class="text-[10px] text-gray-400 font-medium leading-normal">
                        Dengan mendaftar, kamu setuju dengan <a href="#" class="text-pink-400 underline decoration-pink-200 underline-offset-2 hover:text-pink-500">Ketentuan Layanan</a> kami.
                    </p>
                </div>

                {{-- Register Button --}}
                <div class="pt-2">
                    <button type="submit" 
                            class="w-full bg-pink-500 text-white text-sm font-black uppercase tracking-widest py-4 rounded-2xl hover:bg-pink-600 hover:scale-[1.02] active:scale-95 transition duration-300 shadow-lg shadow-pink-200">
                        Daftar Akun Baru 🍭
                    </button>
                </div>
            </form>

            {{-- Footer Form --}}
            <div class="mt-8 pt-8 border-t border-dashed border-pink-100 text-center">
                <p class="text-xs text-gray-400 font-bold mb-4 uppercase tracking-tighter">Sudah jadi sobat Laraclo?</p>
                <a href="{{ route('login') }}" 
                   class="inline-block w-full border-2 border-pink-500 text-pink-500 text-sm font-black uppercase tracking-widest py-4 rounded-2xl hover:bg-pink-50 transition duration-300">
                    Masuk ke Akun Anda
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hilangkan focus ring hitam default browser */
    input:focus {
        outline: none !important;
    }
    
    /* Custom style untuk placeholder agar konsisten */
    ::placeholder {
        color: #d1d5db !important; /* gray-300 */
        font-weight: 500;
    }
</style>
@endsection