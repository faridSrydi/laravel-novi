@extends('layouts.admin')

@section('title', 'CATEGORIES')

@section('content')
    <div class="max-w-full relative">
        {{-- Hiasan Kupu-kupu Melayang di Pojok Tabel --}}
        <div class="absolute -top-10 -right-5 text-4xl opacity-20 butterfly-float pointer-events-none">🦋</div>

        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-10 pb-6 border-b-4 border-pink-50">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-2 h-2 bg-pink-400 rounded-full animate-ping"></span>
                    <span class="font-black text-[10px] text-pink-300 uppercase tracking-[0.3em]">Master Data // Sweet Collection</span>
                </div>
                <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-800">
                    Category <span class="text-pink-500 underline decoration-yellow-400 decoration-4 underline-offset-8">List</span> 🍭
                </h1>
            </div>

            <a href="{{ route('admin.categories.create') }}" 
               class="group relative inline-flex items-center gap-3 px-8 py-4 overflow-hidden font-black transition-all bg-pink-500 hover:bg-pink-600 text-white rounded-[2rem] shadow-lg shadow-pink-200 active:scale-95">
                <span class="text-xl group-hover:rotate-12 transition-transform">➕</span>
                <span class="uppercase tracking-widest text-xs">New Category</span>
            </a>
        </div>

        {{-- FLASH MESSAGE (CUTE ALERT) --}}
        @if (session('success'))
            <div class="mb-8 bg-green-50 border-2 border-dashed border-green-200 p-5 rounded-[2rem] flex items-center gap-4 animate-bounce">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-2xl">✨</div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-green-400">Sweet Success!</p>
                    <p class="text-sm font-bold text-green-700 italic">"{{ session('success') }}"</p>
                </div>
            </div>
        @endif

        {{-- TABLE CONTAINER --}}
        <div class="bg-white rounded-[2.5rem] border-4 border-pink-50 shadow-2xl shadow-pink-100/20 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    {{-- TABLE HEAD --}}
                    <thead>
                        <tr class="bg-pink-50/50">
                            <th class="p-6 text-[11px] font-black uppercase tracking-[0.2em] text-pink-400 w-20 text-center">
                                No
                            </th>
                            <th class="p-6 text-[11px] font-black uppercase tracking-[0.2em] text-pink-400">
                                Category Name
                            </th>
                            <th class="p-6 text-[11px] font-black uppercase tracking-[0.2em] text-pink-400">
                                Slug / Key
                            </th>
                            <th class="p-6 text-[11px] font-black uppercase tracking-[0.2em] text-pink-400 text-right">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    {{-- TABLE BODY --}}
                    <tbody class="divide-y-2 divide-pink-50">
                        @forelse ($categories as $category)
                            <tr class="hover:bg-pink-50/30 group transition-all">
                                {{-- NO --}}
                                <td class="p-6 text-center">
                                    <span class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center mx-auto font-black text-gray-400 group-hover:bg-pink-500 group-hover:text-white transition-all shadow-sm">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- NAME --}}
                                <td class="p-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-8 bg-yellow-400 rounded-full group-hover:h-10 transition-all"></div>
                                        <span class="font-black text-gray-800 uppercase text-lg group-hover:text-pink-500 transition-colors">
                                            {{ $category->name }}
                                        </span>
                                    </div>
                                </td>

                                {{-- SLUG --}}
                                <td class="p-6">
                                    <span class="font-bold text-[11px] bg-blue-50 text-blue-400 px-4 py-2 rounded-full border border-blue-100 uppercase tracking-widest">
                                        /{{ $category->slug }} 🦋
                                    </span>
                                </td>

                                {{-- ACTIONS --}}
                                <td class="p-6 text-right">
                                    <div class="flex justify-end items-center gap-3">
                                        <a href="{{ route('admin.categories.edit', $category) }}" 
                                           class="w-10 h-10 flex items-center justify-center bg-white border-2 border-pink-100 text-pink-400 rounded-xl hover:bg-pink-500 hover:text-white hover:border-pink-500 shadow-sm transition-all group/btn">
                                            <span class="text-sm group-hover/btn:scale-125 transition-transform">✏️</span>
                                        </a>

                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Hapus kategori ini? 🥺')" 
                                                    class="w-10 h-10 flex items-center justify-center bg-white border-2 border-red-50 text-red-200 rounded-xl hover:bg-red-500 hover:text-white hover:border-red-500 shadow-sm transition-all group/del">
                                                <span class="text-sm group-hover/del:animate-pulse">🗑️</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <span class="text-6xl mb-4 animate-bounce">🦋</span>
                                        <h3 class="font-black text-pink-200 uppercase tracking-[0.5em] text-xl">Empty Garden</h3>
                                        <p class="text-xs font-bold text-gray-300 mt-2">Belum ada kategori yang tumbuh di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- FOOTER STATUS --}}
            <div class="p-6 bg-pink-50/30 flex justify-between items-center border-t-2 border-pink-50">
                <div class="flex items-center gap-3">
                    <span class="px-4 py-1.5 bg-white rounded-full text-[10px] font-black text-pink-300 shadow-sm border border-pink-100">
                        TOTAL ITEMS: {{ $categories->count() }}
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-black text-pink-200 uppercase tracking-widest">System Online</span>
                    <div class="w-3 h-3 bg-green-400 rounded-full shadow-[0_0_10px_rgba(74,222,128,0.5)] animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>
@endsection