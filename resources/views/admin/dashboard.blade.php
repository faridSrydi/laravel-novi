@extends('layouts.admin')

@section('title', 'OVERVIEW')

@section('content')
    {{-- STATS GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        
        {{-- Card 1: Total Sales --}}
        <div class="bg-white p-6 rounded-[2.5rem] border-4 border-pink-50 shadow-xl shadow-pink-100/20 hover:scale-[1.02] transition-transform group relative overflow-hidden">
            <span class="absolute -top-2 -right-2 text-6xl text-pink-50 font-black group-hover:text-pink-100/50 transition-colors">🦋</span>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-pink-300 mb-4 relative z-10">Total Sales</p>
            <div class="flex flex-col relative z-10">
                <span class="text-xs font-bold text-gray-400 mb-1">IDR CURRENCY</span>
                <span class="text-4xl font-black tracking-tight text-gray-800">45.2<span class="text-pink-500 text-2xl">M</span></span>
            </div>
        </div>

        {{-- Card 2: SKU --}}
        <div class="bg-white p-6 rounded-[2.5rem] border-4 border-blue-50 shadow-xl shadow-blue-100/20 hover:scale-[1.02] transition-transform group relative overflow-hidden">
            <span class="absolute -top-2 -right-2 text-6xl text-blue-50 font-black group-hover:text-blue-100/50 transition-colors">✨</span>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-300 mb-4 relative z-10">Product SKU</p>
            <div class="flex flex-col relative z-10">
                <span class="text-xs font-bold text-gray-400 mb-1">ACTIVE ITEMS</span>
                <span class="text-4xl font-black tracking-tight text-gray-800">2,340</span>
            </div>
        </div>

        {{-- Card 3: Orders --}}
        <div class="bg-white p-6 rounded-[2.5rem] border-4 border-yellow-50 shadow-xl shadow-yellow-100/20 hover:scale-[1.02] transition-transform group relative overflow-hidden">
            <span class="absolute -top-2 -right-2 text-6xl text-yellow-50 font-black group-hover:text-yellow-100/50 transition-colors">🍭</span>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-yellow-400 mb-4 relative z-10">Orders</p>
            <div class="flex flex-col relative z-10">
                <span class="text-xs font-bold text-gray-400 mb-1">PENDING PROC.</span>
                <span class="text-4xl font-black tracking-tight text-pink-500">12</span>
            </div>
        </div>

        {{-- Card 4: Quick Action --}}
         <div class="bg-pink-500 p-6 rounded-[2.5rem] text-white flex flex-col justify-between group cursor-pointer hover:bg-pink-600 shadow-xl shadow-pink-200 transition-all active:scale-95 relative overflow-hidden">
            <div class="absolute -bottom-4 -right-4 text-7xl opacity-20 group-hover:rotate-12 transition-transform">🦋</div>
            <div class="flex justify-between items-start relative z-10">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Quick Action</p>
                <div class="bg-white/20 p-2 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                </div>
            </div>
            <div class="relative z-10 mt-4">
                <p class="text-xl font-black uppercase leading-tight">Add New<br>Product ✨</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        {{-- LEFT COLUMN: RECENT PRODUCTS --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between px-2">
                <div>
                    <h3 class="text-2xl font-black uppercase tracking-tighter text-gray-800">Recent Products 🛍️</h3>
                    <div class="h-1.5 w-12 bg-pink-200 rounded-full mt-1"></div>
                </div>
                <a href="#" class="text-xs font-black uppercase tracking-widest text-pink-500 hover:text-pink-600 bg-pink-50 px-4 py-2 rounded-full transition-colors">View All</a>
            </div>

            <div class="space-y-4">
                @for($i = 1; $i <= 3; $i++)
                <div class="flex items-center gap-6 p-5 rounded-[2rem] border-2 border-pink-50 bg-white hover:border-pink-200 hover:shadow-lg hover:shadow-pink-100/50 transition-all duration-300 group">
                    <div class="w-20 h-20 bg-pink-50 rounded-[1.5rem] flex items-center justify-center border-2 border-dashed border-pink-200 group-hover:rotate-3 transition-transform">
                        <span class="text-2xl">🧸</span>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-2 py-0.5 bg-yellow-400 text-pink-800 text-[9px] font-black rounded-full uppercase tracking-tighter">NEW ARRIVAL</span>
                            <span class="text-[10px] font-bold text-gray-300 tracking-widest">#892{{$i}}</span>
                        </div>
                        <h4 class="font-black text-lg leading-none uppercase text-gray-800 group-hover:text-pink-500 transition-colors">Cotton Candy Hoodie</h4>
                        <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-tighter">Kids / Tops / Sweetwear</p>
                    </div>

                    <div class="text-right">
                        <p class="text-lg font-black text-gray-800">Rp 199k</p>
                        <p class="text-[10px] text-green-400 font-black uppercase bg-green-50 px-2 py-0.5 rounded-full inline-block mt-1">Ready: 45</p>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        {{-- RIGHT COLUMN: LOGS & STORAGE --}}
        <div class="space-y-8">
            {{-- System Log --}}
            <div class="rounded-[2.5rem] border-4 border-pink-50 p-8 bg-white relative overflow-hidden">
                <div class="absolute -top-2 -right-2 text-4xl opacity-10">🦋</div>
                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-pink-300 mb-8 flex items-center gap-2">
                    <span class="w-2 h-2 bg-pink-400 rounded-full"></span> System Log
                </h3>
                
                <ul class="space-y-6 relative">
                    <div class="absolute left-[7px] top-2 bottom-2 w-[2px] bg-pink-50"></div>

                    <li class="pl-8 relative">
                        <div class="absolute left-0 top-1.5 w-4 h-4 rounded-full bg-white border-4 border-pink-400 z-10"></div>
                        <p class="text-[10px] font-black text-pink-200 uppercase">10:42 AM</p>
                        <p class="text-sm font-bold text-gray-700 leading-tight">Category Updated ✨</p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">By Mimin Lucu</p>
                    </li>
                    <li class="pl-8 relative opacity-60">
                        <div class="absolute left-0 top-1.5 w-4 h-4 rounded-full bg-white border-4 border-blue-200 z-10"></div>
                        <p class="text-[10px] font-black text-blue-200 uppercase">09:15 AM</p>
                        <p class="text-sm font-bold text-gray-700 leading-tight">New Order #9921 🍭</p>
                    </li>
                </ul>

                <button class="w-full mt-8 bg-gray-50 text-gray-400 py-4 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-pink-50 hover:text-pink-500 transition-all">
                    Full History →
                </button>
            </div>

            {{-- Storage --}}
            <div class="bg-blue-500 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-xl shadow-blue-100">
                 <div class="absolute -top-4 -left-4 text-6xl opacity-10">☁️</div>
                 <h3 class="text-[10px] font-black uppercase tracking-widest opacity-70 mb-4">Storage Usage</h3>
                 <div class="flex items-end gap-2 mb-3">
                     <span class="text-5xl font-black">42<span class="text-2xl opacity-50">%</span></span>
                     <span class="text-[10px] font-bold uppercase mb-1.5 opacity-70">Filled</span>
                 </div>
                 <div class="w-full h-3 bg-white/20 rounded-full mt-2 p-0.5 border border-white/10">
                     <div class="h-full bg-yellow-400 rounded-full shadow-sm shadow-yellow-400/50" style="width: 42%"></div>
                 </div>
                 <p class="text-[9px] font-bold mt-4 opacity-60 uppercase tracking-widest text-center">Cloud server: Sweet-01</p>
            </div>
        </div>

    </div>
@endsection