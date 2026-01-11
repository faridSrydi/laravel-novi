@extends('layouts.admin')

@section('title', 'EDIT PRODUCT')

@section('content')
<div class="max-w-5xl mx-auto pb-20 relative">
    
    {{-- Decorative Butterfly --}}
    <div class="absolute -top-10 -right-4 text-5xl opacity-20 butterfly-float pointer-events-none">🦋</div>

    {{-- HEADER SECTION --}}
    <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b-4 border-pink-50 pb-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-3 py-1 bg-pink-100 text-pink-500 rounded-full text-[9px] font-black uppercase tracking-[0.2em]">Maintenance // Mode</span>
                <p class="font-mono text-[10px] text-gray-300">REF_ID: {{ strtoupper(substr(md5($product->id), 0, 8)) }}</p>
            </div>
            <h1 class="text-4xl font-black uppercase tracking-tighter text-gray-800 leading-none">
                Refine <span class="text-pink-500">Treat</span> ✨
            </h1>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-[10px] font-black uppercase tracking-widest text-gray-300 hover:text-pink-500 flex items-center gap-2 transition-all group">
            <span class="group-hover:-translate-x-1 transition-transform">←</span> Cancel & Escape
        </a>
    </div>

    {{-- MAIN FORM CONTAINER --}}
    <div class="bg-white rounded-[3rem] border-4 border-pink-50 p-10 shadow-2xl shadow-pink-100/30 relative overflow-hidden">
        
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.update', $product) }}" class="space-y-12 relative z-10">
            @csrf
            @method('PUT')

            {{-- SECTION 1: GENERAL INFO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Product Name --}}
                <div class="space-y-3">
                    <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-pink-300 ml-2">
                        <span class="w-1.5 h-1.5 bg-pink-400 rounded-full"></span> Name of Delight
                    </label>
                    <input name="name" value="{{ $product->name }}"
                        class="w-full bg-pink-50/30 border-2 border-pink-50 rounded-2xl p-4 font-bold text-gray-700 focus:outline-none focus:border-pink-200 focus:bg-white transition-all">
                </div>

                {{-- Category --}}
                <div class="space-y-3">
                    <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-pink-300 ml-2">
                        <span class="w-1.5 h-1.5 bg-pink-400 rounded-full"></span> Category
                    </label>
                    <div class="relative">
                        <select name="category_id"
                            class="w-full bg-pink-50/30 border-2 border-pink-50 rounded-2xl p-4 font-bold text-gray-700 appearance-none focus:outline-none focus:border-pink-200 focus:bg-white cursor-pointer transition-all">
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}" @selected($product->category_id == $c->id)>
                                    {{ strtoupper($c->name) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-pink-200">▼</div>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="space-y-3">
                <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-pink-300 ml-2">
                    <span class="w-1.5 h-1.5 bg-pink-400 rounded-full"></span> Updated Story
                </label>
                <textarea name="description" rows="3"
                    class="w-full bg-pink-50/30 border-2 border-pink-50 rounded-[2rem] p-6 font-bold text-gray-700 focus:outline-none focus:border-pink-200 focus:bg-white transition-all resize-none">{{ $product->description }}</textarea>
            </div>

            {{-- SECTION 2: IMAGE MANAGEMENT --}}
            <div class="space-y-6">
                <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.2em] text-pink-300 ml-2">
                    <span class="w-1.5 h-1.5 bg-pink-400 rounded-full"></span> Visual Assets
                </label>
                
                <div class="bg-pink-50/20 rounded-[2.5rem] p-8 border-2 border-dashed border-pink-100">
                    {{-- Existing Images --}}
                    @if($product->images->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        @foreach($product->images as $img)
                            <div class="relative group aspect-square rounded-2xl overflow-hidden border-4 border-white shadow-sm">
                                <img src="{{ asset('storage/'.$img->image) }}" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                                
                                {{-- Mark Delete Overlay --}}
                                <label class="absolute inset-0 bg-red-500/80 opacity-0 group-hover:opacity-100 transition-all flex flex-col items-center justify-center cursor-pointer backdrop-blur-sm">
                                    <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" class="w-6 h-6 rounded-full border-2 border-white accent-white mb-2">
                                    <span class="text-[9px] font-black text-white uppercase tracking-tighter">Discard</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @endif

                    {{-- Upload New --}}
                    <div class="relative group bg-white rounded-2xl p-6 text-center border-2 border-dashed border-pink-200 hover:border-pink-400 transition-all cursor-pointer">
                        <input type="file" name="images[]" id="imageInput" multiple onchange="previewImages(event)" 
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="space-y-1 pointer-events-none">
                            <span class="text-2xl">📸</span>
                            <p class="text-[10px] font-black uppercase text-pink-300 tracking-widest">+ Add New Snapshots</p>
                        </div>
                    </div>

                    {{-- New Preview Container --}}
                    <div id="image-preview-container" class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-6 hidden"></div>
                </div>
            </div>

            {{-- SECTION 3: VARIANTS --}}
            <div class="pt-10 border-t-4 border-pink-50">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-black uppercase tracking-tighter text-gray-800 flex items-center gap-3">
                        Variant Mix <span class="text-2xl">🍭</span>
                    </h3>
                    <button type="button" onclick="addVariant()" class="text-[10px] font-black uppercase tracking-widest bg-yellow-400 text-white px-6 py-3 rounded-full hover:bg-yellow-500 shadow-lg shadow-yellow-100 transition-all active:scale-95">
                        + Add Row
                    </button>
                </div>

                <div id="variant-wrapper" class="space-y-4">
                    @foreach($product->variants as $i => $v)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 variant-item bg-pink-50/20 md:bg-transparent p-4 md:p-0 rounded-2xl group animate-fade-in">
                        <div class="md:col-span-3">
                            <input name="variants[{{ $i }}][color]" value="{{ $v->color }}" class="w-full bg-white border-2 border-pink-50 rounded-xl p-3 font-bold text-xs focus:border-pink-200 focus:outline-none uppercase">
                        </div>
                        <div class="md:col-span-2">
                            <input name="variants[{{ $i }}][size]" value="{{ $v->size }}" class="w-full bg-white border-2 border-pink-50 rounded-xl p-3 font-bold text-xs focus:border-pink-200 focus:outline-none uppercase">
                        </div>
                        <div class="md:col-span-4">
                            <input name="variants[{{ $i }}][price]" value="{{ $v->price }}" class="w-full bg-white border-2 border-pink-50 rounded-xl p-3 font-bold text-xs focus:border-pink-200 focus:outline-none">
                        </div>
                        <div class="md:col-span-2">
                            <input name="variants[{{ $i }}][stock]" value="{{ $v->stock }}" class="w-full bg-white border-2 border-pink-50 rounded-xl p-3 font-bold text-xs focus:border-pink-200 focus:outline-none">
                        </div>
                        <div class="md:col-span-1">
                            <button type="button" onclick="removeVariant(this)" class="w-full h-full min-h-[40px] bg-red-50 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all font-black">✕</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- SUBMIT --}}
            <div class="pt-10">
                <button class="w-full bg-pink-500 text-white py-6 rounded-[2.5rem] text-sm font-black uppercase tracking-[0.3em] hover:bg-pink-600 shadow-2xl shadow-pink-100 transition-all active:scale-[0.98] flex justify-center items-center gap-3 group overflow-hidden relative">
                    <div class="absolute inset-0 w-full h-full bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 skew-x-12"></div>
                    <span class="relative z-10">Save Transformations ✨</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
let variantIndex = {{ $product->variants->count() }};

function addVariant() {
    const wrapper = document.getElementById('variant-wrapper');
    const html = `
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 variant-item bg-pink-50/20 md:bg-transparent p-4 md:p-0 rounded-2xl animate-fade-in">
            <div class="md:col-span-3">
                <input name="variants[${variantIndex}][color]" placeholder="NEW" class="w-full bg-white border-2 border-pink-50 rounded-xl p-3 font-bold text-xs focus:border-pink-200 focus:outline-none uppercase">
            </div>
            <div class="md:col-span-2">
                <input name="variants[${variantIndex}][size]" placeholder="NEW" class="w-full bg-white border-2 border-pink-50 rounded-xl p-3 font-bold text-xs focus:border-pink-200 focus:outline-none uppercase">
            </div>
            <div class="md:col-span-4">
                <input name="variants[${variantIndex}][price]" placeholder="0" class="w-full bg-white border-2 border-pink-50 rounded-xl p-3 font-bold text-xs focus:border-pink-200 focus:outline-none">
            </div>
            <div class="md:col-span-2">
                <input name="variants[${variantIndex}][stock]" placeholder="0" class="w-full bg-white border-2 border-pink-50 rounded-xl p-3 font-bold text-xs focus:border-pink-200 focus:outline-none">
            </div>
            <div class="md:col-span-1">
                <button type="button" onclick="removeVariant(this)" class="w-full h-full min-h-[40px] bg-red-50 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all font-black">✕</button>
            </div>
        </div>`;
    wrapper.insertAdjacentHTML('beforeend', html);
    variantIndex++;
}

function removeVariant(btn) {
    btn.closest('.variant-item').remove();
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
                    <div class="bg-pink-50 rounded-2xl p-2 relative group animate-fade-in">
                        <div class="aspect-square overflow-hidden rounded-xl border-2 border-white shadow-sm">
                             <img src="${e.target.result}" class="w-full h-full object-cover">
                        </div>
                        <p class="text-[7px] font-black text-pink-400 text-center uppercase mt-1 truncate px-1">New Upload</p>
                    </div>`;
                previewContainer.insertAdjacentHTML('beforeend', html);
            }
            reader.readAsDataURL(file);
        });
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