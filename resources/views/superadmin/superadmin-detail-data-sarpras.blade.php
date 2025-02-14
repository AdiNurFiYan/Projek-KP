<x-superadmin-app-layout>
    <div class="min-h-screen bg-gray-100">
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Detail Data Sarpras Sekolah</h2>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded" role="alert">
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded" role="alert">
                        <p class="font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <!-- Navigation Tabs -->
                    <div class="w-full bg-white border-b overflow-x-auto">
                        <div class="flex flex-nowrap min-w-full">
                            <a href="{{ route('super-admin.sekolah.detail', $sekolah) }}" 
                                class="{{ Request::routeIs('super-admin.sekolah.detail') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-4 sm:px-6 py-3 transition-all duration-200 whitespace-nowrap">
                                Identitas Sekolah
                            </a>
                            <a href="{{ route('super-admin.sekolah.tanah-denah', $sekolah) }}" 
                                class="{{ Request::routeIs('super-admin.sekolah.tanah-denah') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-4 sm:px-6 py-3 transition-all duration-200 whitespace-nowrap">
                                Tanah & Denah
                            </a>
                            <a href="{{ route('super-admin.sekolah.foto-sekolah', $sekolah) }}"
                                class="{{ Request::routeIs('super-admin.sekolah.foto-sekolah') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-4 sm:px-6 py-3 transition-all duration-200 whitespace-nowrap">
                                Foto Sekolah
                            </a>
                            <a href="{{ route('super-admin.sekolah.laporan-aset', $sekolah) }}"
                                class="{{ Request::routeIs('super-admin.sekolah.laporan-aset') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-4 sm:px-6 py-3 transition-all duration-200 whitespace-nowrap">
                                Laporan Aset
                            </a>
                            <a href="{{ route('super-admin.sekolah.data-sarpras', $sekolah) }}"
                                class="{{ Request::routeIs('super-admin.sekolah.data-sarpras') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-4 sm:px-6 py-3 transition-all duration-200 whitespace-nowrap">
                                Data Sarpras
                            </a>
                            <a href="{{ route('super-admin.sekolah.detail-data-sarpras', $sekolah) }}"
                                class="{{ Request::routeIs('super-admin.sekolah.detail-data-sarpras') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-4 sm:px-6 py-3 transition-all duration-200 whitespace-nowrap">
                                Detail Data Sarpras
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Add Room Button -->
                        <div class="mb-6">
                            <button onclick="openAddRoomModal()" 
                                    class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Ruangan
                            </button>
                        </div>

                        <!-- Room Type Selection -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
    @php
        $jenisRuang = App\Models\DetailSarpras::JENIS_RUANG;
        $existingSarpras = $sekolah->sarpras->detailSarpras ?? collect([]);
        // Kelompokkan data berdasarkan jenis_ruang
        $groupedSarpras = $existingSarpras->groupBy('jenis_ruang');
    @endphp
    
    @foreach($groupedSarpras as $jenisRuangKey => $details)
        @php
            $nama = $jenisRuang[$jenisRuangKey] ?? ucwords(str_replace('_', ' ', $jenisRuangKey));
            $firstDetail = $details->first();
        @endphp
        <div class="room-button block text-center p-4 rounded-lg bg-white border border-yellow-200 hover:bg-yellow-50 transition-all duration-200 shadow-sm">
            <h3 class="font-semibold text-gray-800 mb-3">{{ $nama }}</h3>
            <div class="text-sm text-gray-600 mb-2">
                Jumlah Unit: {{ $sekolah->sarpras->{$jenisRuangKey} ?? 0 }}
            </div>
            <a href="{{ route('super-admin.sekolah.show.detail-sarpras', ['sekolah' => $sekolah->id, 'detailSarpras' => $firstDetail->id]) }}"
               class="inline-flex items-center text-sm text-yellow-600 hover:text-yellow-700">
                <span>Detail</span>
                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    @endforeach
</div>

                        <!-- Room Details Container -->
                        @if(isset($selectedDetail))
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                                    <!-- Bagian Foto -->
                                    <div class="space-y-4">
                                        <h3 class="font-semibold text-lg text-gray-800">{{ $selectedDetail->formatted_jenis_ruang }}</h3>
                                        
                                        <div class="relative h-64 rounded-lg overflow-hidden bg-gray-100">
                                            @if($selectedDetail->has_photos)
                                                <img src="{{ $selectedDetail->foto_urls[0] }}" 
                                                     alt="Foto Utama"
                                                     id="mainImage-{{ $selectedDetail->id }}"
                                                     class="w-full h-full object-cover">
                                                
                                                @if(count($selectedDetail->foto_urls) > 1)
                                                    <div class="flex gap-2 mt-2">
                                                        @foreach($selectedDetail->foto_urls as $index => $url)
                                                            <button onclick="changeMainImage('{{ $selectedDetail->id }}', '{{ $url }}')"
                                                                    class="w-16 h-16 rounded-md overflow-hidden border-2 {{ $index === 0 ? 'border-yellow-500' : 'border-transparent' }}">
                                                                <img src="{{ $url }}" alt="Thumbnail" class="w-full h-full object-cover">
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @else
                                                <div class="flex items-center justify-center h-full">
                                                    <p class="text-gray-500 italic">Tidak ada foto tersedia</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Form Update Data -->
                                    <div class="space-y-4">
                                        <form action="{{ route('super-admin.sekolah.update-detail-sarpras', ['sekolah' => $sekolah->id, 'detailSarpras' => $selectedDetail->id]) }}" 
                                              method="POST" 
                                              class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Luas (m²)</label>
                                                <input type="number" name="luas" value="{{ $selectedDetail->luas }}" step="0.01"
                                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                                                @error('luas')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                                                <select name="kondisi" 
                                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                                                    @foreach(App\Models\DetailSarpras::KONDISI as $kondisi)
                                                        <option value="{{ $kondisi }}" {{ $selectedDetail->kondisi == $kondisi ? 'selected' : '' }}>
                                                            {{ $kondisi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kondisi')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                                                <textarea name="keterangan" rows="3"
                                                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">{{ $selectedDetail->keterangan }}</textarea>
                                                @error('keterangan')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="flex justify-end gap-3">
                                                <button type="submit" 
                                                        class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                                    Simpan Perubahan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Add Room Modal -->
<div id="addRoomModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Ruangan Baru</h3>
            <form action="{{ route('super-admin.sekolah.store-detail-sarpras', $sekolah->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Ruangan</label>
                    <select name="jenis_ruang" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        <option value="">Pilih Jenis Ruangan</option>
                        <option value="ruang_kelas">Ruang Kelas</option>
                        <option value="ruang_perpus">Ruang Perpustakaan</option>
                        <option value="ruang_lab">Ruang Laboratorium</option>
                        <option value="ruang_praktik">Ruang Praktik</option>
                        <option value="ruang_pimpinan">Ruang Pimpinan</option>
                        <option value="ruang_guru">Ruang Guru</option>
                        <option value="ruang_ibadah">Ruang Ibadah</option>
                        <option value="uks">UKS</option>
                        <option value="toilet">Toilet</option>
                        <option value="gudang">Gudang</option>
                        <option value="sirkulasi">Sirkulasi</option>
                        <option value="olahraga">Olahraga</option>
                        <option value="tu">Tata Usaha</option>
                        <option value="konseling">Ruang Konseling</option>
                        <option value="osis">Ruang OSIS</option>
                        <option value="bangunan">Bangunan</option>
                        <option value="dinas">Dinas</option>
                    </select>
                    @error('jenis_ruang')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Luas (m²)</label>
    <div class="relative">
        <input type="text" 
               name="luas" 
               required
               pattern="[0-9]*\.?[0-9]{0,2}"
               oninput="if(this.value.startsWith('-')) this.value = this.value.replace('-', ''); this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
               onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46"
               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
               placeholder="Masukkan luas ruangan">
    </div>
    @error('luas')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                    <select name="kondisi" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        <option value="">Pilih Kondisi</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Sedang">Rusak Sedang</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                    @error('kondisi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeAddRoomModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
        function openAddRoomModal() {
            document.getElementById('addRoomModal').classList.remove('hidden');
        }

        function closeAddRoomModal() {
            document.getElementById('addRoomModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('addRoomModal');
            if (event.target == modal) {
                closeAddRoomModal();
            }
        }

        function changeMainImage(detailId, newSrc) {
            const mainImage = document.getElementById('mainImage-' + detailId);
            if (mainImage) {
                mainImage.src = newSrc;
            }
        }
    </script>
</x-superadmin-app-layout>