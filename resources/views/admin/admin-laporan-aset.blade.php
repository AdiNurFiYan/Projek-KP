<x-admin-app-layout>
    <div class="min-h-screen bg-gray-100">
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-2xl font-bold mb-6">Detail Sekolah</h2>
                
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="bg-white rounded-lg shadow-sm">
                <div class="flex border-b bg-white overflow-hidden">
                        <a href="{{ route('admin.sekolah.detail', $sekolah) }}" 
                            class="{{ Request::routeIs('admin.sekolah.detail') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
                            Identitas Sekolah
                        </a>
                        <a href="{{ route('admin.sekolah.tanah-denah', $sekolah) }}" 
                            class="{{ Request::routeIs('admin.sekolah.tanah-denah') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
                            Tanah & Denah
                        </a>
                        <a href="{{ route('admin.sekolah.foto-sekolah', $sekolah) }}"
                            class="{{ Request::routeIs('admin.sekolah.foto-sekolah') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
                            Foto Sekolah
                        </a>
                        <a href="{{ route('admin.sekolah.laporan-aset', $sekolah) }}"
                            class="{{ Request::routeIs('admin.sekolah.laporan-aset') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
                            Laporan Aset
                        </a>
                        <a href="{{ route('admin.sekolah.data-sarpras', $sekolah) }}"
                            class="{{ Request::routeIs('admin.sekolah.data-sarpras') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
                            Data Sarpras
                        </a>
                        <a href="{{ route('admin.sekolah.detail-data-sarpras', $sekolah) }}"
                            class="{{ Request::routeIs('admin.sekolah.data-sarpras') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
                            Detail Data Sarpras
                        </a>
                    </div>

                    <div class="p-6 bg-orange-50">
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4">Upload Laporan Aset</h3>
                            
                            <form action="{{ route('admin.sekolah.upload-laporan', $sekolah) }}" 
                                  method="POST" 
                                  enctype="multipart/form-data"
                                  class="space-y-6">
                                @csrf
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama File (Opsional)
                                    </label>
                                    <input type="text" 
                                           name="custom_filename" 
                                           class="w-full p-2 border border-gray-300 rounded-md"
                                           placeholder="Masukkan nama file yang diinginkan">
                                    <p class="mt-1 text-sm text-gray-500">
                                        Biarkan kosong untuk menggunakan nama file asli
                                    </p>
                                    @error('custom_filename')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        File Laporan (Excel/PDF)
                                    </label>
                                    <input type="file" 
                                           name="laporan_asset" 
                                           accept=".xlsx,.xls,.pdf"
                                           class="w-full p-2 border border-gray-300 rounded-md">
                                    <p class="mt-1 text-sm text-gray-500">
                                        Format yang diterima: Excel (.xlsx, .xls) atau PDF (.pdf). Maksimal ukuran file: 5MB
                                    </p>
                                    @error('laporan_asset')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" 
                                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                    Upload Laporan
                                </button>
                            </form>
                        </div>

                        @if($sekolah->laporan_asset)
                            <div class="mt-8">
                                <h4 class="text-lg font-semibold mb-4">Laporan Saat Ini</h4>
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-medium">{{ basename($sekolah->laporan_asset) }}</p>
                                            <p class="text-sm text-gray-500">
                                                Terakhir diupdate: {{ $sekolah->updated_at->format('d M Y H:i') }}
                                            </p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ asset('storage/' . $sekolah->laporan_asset) }}" 
                                               target="_blank"
                                               class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                                Lihat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mt-8">
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <p class="text-gray-600 text-center">Belum ada laporan aset yang diupload</p>
                                </div>
                            </div>
                        @endif

                        {{-- Tombol Kembali --}}
                        <div class="mt-8">
                            <a href="{{ route('admin.sekolah.sarpras', $sekolah->korwil) }}" 
                               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 inline-block">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>