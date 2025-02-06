
<div class="fixed left-0 top-0 h-screen w-20 bg-red-800 border-r border-b border-[#2D2D2D] -z-10"></div>

<!-- Sidebar -->
<nav id="sidebar" class="fixed left-0 top-0 h-screen w-60 bg-red-800 text-white transition-transform duration-300 ease-in-out transform md:translate-x-0 -translate-x-full z-50 border-r border-b border-[#2D2D2D]">
   <div class="flex items-center justify-between p-4 border-b border-[#2D2D2D]">
       <div class="flex items-center space-x-3">
           <img src="path/to/your/logo.png" class="h-8 w-auto" alt="Logo" />
           <div class="text-xl font-bold">DIASTRA</div>
       </div>
       <button id="closeSidebar" class="md:hidden text-white">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
           </svg>
       </button>
   </div>
   
<!-- Menu Sidebar -->
<div class="py-4 flex flex-col h-[calc(100vh-144px)]">
    <div class="space-y-1">
        <!-- Dashboard with Chart icon -->
        <a href="{{ route('admin.dashboard') }}" 
           class="block px-4 py-2.5 transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10' : 'hover:bg-white/5' }} flex items-center">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            Dashboard
        </a>

        <!-- School Data with Building icon -->
        <a href="{{ route('admin.tingkatan') }}" 
           class="block px-4 py-2.5 transition-colors duration-200 {{ request()->routeIs('admin.tingkatan') ? 'bg-white/10' : 'hover:bg-white/5' }} flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            Data Sekolah
        </a>

        <!-- Items Data with Box icon -->
        <a href="{{ route('admin.barang') }}" 
           class="block px-4 py-2.5 transition-colors duration-200 {{ request()->routeIs('admin.barang') ? 'bg-white/10' : 'hover:bg-white/5' }} flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Data Barang
        </a>
    </div>
</div>
   
   <div class="absolute bottom-0 w-full p-4 border-t border-[#2D2D2D]">
       <form method="POST" action="{{ route('admin.logout') }}">
           @csrf
           <button type="submit" class="w-full text-left px-4 py-2 hover:bg-white/10">
               Log Out
           </button>
       </form>
   </div>
</nav>

<!-- Mobile Header -->
<div class="fixed top-0 left-0 right-0 h-16 bg-red-800 flex items-center md:hidden z-40 border-b border-[#2D2D2D]">
   <button id="openSidebar" class="text-white p-4">
       <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
       </svg>
   </button>
   <span class="text-white text-xl font-bold ml-4">DIASTRA</span>
</div>