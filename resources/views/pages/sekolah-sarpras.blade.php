<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $sekolah->nama }}</h1>
            <div class="h-1 w-32 bg-blue-600 mx-auto rounded-full"></div>
        </div>

        <!-- School Identity Card -->
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg shadow-lg mb-8">
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="font-semibold">Kepala Sekolah:</span>
                            <span>{{ $sekolah->kapsek }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="font-semibold">Akreditasi:</span>
                            <span>{{ $sekolah->akreditasi }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="font-semibold">Kurikulum:</span>
                            <span>{{ $sekolah->kurikulum }}</span>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-semibold">Alamat:</span>
                            <span>{{ $sekolah->alamat }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="font-semibold">NPSN:</span>
                            <span>{{ $sekolah->npsn }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tanah Section -->
        <div x-data="{ open: false }">
            <button 
                @click="open = !open"
                class="w-full flex items-center justify-between p-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 mb-2"
            >
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <h2 class="text-lg font-semibold">Informasi Tanah</h2>
                </div>
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </button>
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="bg-white rounded-b-lg shadow-lg p-6 mb-6 border border-gray-200">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="flex items-center space-x-2">
                        <span class="font-semibold">Status Tanah:</span>
                        <span>{{ $sekolah->status_tanah }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="font-semibold">No. Sertifikat/Ijin Guna Pakai:</span>
                        <span>{{ $sekolah->no_sertifikat }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Denah & Foto Section -->
        <div x-data="{ 
            open: false,
            showModal: false,
            selectedImage: '',
            selectedIndex: null
        }">
            <button 
                @click="open = !open"
                class="w-full flex items-center justify-between p-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 mb-2"
            >
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h2 class="text-lg font-semibold">Denah & Foto Sekolah</h2>
                </div>
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </button>
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="bg-white rounded-b-lg shadow-lg p-6 mb-6 border border-gray-200">
                <div class="space-y-6">
                    <!-- Denah Section -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Denah Sekolah</h3>
                        <div class="w-full flex justify-center">
                            <div class="w-full md:w-3/4 lg:w-4/5 flex justify-center items-center">
                                {!! $sekolah->denah !!}
                            </div>
                        </div>
                    </div>

                    <!-- Foto Section -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Foto Sekolah</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @if(is_array($sekolah->foto) && count($sekolah->foto) > 0)
                                @foreach($sekolah->foto as $key => $foto)
                                    <div class="rounded-lg overflow-hidden shadow-lg transition-transform duration-200 hover:scale-105">
                                        @php
                                            $imagePath = 'storage/foto/' . $foto;
                                            $imageExists = Storage::disk('public')->exists('foto/' . $foto);
                                        @endphp

                                        @if($imageExists)
                                            <div class="aspect-w-16 aspect-h-9 cursor-pointer"
                                                 @click="showModal = true; selectedImage = '{{ asset($imagePath) }}'; selectedIndex = {{ $key }}">
                                                <img src="{{ asset($imagePath) }}" 
                                                     alt="Foto Sekolah" 
                                                     class="w-full h-48 object-cover hover:opacity-90 transition-opacity"
                                                     loading="lazy">
                                            </div>
                                            <p class="text-center py-2 bg-white font-medium">Foto {{ $key + 1 }}</p>
                                        @else
                                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                                <p class="text-gray-500">Gambar tidak tersedia</p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="col-span-3 text-center py-8 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500">Belum ada foto sekolah yang diunggah</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Image Modal -->
                <div x-show="showModal" 
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
                     @click.self="showModal = false"
                     @keydown.escape.window="showModal = false">
                    
                    <!-- Close button -->
                    <button @click="showModal = false" 
                            class="fixed top-4 right-4 p-2 text-white hover:text-gray-300 z-50 bg-red-600 rounded-full transition-colors duration-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="relative flex items-center justify-center w-full">
                        <!-- Left navigation button -->
                        <button @click="selectedIndex = (selectedIndex - 1 + {{ count($sekolah->foto) }}) % {{ count($sekolah->foto) }}; 
                                 selectedImage = '{{ asset('storage/foto/') }}/' + {{ Js::from($sekolah->foto) }}[selectedIndex]"
                                class="absolute left-4 p-2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full transition-colors duration-200"
                                x-show="{{ count($sekolah->foto) }} > 1">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <!-- Image container -->
                        <div class="px-16">
                            <img :src="selectedImage" 
                                 alt="Foto Sekolah" 
                                 class="max-h-[90vh] max-w-full object-contain rounded-lg shadow-xl">
                        </div>

                        <!-- Right navigation button -->
                        <button @click="selectedIndex = (selectedIndex + 1) % {{ count($sekolah->foto) }};
                                 selectedImage = '{{ asset('storage/foto/') }}/' + {{ Js::from($sekolah->foto) }}[selectedIndex]"
                                class="absolute right-4 p-2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full transition-colors duration-200"
                                x-show="{{ count($sekolah->foto) }} > 1">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Aset Section -->
        <div x-data="{ open: false }">
            <button 
                @click="open = !open"
                class="w-full flex items-center justify-between p-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 mb-2"
            >
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h2 class="text-lg font-semibold">Laporan Aset</h2>
                </div>
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </button>
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="bg-white rounded-b-lg shadow-lg p-6 mb-6 border border-gray-200">
                @if($sekolah->laporan_asset)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-medium">{{ basename($sekolah->laporan_asset) }}</p>
                            <p class="text-sm text-gray-500">Terakhir diupdate: {{ $sekolah->updated_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="space-x-2">
                            <a href="{{ asset('storage/' . $sekolah->laporan_asset) }}" 
                               download 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download PDF
                            </a>
                            <a href="{{ asset('storage/' . $sekolah->laporan_asset) }}" 
                               target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat di Browser
                            </a>
                        </div>
                    </div>
                @else
                    <p class="text-center text-gray-500">Laporan aset belum tersedia</p>
                @endif
            </div>
        </div>

        <!-- Bangunan Section -->
        <div x-data="{ open: false }">
            <button 
                @click="open = !open"
                class="w-full flex items-center justify-between p-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 mb-2"
            >
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <h2 class="text-lg font-semibold">Bangunan</h2>
                </div>
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </button>
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="bg-white rounded-b-lg shadow-lg p-6 mb-6 border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @php
                        $facilities = [
                            'ruang_kelas' => 'Ruang Kelas',
                            'ruang_perpus' => 'Ruang Perpustakaan',
                            'ruang_lab' => 'Ruang Laboratorium',
                            'ruang_praktik' => 'Ruang Praktik',
                            'ruang_pimpinan' => 'Ruang Pimpinan',
                            'ruang_guru' => 'Ruang Guru',
                            'ruang_ibadah' => 'Ruang Ibadah',
                            'uks' => 'UKS',
                            'toilet' => 'Toilet',
                            'gudang' => 'Gudang',
                            'sirkulasi' => 'Sirkulasi',
                            'olahraga' => 'Olahraga',
                            'tu' => 'Tata Usaha',
                            'konseling' => 'Ruang Konseling',
                            'osis' => 'Ruang OSIS',
                            'bangunan' => 'Bangunan',
                            'dinas' => 'Dinas'
                        ];
                    @endphp

                    @foreach($facilities as $key => $label)
                        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border border-gray-200">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $label }}</h3>
                                    <p class="text-sm text-gray-600">
                                        Jumlah Unit: {{ $sekolah->sarpras->$key ?? 'Belum tersedia' }}
                                    </p>
                                </div>
                                @php
                                    $hasDetailSarpras = $sekolah->sarpras?->detailSarpras()
                                        ->where('jenis_ruang', $key)
                                        ->exists();
                                @endphp
                                @if($hasDetailSarpras)
                                    <a href="{{ route('detail-sarpras', ['sarpras_id' => $sekolah->sarpras->id, 'jenis_ruang' => $key]) }}" 
                                       class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors duration-200">
                                        <span>Detail</span>
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                @else
                                    <span class="text-sm text-gray-400 italic">Tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>