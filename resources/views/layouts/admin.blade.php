<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - MINIMOO ADMIN 🦋</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Quicksand:wght@500;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        .title-font {
            font-family: 'Quicksand', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #fdf2f8;
        }

        ::-webkit-scrollbar-thumb {
            background: #f9a8d4;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ec4899;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(5deg);
            }
        }

        .butterfly-float {
            animation: float 4s ease-in-out infinite;
        }

        .active-nav {
            background-color: #ec4899 !important;
            color: white !important;
            box-shadow: 0 10px 15px -3px rgba(236, 72, 153, 0.3);
        }

        /* Transition Sidebar */
        .sidebar-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Logika Teks Menu: Hanya sembunyikan di Desktop jika class collapsed aktif */
        @media (min-width: 768px) {
            .is-collapsed .sidebar-text {
                display: none;
            }
        }
    </style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#FFF9FB] text-gray-800 antialiased min-h-screen relative">

    <div id="sidebarOverlay"
        class="fixed inset-0 bg-pink-900/20 backdrop-blur-sm z-40 hidden transition-opacity duration-300"></div>

    <aside id="mainSidebar"
        class="sidebar-transition fixed top-0 left-0 h-full bg-white z-50 shadow-2xl border-r-4 border-pink-100 flex flex-col
              w-72 -translate-x-full md:translate-x-0 md:w-72">

        <div class="h-24 flex items-center justify-between px-6 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-pink-500 rounded-2xl flex items-center justify-center text-white text-xl shadow-lg shadow-pink-200 shrink-0">
                    🦋</div>
                <span
                    class="font-black tracking-tight text-gray-800 text-lg uppercase sidebar-text whitespace-nowrap">Lara<span
                        class="text-pink-500">clo</span></span>
            </div>
            <button onclick="toggleSidebar()"
                class="md:hidden w-8 h-8 flex items-center justify-center bg-pink-50 rounded-full text-pink-500 font-bold">&times;</button>
        </div>

        <div class="flex flex-col p-4 gap-3 flex-grow overflow-y-auto overflow-x-hidden">
            <a href="{{ route('admin.dashboard') }}"
                class="px-5 py-4 text-sm font-black rounded-2xl transition-all flex items-center gap-4 group
           {{ request()->routeIs('admin.dashboard') ? 'active-nav' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-500' }}">
                <span class="text-xl shrink-0">🏠</span>
                <span class="sidebar-text whitespace-nowrap">Dashboard</span>
            </a>

            <a href="{{ route('admin.categories.index') }}"
                class="px-5 py-4 text-sm font-black rounded-2xl transition-all flex items-center gap-4 group
           {{ request()->routeIs('admin.categories*') ? 'active-nav' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-500' }}">
                <span class="text-xl shrink-0">🍭</span>
                <span class="sidebar-text whitespace-nowrap">Categories</span>
            </a>

            <a href="{{ route('admin.products.index') }}"
                class="px-5 py-4 text-sm font-black rounded-2xl transition-all flex items-center gap-4 group
           {{ request()->routeIs('admin.products*') ? 'active-nav' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-500' }}">
                <span class="text-xl shrink-0">🎁</span>
                <span class="sidebar-text whitespace-nowrap">Products</span>
            </a>

            <div class="mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full text-left px-5 py-4 text-sm font-black text-red-300 hover:bg-red-50 hover:text-red-500 rounded-2xl transition-all flex items-center gap-4">
                        <span class="text-xl shrink-0">🚪</span>
                        <span class="sidebar-text whitespace-nowrap">Sayonara!</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div id="mainContent" class="sidebar-transition min-h-screen flex flex-col md:ml-72">

        <nav class="bg-white/70 backdrop-blur-md sticky top-0 z-30 border-b-2 border-pink-50">
            <div class="mx-auto px-4 lg:px-8 h-20 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()"
                        class="w-12 h-12 flex items-center justify-center bg-pink-100 text-pink-500 rounded-2xl hover:bg-pink-200 transition-colors shrink-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>

                    <div class="hidden sm:block">
                        <h1 class="font-black text-gray-800 leading-none tracking-tight uppercase">MINIMOO <span
                                class="text-pink-500">GARDEN</span></h1>
                        <p class="text-[10px] font-bold text-pink-300 uppercase tracking-[0.2em] mt-1">Admin Sweet
                            Control</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 md:gap-6">
                    <div class="hidden md:block text-right">
                        <p class="text-[9px] font-black text-pink-300 uppercase tracking-widest">Active Admin</p>
                        <p class="text-sm font-bold text-gray-700 capitalize">Novi Cantik ✨</p>
                    </div>
                    <div
                        class="w-10 h-10 bg-pink-100 rounded-full border-2 border-white flex items-center justify-center text-pink-500 font-bold shrink-0">
                        Novi Cantik
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow w-full px-4 lg:px-8 py-10 relative">
            <div class="fixed top-40 right-10 opacity-10 pointer-events-none butterfly-float">🦋</div>
            <div class="fixed bottom-20 left-80 opacity-5 pointer-events-none butterfly-float"
                style="animation-delay: 2s">🦋</div>

            <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="relative">
                    <div class="flex items-center gap-3 mb-3">
                        <span
                            class="px-3 py-1 bg-pink-100 text-pink-500 text-[10px] font-black rounded-full uppercase tracking-widest">Sweet
                            Panel</span>
                        <span class="w-12 h-1 bg-pink-100 rounded-full"></span>
                    </div>
                    <h2 class="text-4xl md:text-6xl font-black text-gray-800 tracking-tighter uppercase">
                        @yield('title')
                    </h2>
                </div>
                <div class="flex gap-3">
                    @yield('actions')
                </div>
            </div>

            <div
                class="bg-white/80 backdrop-blur-sm rounded-[3rem] border-4 border-pink-50 shadow-2xl shadow-pink-100/30 p-8 relative min-h-[500px]">
                @yield('content')
            </div>
        </main>

        <footer class="py-10 px-4 text-center">
            <p class="text-[11px] font-black text-pink-200 uppercase tracking-[0.4em]">
                Handcrafted with love & candies &bull; MiniMOO v2.4
            </p>
        </footer>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            const content = document.getElementById('mainContent');
            const overlay = document.getElementById('sidebarOverlay');
            const isMobile = window.innerWidth < 768;

            if (isMobile) {
                // HP: Geser sidebar masuk/keluar & tampilkan overlay
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
                // Pastikan di mobile teks selalu muncul (hapus class collapse jika ada)
                sidebar.classList.remove('is-collapsed');
            } else {
                // Desktop: Ciutkan lebar & sembunyikan teks lewat CSS
                if (sidebar.classList.contains('md:w-72')) {
                    sidebar.classList.replace('md:w-72', 'md:w-24');
                    content.classList.replace('md:ml-72', 'md:ml-24');
                    sidebar.classList.add('is-collapsed');
                } else {
                    sidebar.classList.replace('md:w-24', 'md:w-72');
                    content.classList.replace('md:ml-24', 'md:ml-72');
                    sidebar.classList.remove('is-collapsed');
                }
            }
        }

        // Klik overlay di HP otomatis tutup sidebar
        document.getElementById('sidebarOverlay').addEventListener('click', toggleSidebar);
    </script>

</body>

</html>
