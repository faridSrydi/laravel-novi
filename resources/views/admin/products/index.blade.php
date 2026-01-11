@extends('layouts.admin')

@section('title', 'PRODUCT LIST')

@section('content')
    <div class="max-w-full relative">
        {{-- Floating Butterfly Decoration --}}
        <div class="absolute -top-6 right-10 text-4xl opacity-20 butterfly-float pointer-events-none">🦋</div>
        
        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-10 pb-8 border-b-4 border-pink-50">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-3 py-1 bg-blue-100 text-blue-500 rounded-full text-[9px] font-black uppercase tracking-[0.2em]">Inventory Hub</span>
                    <span class="text-pink-200">✨</span>
                </div>
                <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-800">
                    Product <span class="text-blue-400">Warehouse</span> 🧸
                </h1>
            </div>

            <a href="{{ route('admin.products.create') }}" 
               class="group relative inline-flex items-center gap-3 px-8 py-4 overflow-hidden font-black transition-all bg-blue-500 hover:bg-blue-600 text-white rounded-[2rem] shadow-xl shadow-blue-100 active:scale-95">
                <span class="text-xl group-hover:rotate-12 transition-transform">🍭</span>
                <span class="uppercase tracking-widest text-xs">New Entry</span>
            </a>
        </div>

        {{-- TABLE CONTAINER --}}
        <div class="bg-white rounded-[3rem] border-4 border-blue-50 shadow-2xl shadow-blue-100/20 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    {{-- TABLE HEAD --}}
                    <thead>
                        <tr class="bg-blue-50/30">
                            <th class="p-6 text-[11px] font-black uppercase tracking-[0.2em] text-blue-300 w-1/3">
                                Product Details
                            </th>
                            <th class="p-6 text-[11px] font-black uppercase tracking-[0.2em] text-blue-300">
                                Category
                            </th>
                            <th class="p-6 text-[11px] font-black uppercase tracking-[0.2em] text-blue-300 text-center">
                                Variants
                            </th>
                            <th class="p-6 text-[11px] font-black uppercase tracking-[0.2em] text-blue-300 text-right">
                                Management
                            </th>
                        </tr>
                    </thead>

                    {{-- TABLE BODY --}}
                    <tbody class="divide-y-2 divide-blue-50">
                        @foreach($products as $product)
                        <tr class="hover:bg-blue-50/20 group transition-all">
                            
                            {{-- NAME COLUMN --}}
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center border-2 border-dashed border-blue-100 group-hover:rotate-6 transition-transform">
                                        <span class="text-2xl">📦</span>
                                    </div>
                                    <div>
                                        <p class="font-black text-gray-800 uppercase text-lg leading-tight group-hover:text-blue-500 transition-colors">
                                            {{ $product->name }}
                                        </p>
                                        <p class="font-bold text-[10px] text-gray-300 tracking-widest mt-1">
                                            UID: {{ strtoupper(substr(md5($product->id), 0, 8)) }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- CATEGORY COLUMN --}}
                            <td class="p-6">
                                <span class="px-4 py-2 rounded-2xl bg-pink-50 text-pink-400 text-[10px] font-black uppercase tracking-tighter border-2 border-pink-100 inline-block group-hover:bg-pink-500 group-hover:text-white group-hover:border-pink-500 transition-all">
                                    {{ $product->category->name }}
                                </span>
                            </td>

                            {{-- VARIANT COLUMN --}}
                            <td class="p-6 text-center">
                                <div class="inline-flex flex-col items-center justify-center w-12 h-12 rounded-full bg-yellow-50 border-2 border-yellow-200 group-hover:bg-yellow-400 transition-all">
                                    <span class="font-black text-yellow-600 group-hover:text-white">
                                        {{ str_pad($product->variants->count(), 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>
                            </td>

                            {{-- ACTION COLUMN --}}
                            <td class="p-6 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('admin.products.show',$product) }}" 
                                       class="w-10 h-10 flex items-center justify-center bg-white border-2 border-blue-50 text-blue-300 rounded-xl hover:bg-blue-400 hover:text-white hover:border-blue-400 transition-all shadow-sm">
                                        <span class="text-xs">👁️</span>
                                    </a>
                                    
                                    <a href="{{ route('admin.products.edit',$product) }}" 
                                       class="w-10 h-10 flex items-center justify-center bg-white border-2 border-pink-50 text-pink-300 rounded-xl hover:bg-pink-400 hover:text-white hover:border-pink-400 transition-all shadow-sm">
                                        <span class="text-xs">✏️</span>
                                    </a>

                                    <form method="POST" action="{{ route('admin.products.destroy',$product) }}" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Hapus produk ini dari katalog? 🥺')" 
                                                class="w-10 h-10 flex items-center justify-center bg-white border-2 border-red-50 text-red-200 rounded-xl hover:bg-red-500 hover:text-white hover:border-red-500 transition-all shadow-sm group/del">
                                            <span class="text-xs group-hover/del:animate-pulse">🗑️</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- FOOTER / PAGINATION --}}
            <div class="p-8 bg-blue-50/20 flex justify-between items-center border-t-2 border-blue-50">
                <span class="font-black text-[10px] text-blue-300 uppercase tracking-widest bg-white px-4 py-2 rounded-full shadow-sm">
                    STORAGE: {{ $products->count() }} UNITS
                </span>
                
                <div class="flex gap-2">
                    <button class="w-10 h-10 rounded-xl bg-white border-2 border-blue-100 text-blue-400 hover:bg-blue-500 hover:text-white transition-all flex items-center justify-center font-black">‹</button>
                    <button class="w-10 h-10 rounded-xl bg-blue-500 text-white shadow-lg shadow-blue-200 flex items-center justify-center font-black">1</button>
                    <button class="w-10 h-10 rounded-xl bg-white border-2 border-blue-100 text-blue-400 hover:bg-blue-500 hover:text-white transition-all flex items-center justify-center font-black">›</button>
                </div>
            </div>
        </div>
        
        {{-- Bottom Aesthetic --}}
        <p class="text-center mt-8 text-[10px] font-black text-gray-200 uppercase tracking-[0.5em]">Butterfly Sweet Minimart System</p>
    </div>
@endsection