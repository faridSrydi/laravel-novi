@extends('layouts.admin')

@section('title', 'EDIT CATEGORY')

@section('content')
<div class="max-w-xl mx-auto mt-10 relative">
    
    {{-- Decorative Butterflies --}}
    <div class="absolute -top-10 -right-10 text-5xl opacity-30 butterfly-float pointer-events-none">🦋</div>
    <div class="absolute top-1/2 -left-20 text-3xl opacity-10 butterfly-float pointer-events-none" style="animation-delay: 2s">🦋</div>

    {{-- HEADER --}}
    <div class="mb-10 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-yellow-100 text-yellow-600 rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-4 shadow-sm">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
            </span>
            Update Mode // ID: {{ substr(md5($category->id), 0, 6) }}
        </div>
        <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-800">
            Edit <span class="text-pink-500">Category</span> ✨
        </h1>
        <p class="text-[11px] font-bold text-gray-300 uppercase tracking-[0.4em] mt-2">Personalize your garden</p>
    </div>

    {{-- FORM CONTAINER --}}
    <div class="bg-white rounded-[3rem] border-4 border-pink-50 p-10 shadow-2xl shadow-pink-100/30 relative overflow-hidden">
        
        {{-- Decorative Inner Circle --}}
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-blue-50 rounded-full blur-3xl opacity-40"></div>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-10 relative z-10">
            @csrf
            @method('PUT')

            {{-- Input Field --}}
            <div class="space-y-4">
                <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-pink-300 ml-2">
                    <span class="w-2 h-0.5 bg-pink-200 rounded-full"></span>
                    Category Name
                </label>
                
                <div class="relative group">
                    <input type="text" 
                           name="name" 
                           value="{{ old('name', $category->name) }}"
                           placeholder="Update name..." 
                           class="w-full bg-pink-50/20 border-2 border-pink-50 rounded-[2rem] p-6 font-bold text-gray-700 focus:outline-none focus:border-blue-200 focus:bg-white transition-all text-lg uppercase tracking-wide shadow-inner"
                           required>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 text-2xl group-focus-within:scale-125 transition-transform opacity-40">🏷️</div>
                </div>
                
                @error('name')
                    <div class="flex items-center gap-3 mt-4 bg-red-50 p-4 rounded-2xl border-2 border-red-100 animate-bounce">
                        <span class="text-xl">🦋</span>
                        <p class="text-[10px] font-black uppercase tracking-wide text-red-400">Oh no! {{ $message }}</p>
                    </div>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="pt-6 flex flex-col gap-4">
                <button type="submit" class="w-full bg-pink-500 text-white py-5 rounded-[2.5rem] text-sm font-black uppercase tracking-[0.3em] hover:bg-pink-600 shadow-xl shadow-pink-200 transition-all active:scale-95 flex justify-center items-center gap-3 group relative overflow-hidden">
                    {{-- Magic Shine Effect --}}
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    
                    <span>Save Changes 🦋</span>
                </button>

                <div class="flex justify-center items-center gap-6 mt-4">
                    <a href="{{ route('admin.categories.index') }}" 
                       class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-300 hover:text-pink-400 transition-all flex items-center gap-2 group">
                        <span class="group-hover:-translate-x-1 transition-transform">🔙</span> 
                        Go Back
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Bottom Floating Element --}}
    <div class="text-center mt-10">
        <span class="inline-block animate-bounce text-2xl opacity-20">🍭</span>
    </div>
</div>

<style>
    /* Tambahan animasi khusus jika belum ada di main layout */
    @keyframes float {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(5deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }
    .butterfly-float { animation: float 5s ease-in-out infinite; }
</style>
@endsection