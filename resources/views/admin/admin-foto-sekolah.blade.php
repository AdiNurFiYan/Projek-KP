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
                        <h3 class="text-lg font-semibold mb-4">Galeri Foto Sekolah</h3>
                        
                        <form action="{{ route('admin.sekolah.store-photo', $sekolah) }}" 
                              method="POST" 
                              enctype="multipart/form-data"
                              class="mb-8">
                            @csrf
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="foto" class="block text-sm font-medium mb-2">Upload Foto Baru</label>
                                    <input type="file" 
                                           id="foto"
                                           name="foto[]" 
                                           multiple 
                                           accept="image/*" 
                                           onchange="previewImages()"
                                           class="w-full p-2 border border-gray-300 rounded-md">
                                    @error('foto.*')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div id="preview-container" class="hidden">
                                    <h4 class="text-sm font-medium mb-2">Preview Foto:</h4>
                                    <div id="image-preview" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"></div>
                                </div>

                                <button type="submit" 
                                        class="w-full md:w-auto px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors duration-200">
                                    Simpan Foto
                                </button>
                            </div>
                        </form>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @if(is_array($sekolah->foto) && count($sekolah->foto) > 0)
                                @foreach($sekolah->foto as $index => $foto)
                                    <div class="relative group">
                                        @php
                                            $imagePath = 'storage/foto/' . $foto;
                                            $imageExists = Storage::disk('public')->exists('foto/' . $foto);
                                        @endphp

                                        @if($imageExists)
                                        <div class="aspect-w-16 aspect-h-9">
                                            <img src="{{ asset($imagePath) }}" 
                                                 class="w-full h-48 object-cover rounded-lg shadow-sm" 
                                                 alt="Foto Sekolah {{ $index + 1 }}"
                                                 loading="lazy"
                                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.jpg') }}';">
                                        </div>
                                        @else
                                            <div class="relative w-full pt-[56.25%] bg-gray-200 rounded-lg">
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <p class="text-gray-500">Gambar tidak tersedia</p>
                                                </div>
                                            </div>
                                        @endif
                                             
                                        <div>
                                            <button type="button" 
                                                    onclick="showDeleteModal('{{ route('admin.sekolah.delete-photo', ['sekolah' => $sekolah, 'filename' => $foto]) }}')"
                                                    class="absolute top-2 right-2 px-3 py-1 bg-red-500 text-white rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-600">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-span-full text-center py-8 text-gray-500">
                                    Belum ada foto sekolah yang diunggah
                                </div>
                            @endif
                        </div>

                        <div class="mt-8">
                            <a href="{{ route('admin.sekolah.sarpras', $sekolah->korwil) }}" 
                               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors duration-200 inline-block">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" 
         class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center transition-opacity duration-300">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full mx-4 transform transition-all duration-300 opacity-0 translate-y-4">
            <h3 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h3>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus foto ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex justify-end space-x-3">
                <button type="button" 
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition-colors duration-200">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors duration-200">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImages() {
            const preview = document.getElementById('image-preview');
            const previewContainer = document.getElementById('preview-container');
            preview.innerHTML = '';
            
            const files = document.getElementById('foto').files;

            if (files.length > 0) {
                previewContainer.classList.remove('hidden');
            } else {
                previewContainer.classList.add('hidden');
                return;
            }

            function readAndPreview(file) {
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    alert(file.name + " bukan file gambar yang valid");
                    return;
                }

                const reader = new FileReader();
                reader.addEventListener("load", function() {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'relative';
                    
                    const image = new Image();
                    image.className = 'w-full h-32 object-cover rounded-lg';
                    image.title = file.name;
                    image.src = this.result;
                    
                    const caption = document.createElement('p');
                    caption.className = 'text-xs text-gray-500 mt-1 truncate';
                    caption.textContent = file.name;
                    
                    previewDiv.appendChild(image);
                    previewDiv.appendChild(caption);
                    preview.appendChild(previewDiv);
                });
                
                reader.readAsDataURL(file);
            }

            if (files) {
                Array.prototype.forEach.call(files, readAndPreview);
            }
        }

        function showDeleteModal(deleteUrl) {
            const modal = document.getElementById('deleteModal');
            const modalContent = modal.querySelector('.bg-white');
            const deleteForm = document.getElementById('deleteForm');
            
            deleteForm.action = deleteUrl;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Prevent background scrolling
            document.body.classList.add('overflow-hidden');

            // Trigger animations
            requestAnimationFrame(() => {
                modal.classList.add('opacity-100');
                modalContent.classList.remove('opacity-0', 'translate-y-4');
            });
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const modalContent = modal.querySelector('.bg-white');
            
            // Start fade out animations
            modal.classList.remove('opacity-100');
            modalContent.classList.add('opacity-0', 'translate-y-4');
            
            // Wait for animations to finish
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }

        // Close modal on background click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Close modal on Escape key press
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
                closeDeleteModal();
            }
        });
    </script>
    @endpush
</x-admin-app-layout>