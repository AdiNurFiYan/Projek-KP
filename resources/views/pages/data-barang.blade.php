<x-app-layout>
    <!-- Hero Header Section with enhanced overlay and animation -->
    <div class="relative bg-cover bg-center min-h-[300px]" style="background-image: url('/images/databarang.jpg');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-black/70"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white uppercase tracking-wider mb-4">
                Data Barang
            </h1>
            <div class="h-1 w-24 bg-blue-500 rounded-full"></div>
        </div>
    </div>

    <!-- Content Section with improved spacing and container -->
    <div class="container mx-auto px-4 py-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <!-- Grid Layout with responsive design -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($kibTypes as $kibType)
                    <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                        <!-- Image Container with overlay -->
                        <div class="relative overflow-hidden rounded-t-xl">
                            <img src="{{ asset($kibType->gambar) ?? asset('images/default-kib.png') }}"
                                 alt="{{ $kibType->nama }}"
                                 class="w-full aspect-video object-cover transform group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        <!-- Content Container -->
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $kibType->nama }}
                            </h2>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3">
                                {{ Str::limit($kibType->deskripsi, 150) }}
                            </p>
                            
                            <!-- Button with enhanced hover effect -->
                            <a href="{{ route('data-barang.show', ['kibType' => $kibType->id]) }}" 
                               class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-lg 
                                      hover:bg-blue-700 transition-all duration-300 shadow-sm hover:shadow-md
                                      focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <span>Lihat Detail</span>
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" 
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2" 
                                          d="M15 12H3m12 0l-6-6m6 6l-6 6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- Enhanced empty state -->
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <div class="text-center py-16 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="w-16 h-16 mx-auto text-gray-400"
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2" 
                                          d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum ada data barang</h3>
                            <p class="text-gray-600">Data barang yang ditambahkan akan muncul di sini</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>