<x-app-layout>
    <!-- Hero Section with improved mobile responsiveness -->
    <div class="relative min-h-[500px] md:h-[830px] overflow-hidden">
        <img 
            src="{{ asset('images/homee.jpeg') }}" 
            alt="DISDIKBUDPORA Office" 
            class="absolute w-full h-full object-cover"
            loading="lazy"
        >
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/40"></div>
        
        <div class="relative container mx-auto px-4 h-full flex flex-col justify-center items-center text-center">
            <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold text-white mb-4 animate-fade-in">
                Data Inventaris Aset
            </h1>
            <h2 class="text-xl sm:text-2xl md:text-4xl font-bold text-white animate-fade-in-delay">
                DISDIKBUDPORA
            </h2>
            <p class="mt-4 text-white/90 max-w-2xl mx-auto text-sm sm:text-base">
                Sistem informasi pengelolaan dan pemantauan inventaris aset secara efisien dan terintegrasi
            </p>
            
            <!-- Scroll Down Button -->
            <a href="#cards-section" 
               class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white cursor-pointer group animate-bounce">
                <div class="flex flex-col items-center">
                    <span class="text-sm mb-2">Scroll Down</span>
                    <svg 
                        class="w-6 h-6 group-hover:translate-y-1 transition-transform duration-300" 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24">
                        <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M19 14l-7 7m0 0l-7-7m7 7V3">
                        </path>
                    </svg>
                </div>
            </a>
        </div>
    </div>

    <!-- Cards Section with improved layout and accessibility -->
    <div id="cards-section" class="container mx-auto px-4 py-8 md:py-16 scroll-mt-16">
        <div class="grid md:grid-cols-2 gap-4 md:gap-8 max-w-7xl mx-auto">
            <a href="{{ route('tingkatan-sekolah') }}" class="block focus:outline-none focus:ring-2 focus:ring-[#FFB930] rounded-lg">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative h-48 md:h-56 overflow-hidden">
                        <img 
                            src="{{ asset('images/invenskola.jpg') }}" 
                            alt="Informasi Data Sekolah" 
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <div class="p-6 min-h-[250px] flex flex-col justify-between bg-white">
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-800">INFORMASI INVENTARIS DATA SEKOLAH</h3>
                            <p class="text-gray-600 mb-4 text-sm md:text-base">Akses dan kelola data inventaris sekolah dengan mudah dan efisien. Lihat informasi detail tentang aset dan inventaris di setiap sekolah.</p>
                        </div>
                        <div class="bg-[#FFB930] h-12 flex items-center justify-between px-4 -mx-6 -mb-6 group-hover:bg-[#FFE7C4] transition-colors duration-300">
                            <span class="text-sm font-medium">Lihat Detail</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="/data-barang" class="block focus:outline-none focus:ring-2 focus:ring-[#FFB930] rounded-lg">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative h-48 md:h-56 overflow-hidden">
                        <img 
                            src="{{ asset('images/invenbar.jpeg') }}" 
                            alt="Laporan Inventaris" 
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <div class="p-6 min-h-[250px] flex flex-col justify-between bg-white">
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold mb-4 text-gray-800">LAPORAN INVENTARIS BARANG</h3>
                            <p class="text-gray-600 mb-4 text-sm md:text-base">Pantau dan kelola inventaris barang dengan sistem pelaporan yang terstruktur. Dapatkan informasi real-time tentang status dan kondisi aset.</p>
                        </div>
                        <div class="bg-[#FFB930] h-12 flex items-center justify-between px-4 -mx-6 -mb-6 group-hover:bg-[#FFE7C4] transition-colors duration-300">
                            <span class="text-sm font-medium">Lihat Detail</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Styles -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fade-in-delay {
            animation: fadeIn 0.8s ease-out 0.2s forwards;
            opacity: 0;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</x-app-layout>