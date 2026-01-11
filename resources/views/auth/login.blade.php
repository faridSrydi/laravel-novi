@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20 px-4 bg-pink-50/50">
    <div class="max-w-md w-full">
        
        {{-- Logo/Heading --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight mb-2">
                HALO <span class="text-pink-500">LAGI!</span> 👋
            </h1>
            <p class="text-sm text-pink-400 font-bold uppercase tracking-widest">
                Yuk, masuk ke akun MiniMoo mu
            </p>
        </div>

        <div class="bg-white rounded-3xl border border-pink-100 p-8 md:p-10 shadow-xl shadow-pink-100/50 relative overflow-hidden">
            {{-- Dekorasi Bulatan Lembut --}}
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-pink-50 rounded-full opacity-50"></div>
            
            {{-- Error Handling --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-2 border-dashed border-red-200 rounded-2xl">
                    <p class="text-xs font-bold text-red-500 flex items-center gap-2">
                        <span>⚠️</span> {{ $errors->first() }}
                    </p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5 relative z-10">
                @csrf

                {{-- Email Field --}}
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-wider mb-2 ml-1">
                        Alamat Email
                    </label>
                    <input type="email" name="email" 
                           class="w-full bg-pink-50/30 border-2 border-pink-100 rounded-2xl text-sm py-4 px-5 focus:ring-4 focus:ring-pink-50 focus:border-pink-400 transition placeholder:text-gray-300"
                           placeholder="nama@email.com" 
                           required autofocus>
                </div>

                {{-- Password Field --}}
                <div>
                    <div class="flex justify-between items-center mb-2 ml-1">
                        <label class="text-xs font-black text-gray-500 uppercase tracking-wider">
                            Kata Sandi
                        </label>
                        <a href="#" class="text-[10px] font-bold text-pink-400 hover:text-pink-600 uppercase underline decoration-2 underline-offset-4">Lupa?</a>
                    </div>
                    <input type="password" name="password" 
                           class="w-full bg-pink-50/30 border-2 border-pink-100 rounded-2xl text-sm py-4 px-5 focus:ring-4 focus:ring-pink-50 focus:border-pink-400 transition placeholder:text-gray-300"
                           placeholder="••••••••" 
                           required>
                </div>

                {{-- Remember Me (Optional but cute) --}}
                <div class="flex items-center ml-1">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-pink-500 border-pink-200 rounded focus:ring-pink-400">
                    <label for="remember" class="ml-2 text-xs font-bold text-gray-400">Ingat Saya</label>
                </div>

                {{-- Login Button --}}
                <div class="pt-2">
                    <button type="submit" 
                            class="w-full bg-pink-500 text-white text-sm font-black uppercase tracking-widest py-4 rounded-xl hover:bg-pink-600 hover:scale-[1.02] active:scale-95 transition duration-300 shadow-lg shadow-pink-200">
                        Masuk Sekarang 🚀
                    </button>
                </div>
            </form>

            {{-- Footer Form --}}
            <div class="mt-8 pt-8 border-t border-dashed border-pink-100 text-center">
                <p class="text-xs text-gray-400 font-bold mb-4 uppercase tracking-tighter">Belum punya akun?</p>
                <a href="{{ route('register') }}" 
                   class="inline-block w-full border-2 border-pink-500 text-pink-500 text-sm font-black uppercase tracking-widest py-4 rounded-xl hover:bg-pink-50 transition duration-300">
                    Daftar Akun Baru
                </a>
            </div>
        </div>

        {{-- Help Links --}}
        <div class="mt-8 flex justify-center gap-6">
            <a href="#" class="text-[10px] font-bold text-pink-300 uppercase hover:text-pink-500 transition">Bantuan</a>
            <span class="text-pink-200">•</span>
            <a href="#" class="text-[10px] font-bold text-pink-300 uppercase hover:text-pink-500 transition">Ketentuan</a>
        </div>
    </div>
</div>

<style>
    /* Menyamakan style input agar tidak ada outline hitam default */
    input:focus {
        outline: none !important;
    }
</style>
@endsection