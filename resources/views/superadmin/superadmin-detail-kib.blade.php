<x-superadmin-app-layout>
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="bg-sky-400 p-4 rounded-t-lg">
            <h2 class="text-2xl font-semibold text-white text-center">{{ $kibType->nama }}</h2>
            <p class="text-white text-center">{{ $kibType->deskripsi }}</p>
        </div>

        <div class="p-6">
            {{-- Display success/error messages --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($kibType->detailKibs as $kib)
                    <div class="bg-white rounded-lg border shadow-sm">
                        <div class="bg-white p-4">
                            @php
                                $extension = pathinfo($kib->file_path, PATHINFO_EXTENSION);
                                $iconClass = match($extension) {
                                    'pdf' => 'text-red-500',
                                    'xls', 'xlsx' => 'text-green-500',
                                    default => 'text-gray-500'
                                };
                            @endphp
                            
                            <div class="flex justify-center items-center h-32">
                                <svg class="w-16 h-16 {{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($extension === 'pdf')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    @endif
                                </svg>
                            </div>
                        </div>
                        <div class="bg-orange-300 p-3 rounded-b-lg">
                            <div class="text-center font-semibold">{{ $kib->nama_dokumen }}</div>
                            <div class="flex justify-center gap-2 mt-2">
                                <a href="{{ $kib->file_url }}" 
                                   target="_blank"
                                   class="bg-blue-600 text-white px-4 py-1 rounded-md text-sm hover:bg-blue-700 transition-colors duration-200">
                                    Lihat
                                </a>
                                <form action="{{ route('super-admin.kib.destroy', $kib) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            class="bg-red-600 text-white px-4 py-1 rounded-md text-sm hover:bg-red-700 transition-colors duration-200 delete-btn"
                                            data-filename="{{ $kib->nama_dokumen }}">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8 text-gray-500">
                        Belum ada dokumen yang diupload.
                    </div>
                @endforelse
            </div>

            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <form action="{{ route('super-admin.kib.upload', $kibType) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="space-y-2">
                        <label for="nama_dokumen" class="block text-sm font-medium text-gray-700">Nama Dokumen</label>
                        <input type="text" 
                               name="nama_dokumen" 
                               id="nama_dokumen" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500"
                               required>
                    </div>
                    
                    <div class="space-y-2">
                        <label for="document" class="block text-sm font-medium text-gray-700">Upload File (PDF atau Excel)</label>
                        <input type="file" 
                               name="document" 
                               id="document" 
                               accept=".pdf,.xls,.xlsx"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500"
                               required>
                        <p class="text-sm text-gray-500">Format yang diterima: PDF, XLS, XLSX</p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-green-600 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Upload File
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" 
     class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <!-- Modal panel -->
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl transform transition-all duration-300 opacity-0 translate-y-4 sm:scale-95 mx-4"
         id="modalContent">
        <div class="text-center">
            <svg class="mx-auto mb-4 w-14 h-14 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <h3 class="text-xl leading-6 font-bold text-gray-900 mb-4">Konfirmasi Penghapusan</h3>
            <p class="text-sm text-gray-500 mb-4">
                Apakah Anda yakin ingin menghapus file "<span id="fileNameToDelete" class="font-medium"></span>"?
                <br>Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>
        
        <div class="flex justify-center gap-4 mt-6">
            <button id="confirmDelete"
                    class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-32 shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 transition-colors duration-200">
                Hapus
            </button>
            <button id="cancelDelete"
                    class="px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md w-32 border border-gray-300 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors duration-200">
                Batal
            </button>
        </div>
    </div>
</div>

    @push('scripts')
    <script>
        let deleteForm = null;
        const deleteModal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        
        document.addEventListener('DOMContentLoaded', function() {
            // Handle delete button clicks
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    deleteForm = this.closest('form');
                    const fileName = this.dataset.filename;
                    document.getElementById('fileNameToDelete').textContent = fileName;
                    showModal();
                });
            });
            
            // Handle cancel button
            document.getElementById('cancelDelete').addEventListener('click', closeModal);
            
            // Handle confirm button
            document.getElementById('confirmDelete').addEventListener('click', function() {
                if (deleteForm) {
                    deleteForm.submit();
                }
                closeModal();
            });
            
            // Close modal when clicking outside
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    closeModal();
                }
            });
            
            // Handle ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });

        function showModal() {
    // Show modal
    deleteModal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    
    // Animate in
    requestAnimationFrame(() => {
        modalContent.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
        modalContent.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
    });
}

function closeModal() {
    // Animate out
    modalContent.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
    modalContent.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');
    
    // Hide modal after animation
    setTimeout(() => {
        deleteModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }, 300);
}
    </script>
    @endpush
</x-superadmin-app-layout>