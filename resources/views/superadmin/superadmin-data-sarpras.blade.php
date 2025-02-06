<x-superadmin-app-layout>
    <div class="min-h-screen bg-gray-100">
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Data Sarpras Sekolah</h2>
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
                <div class="flex border-b bg-white overflow-hidden">
    <a href="{{ route('super-admin.sekolah.detail', $sekolah) }}" 
        class="{{ Request::routeIs('super-admin.sekolah.detail') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
        Identitas Sekolah
    </a>
    <a href="{{ route('super-admin.sekolah.tanah-denah', $sekolah) }}" 
        class="{{ Request::routeIs('super-admin.sekolah.tanah-denah') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
        Tanah & Denah
    </a>
    <a href="{{ route('super-admin.sekolah.foto-sekolah', $sekolah) }}"
        class="{{ Request::routeIs('super-admin.sekolah.foto-sekolah') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
        Foto Sekolah
    </a>
    <a href="{{ route('super-admin.sekolah.laporan-aset', $sekolah) }}"
        class="{{ Request::routeIs('super-admin.sekolah.laporan-aset') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
        Laporan Aset
    </a>
    <a href="{{ route('super-admin.sekolah.data-sarpras', $sekolah) }}"
        class="{{ Request::routeIs('super-admin.sekolah.data-sarpras') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
        Data Sarpras
    </a>
    <a href="{{ route('super-admin.sekolah.laporan-aset', $sekolah) }}"
        class="{{ Request::routeIs('super-admin.sekolah.laporan-aset') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
        Detail Data Sarpras
    </a>
</div>

                    <div class="p-6 bg-orange-50">
                        <form action="{{ route('super-admin.sekolah.update-sarpras', $sekolah) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-6">
                                <div class="bg-white p-4 rounded-lg shadow-sm space-y-4">
                                    
                                    @foreach(['ruang_kelas' => 'Ruang Kelas', 
                                            'ruang_perpus' => 'Ruang Perpustakaan',
                                            'ruang_lab' => 'Ruang Laboratorium',
                                            'ruang_praktik' => 'Ruang Praktik',
                                            'ruang_guru' => 'Ruang Guru'] as $field => $label)
                                        <div class="form-group">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                                            <input type="text"
                                                name="{{ $field }}"
                                                value="{{ $sekolah->sarpras->$field ?? 0 }}"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                inputmode="numeric"
                                                pattern="[0-9]*"
                                                min="0">
                                            @error($field)
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>

                                <div class="bg-white p-4 rounded-lg shadow-sm space-y-4">
                                    
                                    @foreach(['ruang_ibadah' => 'Ruang Ibadah',
                                            'uks' => 'UKS',
                                            'toilet' => 'Toilet',
                                            'gudang' => 'Gudang',
                                            'sirkulasi' => 'Sirkulasi',
                                            'olahraga' => 'Olahraga'] as $field => $label)
                                        <div class="form-group">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                                            <input type="text"
                                                name="{{ $field }}"
                                                value="{{ $sekolah->sarpras->$field ?? 0 }}"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                inputmode="numeric"
                                                pattern="[0-9]*"
                                                min="0">
                                            @error($field)
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>

                                <div class="bg-white p-4 rounded-lg shadow-sm space-y-4">
                                    
                                    @foreach(['ruang_pimpinan' => 'Ruang Pimpinan',
                                            'tu' => 'Tata Usaha',
                                            'konseling' => 'Ruang Konseling',
                                            'osis' => 'Ruang OSIS',
                                            'bangunan' => 'Bangunan',
                                            'dinas' => 'Dinas'] as $field => $label)
                                        <div class="form-group">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                                            <input type="text"
                                                name="{{ $field }}"
                                                value="{{ $sekolah->sarpras->$field ?? 0 }}"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                inputmode="numeric"
                                                pattern="[0-9]*"
                                                min="0">
                                            @error($field)
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex gap-3 mt-6">
                                <button type="submit" class="px-6 py-2.5 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-150 font-medium">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>

                        <div class="mt-8">
                            <a href="{{ route('super-admin.sekolah.sarpras', $sekolah->korwil) }}" 
                               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 inline-block">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const numberInputs = document.querySelectorAll('input[inputmode="numeric"]');

            numberInputs.forEach(input => {
                // Prevent paste of non-numeric values
                input.addEventListener('paste', (e) => {
                    let pasteData = e.clipboardData.getData('text');
                    if (!/^\d+$/.test(pasteData)) {
                        e.preventDefault();
                    }
                });

                // Set to 0 if empty on blur
                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.value = '0';
                    }
                });

                // Prevent mouse wheel from changing value
                input.addEventListener('wheel', function(e) {
                    e.preventDefault();
                });

                // Prevent up/down arrow keys
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
    @endpush
</x-superadmin-app-layout>