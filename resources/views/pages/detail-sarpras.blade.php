<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl p-6 border border-gray-100">
            <div class="flex items-center mb-6 pb-4 border-b border-gray-200">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-800">Detail Sarana Prasarana</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Bagian Foto -->
                <div class="space-y-6">
                    <!-- Foto Utama -->
                    <div id="mainImageContainer" class="relative rounded-xl overflow-hidden bg-gray-50 shadow-md">
                        @if(isset($detailSarpras->foto) && is_array($detailSarpras->foto) && count($detailSarpras->foto) > 0)
                            <img src="{{ asset('storage/' . $detailSarpras->foto[0]) }}" 
                                 alt="Foto Utama" 
                                 id="mainImage"
                                 class="w-full h-auto max-h-[480px] object-contain p-2"
                                 onload="adjustImageContainer(this)"/>
                        @else
                            <div class="w-full h-64 bg-gray-100 flex items-center justify-center rounded-xl">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-gray-500 font-medium">Tidak ada foto</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Foto -->
                    @if(isset($detailSarpras->foto) && is_array($detailSarpras->foto) && count($detailSarpras->foto) > 0)
                        <div class="grid grid-cols-3 gap-3">
                            @foreach($detailSarpras->foto as $index => $foto)
                                <div class="relative aspect-square rounded-xl overflow-hidden cursor-pointer 
                                          shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-200"
                                     onclick="changeMainImage('{{ asset('storage/' . $foto) }}')">
                                    <img src="{{ asset('storage/' . $foto) }}" 
                                         alt="Thumbnail {{ $index + 1 }}" 
                                         class="w-full h-full object-cover hover:opacity-75 transition-opacity duration-200"/>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Informasi Detail -->
                <div class="bg-gray-50 rounded-xl p-6 space-y-6">
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Jenis Ruang</h3>
                        <p class="text-xl font-semibold text-gray-900">
                            {{ ucwords(str_replace('_', ' ', $detailSarpras->jenis_ruang ?? 'Tidak ada data')) }}
                        </p>
                    </div>
                    
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Luas</h3>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                            </svg>
                            <p class="text-xl font-semibold text-gray-900">{{ $detailSarpras->luas ?? '0' }} m²</p>
                        </div>
                    </div>
                    
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Kondisi</h3>
                        @php
                            $kondisi = $detailSarpras->kondisi ?? 'Tidak ada data';
                            $kondisiClass = match($kondisi) {
                                'Baik' => 'bg-green-100 text-green-800 border-green-200',
                                'Rusak Ringan' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'Rusak Sedang' => 'bg-orange-100 text-orange-800 border-orange-200',
                                'Rusak Berat' => 'bg-red-100 text-red-800 border-red-200',
                                default => 'bg-gray-100 text-gray-800 border-gray-200'
                            };
                        @endphp
                        <span class="px-4 py-2 text-sm font-semibold rounded-full inline-block border {{ $kondisiClass }}">
                            {{ $kondisi }}
                        </span>
                    </div>
                    
                    <div class="pb-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Keterangan</h3>
                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                            <p class="text-gray-700">{{ $detailSarpras->keterangan ?? 'Tidak ada keterangan' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-8 border-t border-gray-200 pt-6">
                <a href="{{ url()->previous() }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-700 
                          transition-colors duration-200 shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Script untuk pergantian gambar dan penyesuaian container -->
    <script>
        function changeMainImage(newSrc) {
            const mainImage = document.getElementById('mainImage');
            if (mainImage) {
                mainImage.style.opacity = '0';
                setTimeout(() => {
                    mainImage.src = newSrc;
                    mainImage.style.opacity = '1';
                    setTimeout(() => adjustImageContainer(mainImage), 100);
                }, 200);
            }
        }

        function adjustImageContainer(img) {
            const container = document.getElementById('mainImageContainer');
            if (container && img) {
                if (img.complete) {
                    const aspectRatio = img.naturalWidth / img.naturalHeight;
                    const minHeight = Math.min(480, img.offsetWidth / aspectRatio);
                    container.style.minHeight = `${minHeight}px`;
                }
            }
        }

        // Tambahkan smooth transition untuk gambar
        const mainImage = document.getElementById('mainImage');
        if (mainImage) {
            mainImage.style.transition = 'opacity 0.2s ease-in-out';
        }

        window.addEventListener('resize', () => {
            const mainImage = document.getElementById('mainImage');
            if (mainImage) {
                adjustImageContainer(mainImage);
            }
        });
    </script>
</x-app-layout>