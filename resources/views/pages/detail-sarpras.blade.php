<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Detail Sarana Prasarana</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Bagian Foto -->
                <div class="space-y-4">
                    <!-- Foto Utama -->
                    <div class="relative h-64 rounded-lg overflow-hidden">
                        @if(isset($detailSarpras->foto) && is_array($detailSarpras->foto) && count($detailSarpras->foto) > 0)
                            <img src="{{ asset('storage/' . $detailSarpras->foto[0]) }}" 
                                 alt="Foto Utama" 
                                 id="mainImage"
                                 class="w-full h-full object-cover"/>
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">Tidak ada foto</span>
                            </div>
                        @endif
                    </div>
                    <!-- Thumbnail Foto -->
                    @if(isset($detailSarpras->foto) && is_array($detailSarpras->foto) && count($detailSarpras->foto) > 0)
                        <div class="grid grid-cols-3 gap-2">
                            @foreach($detailSarpras->foto as $index => $foto)
                                <div class="relative h-20 rounded-lg overflow-hidden cursor-pointer hover:opacity-75"
                                     onclick="changeMainImage('{{ asset('storage/' . $foto) }}')">
                                    <img src="{{ asset('storage/' . $foto) }}" 
                                         alt="Thumbnail {{ $index + 1 }}" 
                                         class="w-full h-full object-cover"/>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Informasi Detail -->
                <div class="space-y-4">
                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-gray-500">Jenis Ruang</h3>
                        <p class="text-lg text-gray-900">{{ ucwords(str_replace('_', ' ', $detailSarpras->jenis_ruang ?? 'Tidak ada data')) }}</p>
                    </div>
                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-gray-500">Luas</h3>
                        <p class="text-lg text-gray-900">{{ $detailSarpras->luas ?? '0' }} m²</p>
                    </div>
                    <div class="border-b pb-3">
                        <h3 class="text-sm font-medium text-gray-500">Kondisi</h3>
                        @php
                            $kondisi = $detailSarpras->kondisi ?? 'Tidak ada data';
                            $kondisiClass = match($kondisi) {
                                'Baik' => 'bg-green-100 text-green-800',
                                'Rusak Ringan' => 'bg-yellow-100 text-yellow-800',
                                'Rusak Sedang' => 'bg-orange-100 text-orange-800',
                                'Rusak Berat' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800'
                            };
                        @endphp
                        <span class="px-3 py-1 text-sm font-medium rounded-full {{ $kondisiClass }}">
                            {{ $kondisi }}
                        </span>
                    </div>
                    <div class="pb-3">
                        <h3 class="text-sm font-medium text-gray-500">Keterangan</h3>
                        <p class="text-gray-700">{{ $detailSarpras->keterangan ?? 'Tidak ada keterangan' }}</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-6">
                <a href="{{ url()->previous() }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Script untuk pergantian gambar -->
    <script>
        function changeMainImage(newSrc) {
            const mainImage = document.getElementById('mainImage');
            if (mainImage) {
                mainImage.src = newSrc;
            }
        }
    </script>
</x-app-layout>