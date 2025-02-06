<div class="w-full bg-[#E40004] shadow-md">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/Kab.Semarang.png') }}" alt="DIASTRA Logo" class="max-h-16 max-w-full object-contain">
            <span class="text-white text-xl md:text-2xl font-inter font-bold">DIASTRA</span>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Desktop Navigation -->
<nav class="hidden md:flex items-center space-x-4">
   <a href="/" class="text-white hover:bg-[#FFB930] px-4 py-2 rounded transition duration-300 text-base">Home</a>
   <a href="{{ route('tingkatan-sekolah') }}" class="text-white hover:bg-[#FFB930] px-4 py-2 rounded transition duration-300 text-base">Data Sekolah</a>
   <a href="/data-barang" class="text-white hover:bg-[#FFB930] px-4 py-2 rounded transition duration-300 text-base">Data Barang</a>
</nav>
    </div>

    <!-- Mobile Navigation Menu -->
<div id="mobile-menu" class="hidden md:hidden">
   <div class="px-2 pt-2 pb-3 space-y-1 bg-[#E40004] shadow-lg">
       <a href="/" class="text-white hover:bg-[#FFB930] block px-3 py-2 rounded-md text-base">Home</a>
       <a href="{{ route('tingkatan-sekolah') }}" class="text-white hover:bg-[#FFB930] block px-3 py-2 rounded-md text-base">Data Sekolah</a>
       <a href="/data-barang" class="text-white hover:bg-[#FFB930] block px-3 py-2 rounded-md text-base">Data Barang</a>
   </div>
</div>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });

        window.addEventListener('resize', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            if (window.innerWidth >= 768) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</div>