<x-superadmin-app-layout>
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
    <a href="{{ route('super-admin.sekolah.detail-data-sarpras', $sekolah) }}"
        class="{{ Request::routeIs('super-admin.sekolah.data-sarpras') ? 'border-b-2 border-yellow-400 bg-[#FFB930] text-black font-medium' : 'text-gray-600 hover:bg-yellow-50/50 hover:text-black' }} px-6 py-3 transition-all duration-200">
        Detail Data Sarpras
    </a>
</div>
    
                    <div class="p-6 bg-orange-50">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4">Data Tanah dan Denah</h3>
                            
                            <form action="{{ route('super-admin.sekolah.update-tanah-denah', $sekolah) }}" 
                                  method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Tanah</label>
                                        <select name="status_tanah" class="w-full p-2 border border-gray-300 rounded-md">
                                            <option value="">Pilih Status Tanah</option>
                                            <option value="Sertifikat" {{ $sekolah->status_tanah == 'Sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                                            <option value="Hak Guna Pakai" {{ $sekolah->status_tanah == 'Hak Guna Pakai' ? 'selected' : '' }}>Hak Guna Pakai</option>
                                        </select>
                                        @error('status_tanah')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Sertifikat/Ijin Guna Pakai</label>
                                        <input type="text" name="no_sertifikat" value="{{ old('no_sertifikat', $sekolah->no_sertifikat) }}" 
                                               class="w-full p-2 border border-gray-300 rounded-md">
                                        @error('no_sertifikat')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
    
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Link Embed Denah</label>
                                        <div class="flex gap-4">
                                            <div class="flex-1">
                                                <textarea 
                                                    name="denah" 
                                                    rows="4" 
                                                    class="w-full p-2 border border-gray-300 rounded-md text-sm font-mono"
                                                    placeholder='<iframe src="https://..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
                                                >{{ old('denah', $sekolah->denah) }}</textarea>
                                                @error('denah')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                                <p class="text-sm text-gray-500 mt-1">
                                                    Cara menambahkan link embed: 
                                                    <ol class="list-decimal ml-4 space-y-1">
                                                        <li>Buka link denah (Google Drive/Docs)</li>
                                                        <li>Klik tombol Share/Bagikan</li>
                                                        <li>Pilih "Embed/Sematkan"</li>
                                                        <li>Copy kode embed</li>
                                                        <li>Paste kode di sini</li>
                                                    </ol>
                                                </p>
                                            </div>
                                            <div class="w-1/2">
                                                <div class="bg-white p-4 rounded-lg border border-gray-200">
                                                    <p class="text-sm font-medium text-gray-700 mb-2">Preview Denah</p>
                                                    <div class="relative w-full h-[300px] bg-gray-100 rounded overflow-hidden">
                                                        @if($sekolah->denah)
                                                            {!! $sekolah->denah !!}
                                                        @else
                                                            <div class="flex items-center justify-center h-full text-gray-400">
                                                                <p class="text-sm">Preview akan muncul di sini</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        <a href="{{ route('super-admin.sekolah.sarpras', $sekolah->korwil) }}" 
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
    
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const denahTextarea = document.querySelector('textarea[name="denah"]');
        const previewDiv = document.querySelector('.relative.w-full.h-[300px]');
    
        denahTextarea.addEventListener('input', function() {
            const embedCode = this.value.trim();
            if (embedCode) {
                previewDiv.innerHTML = embedCode;
            } else {
                previewDiv.innerHTML = '<div class="flex items-center justify-center h-full text-gray-400"><p class="text-sm">Preview akan muncul di sini</p></div>';
            }
        });
    });
    </script>
    @endpush
</x-superadmin-app-layout>