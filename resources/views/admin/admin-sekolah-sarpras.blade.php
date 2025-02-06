<x-admin-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 ease-in-out opacity-100" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 ease-in-out opacity-100" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Main Content -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8">
                        <div class="bg-gradient-to-r from-red-800 to-red-600 px-6 py-3 rounded-lg shadow-sm">
                            <h2 class="text-xl font-semibold text-white">Data Sekolah</h2>
                        </div>
                        <form action="{{ route('admin.sekolah.create', ['korwil' => $korwil, 'jenis' => request()->jenis]) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                id="submitBtn"
                                class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 disabled:opacity-50"
                                onclick="handleSubmit(this)">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span class="normal-text">Tambah Sekolah Baru</span>
                                    <span class="loading-text hidden">
                                        <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Memproses...
                                    </span>
                                </span>
                            </button>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-100">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Sekolah</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($sekolahs as $index => $sekolah)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $sekolahs->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        {{ $sekolah->nama }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-medium">
                                            {{ $sekolah->jenis }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('admin.sekolah.detail', ['sekolah' => $sekolah, 'jenis' => request()->jenis]) }}" 
                                               class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                                <span class="bg-blue-50 p-2 rounded-lg inline-block">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </span>
                                            </a>
                                            <button type="button" 
                                                    onclick="showDeleteModal('{{ $sekolah->nama }}', '{{ route('admin.sekolah.destroy', $sekolah) }}')"
                                                    class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                                <span class="bg-red-50 p-2 rounded-lg inline-block">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                            <p class="mt-4 text-gray-600">Belum ada data sekolah yang tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            {{ $sekolahs->appends(['jenis' => request()->jenis])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" 
         class="fixed inset-0 z-50 hidden">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity duration-300 ease-in-out backdrop-blur-sm"></div>
        
        <!-- Modal -->
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div id="modalContent" 
                 class="bg-white rounded-xl p-6 max-w-sm w-full mx-4 shadow-xl transform transition-all duration-300 ease-in-out opacity-0 translate-y-4 scale-95">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-900">Konfirmasi Hapus</h3>
                    <!-- <button onclick="closeDeleteModal()" 
                            class="text-gray-400 hover:text-gray-500 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button> -->
                </div>
                <p class="text-gray-600 mb-6">
                    Apakah Anda yakin ingin menghapus data sekolah "<span id="schoolNameToDelete" class="font-semibold text-gray-900"></span>"?
                </p>
                <div class="flex justify-end gap-3">
                    <button type="button" 
                            onclick="closeDeleteModal()"
                            class="px-4 py-2 bg-white text-gray-700 rounded-lg hover:bg-gray-50 border border-gray-300 transition-colors duration-200">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto-hide flash messages
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('[role="alert"]');
                alerts.forEach(alert => {
                    alert.classList.replace('opacity-100', 'opacity-0');
                    setTimeout(() => alert.remove(), 300);
                });
            }, 3000);
        });

        // Modal functions
        function showDeleteModal(schoolName, deleteUrl) {
            const modal = document.getElementById('deleteModal');
            const modalContent = document.getElementById('modalContent');
            const deleteForm = document.getElementById('deleteForm');
            const schoolNameSpan = document.getElementById('schoolNameToDelete');
            
            schoolNameSpan.textContent = schoolName;
            deleteForm.action = deleteUrl;
            
            // Show modal with transition
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            
            // Animate in
            requestAnimationFrame(() => {
                modalContent.classList.remove('opacity-0', 'translate-y-4', 'scale-95');
                modalContent.classList.add('opacity-100', 'translate-y-0', 'scale-100');
            });
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const modalContent = document.getElementById('modalContent');
            
            // Animate out
            modalContent.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
            modalContent.classList.add('opacity-0', 'translate-y-4', 'scale-95');
            
            // Hide modal after animation
            setTimeout(() => {
                modal.classList.add('hidden');
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

        function handleSubmit(button) {
            button.disabled = true;
            button.querySelector('.normal-text').classList.add('hidden');
            button.querySelector('.loading-text').classList.remove('hidden');
            button.closest('form').submit();
            
            setTimeout(() => {
                button.disabled = false;
                button.querySelector('.normal-text').classList.remove('hidden');
                button.querySelector('.loading-text').classList.add('hidden');
            }, 10000);
        }

        // Prevent double submission
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                if (form.submitting) {
                    e.preventDefault();
                    return;
                }
                form.submitting = true;
            });
        });
    </script>
    @endpush
</x-admin-app-layout>