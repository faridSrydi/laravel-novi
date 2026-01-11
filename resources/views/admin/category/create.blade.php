@extends('layouts.admin')

@section('title', 'NEW CATEGORY')

@section('content')
<div class="max-w-xl mx-auto mt-10 relative">
    
    {{-- Floating Butterfly Decoration --}}
    <div class="absolute -top-12 -left-10 text-5xl opacity-30 butterfly-float pointer-events-none">🦋</div>
    <div class="absolute -bottom-10 -right-10 text-4xl opacity-20 butterfly-float pointer-events-none" style="animation-delay: 1.5s">✨</div>

    {{-- HEADER --}}
    <div class="mb-10 text-center">
        <div class="inline-block px-4 py-1.5 bg-pink-100 text-pink-500 rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-4">
            Garden Taxonomy // Entry
        </div>
        <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-800">
            Grow New <span class="text-pink-500">Category</span> 🍭
        </h1>
        <div class="h-1.5 w-20 bg-pink-100 rounded-full mx-auto mt-4"></div>
    </div>

    {{-- FORM CONTAINER --}}
    <div class="bg-white rounded-[3rem] border-4 border-pink-50 p-10 shadow-2xl shadow-pink-100/30 relative overflow-hidden">
        {{-- Soft Glow Background --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-pink-50 rounded-full -mr-16 -mt-16 blur-3xl opacity-50"></div>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-10 relative z-10">
            @csrf

            {{-- Input Field --}}
            <div class="space-y-4">
                <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-pink-300 ml-2">
                    <span class="w-1.5 h-1.5 bg-pink-400 rounded-full"></span>
                    Category Name
                </label>
                
                <div class="relative group">
                    <input type="text" 
                           name="name" 
                           placeholder="Type something sweet..." 
                           class="w-full bg-pink-50/30 border-2 border-pink-50 rounded-[2rem] p-5 font-bold text-gray-700 focus:outline-none focus:border-pink-300 focus:bg-white transition-all placeholder-pink-200 uppercase tracking-wide text-lg"
                           required
                           autofocus>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 text-2xl group-focus-within:rotate-12 transition-transform opacity-30">🦋</div>
                </div>
                
                @error('name')
                    <div class="flex items-center gap-3 mt-4 bg-red-50 p-4 rounded-2xl border border-red-100 animate-head-shake">
                        <span class="text-xl">🥺</span>
                        <p class="text-[10px] font-black uppercase tracking-wide text-red-400 leading-tight">Oops! {{ $message }}</p>
                    </div>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="pt-6 flex flex-col gap-4 text-center">
                <button type="submit" class="w-full bg-pink-500 text-white py-5 rounded-[2rem] text-sm font-black uppercase tracking-[0.3em] hover:bg-pink-600 shadow-xl shadow-pink-200 transition-all active:scale-95 flex justify-center items-center gap-3 group relative overflow-hidden">
                    {{-- Shine Effect --}}
                    <div class="absolute inset-0 w-full h-full bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 skew-x-12"></div>
                    
                    <span class="relative z-10">Save Category ✨</span>
                </button>

                <a href="{{ route('admin.categories.index') }}" 
                   class="inline-block mt-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-300 hover:text-pink-400 transition-colors group">
                    <span class="group-hover:mr-2 transition-all">←</span> Nevermind, take me back
                </a>
            </div>
        </form>
    </div>

    {{-- Bottom Decoration --}}
    <div class="mt-8 text-center flex justify-center items-center gap-4 opacity-20">
        <span class="w-10 h-[2px] bg-pink-200"></span>
        <span class="text-xl">🦋</span>
        <span class="w-10 h-[2px] bg-pink-200"></span>
    </div>
</div>

<style>
@keyframes head-shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    75% { transform: translateX(4px); }
}
.animate-head-shake { animation: head-shake 0.3s ease-in-out infinite; animation-iteration-count: 2; }
</style>
@endsection