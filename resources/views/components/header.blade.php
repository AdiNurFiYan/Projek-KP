<div class="fixed top-0 w-full bg-[#E40004] shadow-md z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
    <div class="flex items-center space-x-2">
    <a href="/" class="flex items-center space-x-2 hover:opacity-90 transition-opacity duration-300">
        <img src="{{ asset('images/Kab.Semarang.png') }}" alt="DIASTRA Logo" class="max-h-16 max-w-full object-contain">
        <span class="text-white text-xl md:text-2xl font-inter font-bold">DIASTRA</span>
    </a>
</div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden text-white hover:bg-[#FF1515] p-2 rounded transition-colors duration-300" aria-label="Toggle menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-4">
            <a href="/" 
               class="text-white px-4 py-2 rounded transition duration-300 text-base {{ request()->is('/') ? 'bg-[#FFB930]' : 'hover:bg-[#FF1515]' }}"
               @if(request()->is('/')) aria-current="page" @endif>
               Home
            </a>
            <a href="{{ route('tingkatan-sekolah') }}" 
               class="text-white px-4 py-2 rounded transition duration-300 text-base {{ request()->routeIs('tingkatan-sekolah') ? 'bg-[#FFB930]' : 'hover:bg-[#FF1515]' }}"
               @if(request()->routeIs('tingkatan-sekolah')) aria-current="page" @endif>
               Data Sekolah
            </a>
            <a href="/data-barang" 
               class="text-white px-4 py-2 rounded transition duration-300 text-base {{ request()->is('data-barang') ? 'bg-[#FFB930]' : 'hover:bg-[#FF1515]' }}"
               @if(request()->is('data-barang')) aria-current="page" @endif>
               Data Barang
            </a>
        </nav>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="hidden md:hidden absolute w-full">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-[#E40004] shadow-lg">
            <a href="/" 
               class="text-white block px-3 py-2 rounded-md text-base transition duration-300 {{ request()->is('/') ? 'bg-[#FFB930]' : 'hover:bg-[#FF1515]' }}"
               @if(request()->is('/')) aria-current="page" @endif>
               Home
            </a>
            <a href="{{ route('tingkatan-sekolah') }}" 
               class="text-white block px-3 py-2 rounded-md text-base transition duration-300 {{ request()->routeIs('tingkatan-sekolah') ? 'bg-[#FFB930]' : 'hover:bg-[#FF1515]' }}"
               @if(request()->routeIs('tingkatan-sekolah')) aria-current="page" @endif>
               Data Sekolah
            </a>
            <a href="/data-barang" 
               class="text-white block px-3 py-2 rounded-md text-base transition duration-300 {{ request()->is('data-barang') ? 'bg-[#FFB930]' : 'hover:bg-[#FF1515]' }}"
               @if(request()->is('data-barang')) aria-current="page" @endif>
               Data Barang
            </a>
        </div>
    </div>
</div>

<!-- Spacer untuk kompensasi fixed header -->
<div class="h-[88px]"></div>

<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        
        if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        if (window.innerWidth >= 768) {
            mobileMenu.classList.add('hidden');
        }
    });

    // Smooth scroll untuk anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>