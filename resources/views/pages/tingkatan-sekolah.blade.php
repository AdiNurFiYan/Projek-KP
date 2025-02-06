<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-cover bg-center min-h-[256px]" style="background-image: url('/images/datasekolah.jpg');">
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/50"></div>
    <div class="absolute inset-0 flex flex-col items-center justify-center p-4">
        <h1 class="text-4xl md:text-6xl font-bold text-white uppercase tracking-wider text-center mb-4">DATA SEKOLAH</h1>
    </div>
</div>


    <!-- Content Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <!-- Grid Korwil -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($korwils as $korwil)
                <a href="{{ route('data-sekolah.list', $korwil) }}" class="block group">
                    <div class="relative overflow-hidden rounded-xl bg-white shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <!-- Image Container -->
                        <div class="aspect-square overflow-hidden">
                            <img 
                                src="{{ url($korwil->gambar) }}" 
                                alt="{{ $korwil->nama }}"
                                class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110"
                            >
                            <!-- Overlay gradien -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                      <!-- Title Container (Selalu Terlihat) -->
<div class="absolute bottom-0 left-0 right-0 bg-[#FFB930] p-3 md:p-4">
    <h3 class="text-center font-semibold text-white text-lg md:text-xl">
        {{ $korwil->nama }}
    </h3>
</div>


                        <!-- Hover Content (Muncul dari atas) -->
                        <div class="absolute inset-0 flex items-center justify-center bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <span class="text-white font-medium text-lg">Lihat Detail</span>
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>