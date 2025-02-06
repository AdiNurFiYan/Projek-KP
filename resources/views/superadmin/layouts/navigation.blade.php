<!-- Background untuk layar kecil -->
<div class="fixed left-0 top-0 h-screen w-20 bg-red-800 border-r border-b border-[#2D2D2D] -z-10 md:w-60"></div>

<!-- Sidebar -->
<nav id="sidebar" class="fixed left-0 top-0 h-screen w-60 bg-red-800 text-white transition-transform duration-300 ease-in-out transform md:translate-x-0 -translate-x-full z-50 border-r border-b border-[#2D2D2D] overflow-y-auto">
    <!-- Header Sidebar -->
    <div class="flex items-center justify-between p-4 border-b border-[#2D2D2D]">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto" alt="Logo" />
            <div class="text-xl font-bold">DIASTRA</div>
        </div>
        <button id="closeSidebar" class="md:hidden text-white hover:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    
    <!-- Menu Sidebar -->
    <div class="py-4 flex flex-col h-[calc(100vh-144px)]"> <!-- 144px = header height + footer height -->
        <div class="space-y-1">
            <a href="{{ route('super-admin.dashboard') }}" 
               class="block px-4 py-2.5 transition-colors duration-200 {{ request()->routeIs('super-admin.dashboard') ? 'bg-white/10' : 'hover:bg-white/5' }} flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('super-admin.tingkatan') }}" 
               class="block px-4 py-2.5 transition-colors duration-200 {{ request()->routeIs('super-admin.tingkatan') ? 'bg-white/10' : 'hover:bg-white/5' }} flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                Data Sekolah
            </a>
            <a href="{{ route('super-admin.barang') }}" 
               class="block px-4 py-2.5 transition-colors duration-200 {{ request()->routeIs('super-admin.barang') ? 'bg-white/10' : 'hover:bg-white/5' }} flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Data Barang
            </a>
            <a href="{{ route('super-admin.akun') }}" 
               class="block px-4 py-2.5 transition-colors duration-200 {{ request()->routeIs('super-admin.akun') ? 'bg-white/10' : 'hover:bg-white/5' }} flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Akun
            </a>
        </div>
    </div>
    
    <!-- Footer Sidebar with Logout -->
    <div class="absolute bottom-0 left-0 w-full border-t border-[#2D2D2D] bg-red-800">
        <form method="POST" action="{{ route('super-admin.logout') }}" class="p-4">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2.5 rounded transition-colors duration-200 hover:bg-white/5 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Log Out
            </button>
        </form>
    </div>
</nav>

<!-- Mobile Header -->
<div class="fixed top-0 left-0 right-0 h-16 bg-red-800 flex items-center md:hidden z-40 border-b border-[#2D2D2D]">
    <button id="openSidebar" class="text-white p-4 hover:text-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
    <span class="text-white text-xl font-bold ml-4">DIASTRA</span>
</div>

<!-- Script untuk sidebar mobile -->
<script>
    document.getElementById('openSidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.remove('-translate-x-full');
    });

    document.getElementById('closeSidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
    });

    // Menutup sidebar ketika mengklik di luar sidebar (opsional)
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const openButton = document.getElementById('openSidebar');
        
        if (!sidebar.contains(event.target) && !openButton.contains(event.target)) {
            sidebar.classList.add('-translate-x-full');
        }
    });
</script>
