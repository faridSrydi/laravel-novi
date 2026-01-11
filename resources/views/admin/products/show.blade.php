@extends('layouts.admin')

@section('title', 'SPEC_SHEET_')

@section('content')
<div class="max-w-5xl mx-auto pb-20 relative">

    {{-- Decorative Butterfly --}}
    <div class="absolute -top-10 -left-4 text-5xl opacity-20 butterfly-float pointer-events-none">🦋</div>

    {{-- HEADER NAVIGATION --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 border-b-4 border-pink-50 pb-6 gap-6">
        <div>
            <span class="px-3 py-1 bg-pink-100 text-pink-500 rounded-full text-[9px] font-black uppercase tracking-[0.2em] mb-2 inline-block">Database // Archive</span>
            <div class="flex items-center gap-4">
                <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-800 leading-none">
                    Treat <span class="text-pink-500">Spec</span> ✨
                </h1>
                <span class="font-mono text-[11px] bg-gray-800 text-white px-3 py-1 rounded-lg">
                    #{{ substr(md5($product->id), 0, 6) }}
                </span>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <a href="{{ route('admin.products.index') }}"
                class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-pink-500 flex items-center gap-2 transition-all group">
                <span class="group-hover:-translate-x-1 transition-transform">←</span> Return to Shop
            </a>

            <a href="{{ route('admin.products.edit', $product) }}"
                class="bg-yellow-400 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-yellow-500 shadow-lg shadow-yellow-100 transition-all active:scale-95">
                Edit Entry 📝
            </a>
        </div>
    </div>

    {{-- MAIN CONTENT GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- LEFT COL: VISUAL GALLERY --}}
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-[3rem] p-4 border-4 border-pink-50 shadow-xl shadow-pink-100/20 overflow-hidden group">
                {{-- Main Image Display --}}
                @if ($product->images->count() > 0)
                    <div class="rounded-[2.5rem] overflow-hidden aspect-square border-2 border-pink-50 relative">
                        <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            id="mainDisplay">
                        <div class="absolute top-4 right-4 bg-white/80 backdrop-blur-md px-3 py-1 rounded-full text-[9px] font-bold text-pink-500">
                            MAIN_VIEW
                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    @if ($product->images->count() > 1)
                        <div class="grid grid-cols-4 gap-3 mt-4 px-2">
                            @foreach ($product->images as $img)
                                <button onclick="swapImage('{{ asset('storage/' . $img->image) }}')" 
                                    class="aspect-square rounded-2xl overflow-hidden border-2 border-transparent hover:border-pink-300 transition-all">
                                    <img src="{{ asset('storage/' . $img->image) }}" class="w-full h-full object-cover opacity-70 hover:opacity-100 transition-opacity">
                                </button>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="w-full aspect-square bg-pink-50 rounded-[2.5rem] flex flex-col items-center justify-center border-4 border-dashed border-pink-100">
                        <span class="text-4xl mb-2">📸</span>
                        <span class="font-mono text-[10px] text-pink-300 uppercase">No_Visual_Found</span>
                    </div>
                @endif
            </div>

            {{-- Metadata Card --}}
            <div class="bg-gray-800 rounded-[2.5rem] p-8 text-white relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 text-8xl opacity-10">🍬</div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-4">Product Birth</h4>
                <div class="space-y-1">
                    <p class="text-xl font-bold italic">{{ $product->created_at->format('d F Y') }}</p>
                    <p class="text-[10px] text-pink-400 font-mono">{{ $product->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        {{-- RIGHT COL: INFO & INVENTORY --}}
        <div class="lg:col-span-7 space-y-8">
            
            {{-- Product Info Section --}}
            <div class="bg-white rounded-[3rem] p-10 border-4 border-pink-50 shadow-xl shadow-pink-100/20">
                <div class="mb-6">
                    <span class="inline-block px-4 py-1.5 rounded-full bg-yellow-50 text-yellow-600 text-[10px] font-black uppercase tracking-widest border border-yellow-100 mb-4">
                        {{ $product->category->name }}
                    </span>
                    <h2 class="text-5xl font-black uppercase tracking-tighter text-gray-800 leading-[0.9] mb-6">
                        {{ $product->name }}
                    </h2>
                    <div class="w-20 h-2 bg-pink-500 rounded-full mb-8"></div>
                </div>

                <div class="space-y-4">
                    <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-pink-300">
                        <span class="w-1.5 h-1.5 bg-pink-400 rounded-full"></span> The Story
                    </label>
                    <p class="text-gray-600 leading-relaxed font-medium italic text-lg pr-4">
                        "{{ $product->description }}"
                    </p>
                </div>
            </div>

            {{-- Inventory Table Section --}}
            <div class="bg-white rounded-[3rem] border-4 border-pink-50 shadow-xl shadow-pink-100/20 overflow-hidden">
                <div class="flex items-center justify-between p-6 bg-gray-800 text-white">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">📊</span>
                        <h3 class="text-[11px] font-black uppercase tracking-[0.2em]">Inventory Breakdown</h3>
                    </div>
                    <span class="font-mono text-[10px] bg-pink-500 px-3 py-1 rounded-full">{{ $product->variants->count() }} VARIATIONS</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-pink-50/30 border-b border-pink-50">
                                <th class="py-5 px-8 text-[10px] font-black uppercase tracking-widest text-pink-400">Style</th>
                                <th class="py-5 px-8 text-[10px] font-black uppercase tracking-widest text-pink-400">Size</th>
                                <th class="py-5 px-8 text-[10px] font-black uppercase tracking-widest text-pink-400 text-right">Available</th>
                                <th class="py-5 px-8 text-[10px] font-black uppercase tracking-widest text-pink-400 text-right">Price Tag</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pink-50/50">
                            @foreach ($product->variants as $v)
                                <tr class="hover:bg-pink-50/30 transition-colors group">
                                    <td class="py-5 px-8">
                                        <span class="text-xs font-black text-gray-700 uppercase group-hover:text-pink-500 transition-colors">{{ $v->color }}</span>
                                    </td>
                                    <td class="py-5 px-8">
                                        <span class="text-[10px] font-mono font-bold bg-gray-100 px-2 py-1 rounded text-gray-500 uppercase">{{ $v->size }}</span>
                                    </td>
                                    <td class="py-5 px-8 text-right">
                                        @if ($v->stock > 0)
                                            <span class="inline-flex items-center gap-1.5 text-xs font-black text-green-500">
                                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                                {{ $v->stock }} <span class="text-[9px] opacity-60">PCS</span>
                                            </span>
                                        @else
                                            <span class="text-[9px] font-black text-white bg-red-400 px-3 py-1 rounded-full uppercase">
                                                Sold Out
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-5 px-8 text-right">
                                        <span class="font-mono text-sm font-black text-gray-800">
                                            Rp{{ number_format($v->price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function swapImage(src) {
        const main = document.getElementById('mainDisplay');
        main.style.opacity = '0';
        setTimeout(() => {
            main.src = src;
            main.style.opacity = '1';
        }, 200);
    }
</script>

<style>
    #mainDisplay { transition: opacity 0.3s ease-in-out; }
</style>
@endsection