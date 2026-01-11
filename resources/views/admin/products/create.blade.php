@extends('layouts.admin')

@section('title', 'NEW PRODUCT')

@section('content')
<div class="max-w-5xl mx-auto pb-20 relative">
    
    {{-- Decorative Butterfly --}}
    <div class="absolute -top-10 -right-4 text-5xl opacity-20 butterfly-float pointer-events-none">🦋</div>

    {{-- HEADER --}}
    <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b-4 border-blue-50 pb-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-3 py-1 bg-blue-100 text-blue-500 rounded-full text-[9px] font-black uppercase tracking-[0.2em]">Workshop // Mode</span>
                <span class="animate-pulse">✨</span>
            </div>
            <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-800 leading-none">
                Create New <span class="text-blue-500">Treat</span> 🍭
            </h1>
        </div>
        <a href="{{ route('admin.products.index') }}"
            class="text-[10px] font-black uppercase tracking-widest text-gray-300 hover:text-blue-500 flex items-center gap-2 transition-all group">
            <span class="group-hover:-translate-x-1 transition-transform">←</span> Back to Warehouse
        </a>
    </div>

    {{-- FORM CONTAINER --}}
    <div class="bg-white rounded-[3rem] border-4 border-blue-50 p-10 shadow-2xl shadow-blue-100/30 relative overflow-hidden">
        
        {{-- Soft Glow Decoration --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full -mr-32 -mt-32 blur-3xl opacity-50"></div>

        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.store') }}" class="space-y-12 relative z-10">
            @csrf

            {{-- SECTION 1: GENERAL INFO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Product Name --}}
                <div class="space-y-3">
                    <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-blue-300 ml-2">
                        <span class="w-1.5 h-1.5 bg-blue-400 rounded-full"></span> Product Name
                    </label>
                    <input name="name"
                        class="w-full bg-blue-50/30 border-2 border-blue-50 rounded-2xl p-4 font-bold text-gray-700 focus:outline-none focus:border-blue-200 focus:bg-white transition-all placeholder-blue-100"
                        placeholder="E.G. STRAWBERRY BUTTERFLY">
                </div>

                {{-- Category --}}
                <div class="space-y-3">
                    <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-blue-300 ml-2">
                        <span class="w-1.5 h-1.5 bg-blue-400 rounded-full"></span> Category
                    </label>
                    <div class="relative">
                        <select name="category_id"
                            class="w-full bg-blue-50/30 border-2 border-blue-50 rounded-2xl p-4 font-bold text-gray-700 appearance-none focus:outline-none focus:border-blue-200 focus:bg-white cursor-pointer transition-all">
                            <option value="">SELECT_CATEGORY</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}">{{ strtoupper($c->name) }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-blue-200">
                            ▼
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="space-y-3">
                <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-blue-300 ml-2">
                    <span class="w-1.5 h-1.5 bg-blue-400 rounded-full"></span> Product Story
                </label>
                <textarea name="description" rows="3"
                    class="w-full bg-blue-50/30 border-2 border-blue-50 rounded-[2rem] p-6 font-bold text-gray-700 focus:outline-none focus:border-blue-200 focus:bg-white transition-all placeholder-blue-100 resize-none"
                    placeholder="Tell us something sweet about this product..."></textarea>
            </div>

            {{-- Images Input Area --}}
            <div class="space-y-3">
                <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-blue-300 ml-2">
                    <span class="w-1.5 h-1.5 bg-blue-400 rounded-full"></span> Gallery Images
                </label>

                <div class="relative border-4 border-dashed border-blue-50 rounded-[2rem] bg-blue-50/10 p-10 text-center transition-all group hover:bg-blue-50 hover:border-blue-200 cursor-pointer">
                    <input type="file" name="images[]" id="imageInput" multiple onchange="previewImages(event)"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">

                    <div class="space-y-2 pointer-events-none">
                        <div class="text-4xl group-hover:scale-110 transition-transform duration-300">📸</div>
                        <p class="text-[11px] font-black uppercase tracking-widest text-blue-300">Drop your photos here</p>
                    </div>
                </div>

                {{-- Preview Container --}}
                <div id="image-preview-container" class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-6 hidden">
                </div>
            </div>

            {{-- SECTION 2: VARIANTS --}}
            <div class="pt-10 border-t-4 border-blue-50">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                    <h3 class="text-xl font-black uppercase tracking-tighter text-gray-800 flex items-center gap-3">
                        Variant Mix <span class="text-2xl">🎨</span>
                    </h3>

                    <button type="button" onclick="addVariant()"
                        class="text-[10px] font-black uppercase tracking-widest bg-yellow-400 text-white px-6 py-3 rounded-full hover:bg-yellow-500 shadow-lg shadow-yellow-100 transition-all active:scale-95">
                        + Add New Row
                    </button>
                </div>

                {{-- Header Row for Variants --}}
                <div class="hidden md:grid grid-cols-12 gap-4 mb-4 px-6">
                    <div class="col-span-3 text-[10px] font-black uppercase text-blue-200 tracking-widest">Color</div>
                    <div class="col-span-2 text-[10px] font-black uppercase text-blue-200 tracking-widest">Size</div>
                    <div class="col-span-4 text-[10px] font-black uppercase text-blue-200 tracking-widest">Price (IDR)</div>
                    <div class="col-span-2 text-[10px] font-black uppercase text-blue-200 tracking-widest">Stock</div>
                    <div class="col-span-1"></div>
                </div>

                <div id="variant-wrapper" class="space-y-4">
                    {{-- Row --}}
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 variant-item bg-blue-50/20 p-4 md:p-0 md:bg-transparent rounded-2xl relative">
                        <div class="md:col-span-3">
                            <input name="variants[0][color]" placeholder="COLOR"
                                class="w-full bg-white border-2 border-blue-50 rounded-xl p-3 font-bold text-xs focus:border-blue-200 focus:outline-none uppercase">
                        </div>
                        <div class="md:col-span-2">
                            <input name="variants[0][size]" placeholder="SIZE"
                                class="w-full bg-white border-2 border-blue-50 rounded-xl p-3 font-bold text-xs focus:border-blue-200 focus:outline-none uppercase">
                        </div>
                        <div class="md:col-span-4">
                            <input name="variants[0][price]" placeholder="0" type="number"
                                class="w-full bg-white border-2 border-blue-50 rounded-xl p-3 font-bold text-xs focus:border-blue-200 focus:outline-none">
                        </div>
                        <div class="md:col-span-2">
                            <input name="variants[0][stock]" placeholder="0" type="number"
                                class="w-full bg-white border-2 border-blue-50 rounded-xl p-3 font-bold text-xs focus:border-blue-200 focus:outline-none">
                        </div>
                        <div class="md:col-span-1">
                            <button type="button" onclick="removeVariant(this)"
                                class="w-full h-full min-h-[40px] bg-red-50 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all font-black">
                                ✕
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SUBMIT AREA --}}
            <div class="pt-10">
                <button
                    class="w-full bg-pink-500 text-white py-6 rounded-[2.5rem] text-sm font-black uppercase tracking-[0.3em] hover:bg-pink-600 shadow-2xl shadow-pink-100 transition-all active:scale-[0.98] flex justify-center items-center gap-3 group relative overflow-hidden">
                    <div class="absolute inset-0 w-full h-full bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 skew-x-12"></div>
                    <span class="relative z-10">Confirm & Plant Product 🌱</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT TETAP SAMA NAMUN DENGAN TEMPLATE HTML YANG DISESUAIKAN --}}
<script>
    let variantIndex = 1;

    function addVariant() {
        const wrapper = document.getElementById('variant-wrapper');
        const html = `
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 variant-item bg-blue-50/20 p-4 md:p-0 md:bg-transparent rounded-2xl animate-fade-in">
        <div class="md:col-span-3">
            <input name="variants[${variantIndex}][color]" placeholder="COLOR" class="w-full bg-white border-2 border-blue-50 rounded-xl p-3 font-bold text-xs focus:border-blue-200 focus:outline-none uppercase">
        </div>
        <div class="md:col-span-2">
            <input name="variants[${variantIndex}][size]" placeholder="SIZE" class="w-full bg-white border-2 border-blue-50 rounded-xl p-3 font-bold text-xs focus:border-blue-200 focus:outline-none uppercase">
        </div>
        <div class="md:col-span-4">
            <input name="variants[${variantIndex}][price]" placeholder="0" type="number" class="w-full bg-white border-2 border-blue-50 rounded-xl p-3 font-bold text-xs focus:border-blue-200 focus:outline-none">
        </div>
        <div class="md:col-span-2">
            <input name="variants[${variantIndex}][stock]" placeholder="0" type="number" class="w-full bg-white border-2 border-blue-50 rounded-xl p-3 font-bold text-xs focus:border-blue-200 focus:outline-none">
        </div>
        <div class="md:col-span-1">
            <button type="button" onclick="removeVariant(this)" class="w-full h-full min-h-[40px] bg-red-50 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all font-black">✕</button>
        </div>
    </div>`;
        wrapper.insertAdjacentHTML('beforeend', html);
        variantIndex++;
    }

    function removeVariant(button) {
        button.closest('.variant-item').remove();
    }

    function previewImages(event) {
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = '';
        const files = event.target.files;

        if (files.length > 0) {
            previewContainer.classList.remove('hidden');
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const html = `
                <div class="bg-blue-50/50 rounded-2xl p-2 relative group animate-fade-in border-2 border-blue-50">
                    <div class="absolute top-2 right-2 bg-blue-500 text-white text-[7px] font-black px-2 py-1 rounded-full z-10 shadow-sm">
                        READY
                    </div>
                    <div class="aspect-square overflow-hidden rounded-xl border-2 border-white mb-2 shadow-sm">
                         <img src="${e.target.result}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <p class="text-[8px] font-black text-blue-300 truncate px-1 uppercase">${file.name}</p>
                </div>`;
                    previewContainer.insertAdjacentHTML('beforeend', html);
                }
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.classList.add('hidden');
        }
    }
</script>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
</style>
@endsection