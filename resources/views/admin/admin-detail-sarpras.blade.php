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
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Identitas Sekolah</h3>
                        
                        <form action="{{ route('admin.sekolah.detail.update', $sekolah) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Sekolah</label>
                                    <select name="jenis" class="w-full p-2 border border-gray-300 rounded-md">
                                        <option value="">Pilih Jenis Sekolah</option>
                                        <option value="TK" {{ $sekolah->jenis == 'TK' ? 'selected' : '' }}>TK</option>
                                        <option value="SD" {{ $sekolah->jenis == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ $sekolah->jenis == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    </select>
                                    @error('jenis')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah</label>
                                    <input type="text" name="nama" value="{{ old('nama', $sekolah->nama) }}" 
                                           class="w-full p-2 border border-gray-300 rounded-md">
                                    @error('nama')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kepala Sekolah</label>
                                    <input type="text" name="kapsek" value="{{ old('kapsek', $sekolah->kapsek) }}" 
                                           class="w-full p-2 border border-gray-300 rounded-md">
                                    @error('kapsek')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Akreditasi</label>
                                    <input type="text" name="akreditasi" value="{{ old('akreditasi', $sekolah->akreditasi) }}" 
                                           class="w-full p-2 border border-gray-300 rounded-md">
                                    @error('akreditasi')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kurikulum</label>
                                    <input type="text" name="kurikulum" value="{{ old('kurikulum', $sekolah->kurikulum) }}" 
                                           class="w-full p-2 border border-gray-300 rounded-md">
                                    @error('kurikulum')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NPSN</label>
                                    <input type="text" name="npsn" value="{{ old('npsn', $sekolah->npsn) }}" 
                                           class="w-full p-2 border border-gray-300 rounded-md">
                                    @error('npsn')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <textarea name="alamat" rows="3" 
                                              class="w-full p-2 border border-gray-300 rounded-md">{{ old('alamat', $sekolah->alamat) }}</textarea>
                                    @error('alamat')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex gap-2 mt-6">
                                    <button type="submit" 
                                            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                        Simpan Perubahan
                                    </button>
                                    <button type="button" 
                                            class="px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800"
                                            onclick="location.reload()">
                                        Batal
                                    </button>
                                </div>
                                
                                <div class="mt-8">
                                    <a href="{{ route('admin.sekolah.sarpras', $sekolah->korwil) }}" 
                                       class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-admin-app-layout>