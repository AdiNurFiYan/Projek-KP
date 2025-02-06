<x-admin-app-layout>
    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.production.min.js"></script>
    @endpush

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-semibold text-gray-900">Detail {{ $detailSarpras->formatted_jenis_ruang }}</h2>
                <a href="{{ route('admin.sekolah.detail-data-sarpras', $sekolah) }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    <svg class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"/>
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Alert Component -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-md">
                    <span class="text-red-800 font-medium">Terdapat beberapa kesalahan:</span>
                    <ul class="mt-2 list-disc list-inside text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-md">
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Main Form -->
            <div class="bg-white shadow rounded-xl border border-gray-200">
                <form id="updateForm" 
                      action="{{ route('admin.sekolah.update-detail-sarpras', ['sekolah' => $sekolah->id, 'detailSarpras' => $detailSarpras->id]) }}" 
                      method="POST"
                      enctype="multipart/form-data"
                      class="p-6 space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Photo Section -->
                        <div class="space-y-4">
                        <div class="relative rounded-lg overflow-hidden bg-gray-100">
        @if(!empty($detailSarpras->foto) && $detailSarpras->photo_count > 0)
            <img src="{{ Storage::url($detailSarpras->foto[0]) }}" 
                 alt="Foto Utama"
                 id="mainImage"
                 class="w-full h-64 object-cover">
            <div class="absolute top-2 right-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded-full text-xs">
                {{ $detailSarpras->photo_count }}/3 Foto
            </div>
        @else
            <div class="flex items-center justify-center h-64">
                <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
    </div>

    <!-- Thumbnails -->
    @if(!empty($detailSarpras->foto) && $detailSarpras->photo_count > 0)
        <div class="grid grid-cols-3 gap-2" id="imageGrid">
            @foreach($detailSarpras->foto as $index => $foto)
                <div class="relative group">
                    <div class="aspect-w-4 aspect-h-3">
                        <img src="{{ Storage::url($foto) }}" 
                             alt="Thumbnail" 
                             data-index="{{ $index }}"
                             class="w-full h-20 object-cover cursor-pointer rounded-lg border-2 {{ $index === 0 ? 'border-yellow-500' : 'border-transparent' }}">
                    </div>
                    <button type="button"
                            data-index="{{ $index }}"
                            class="delete-photo absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 opacity-0 group-hover:opacity-100">
                        ×
                    </button>
                </div>
            @endforeach
        </div>
    @endif

                            <!-- Upload -->
                            <div class="mt-4">
                                <label class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 cursor-pointer">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 4v16m8-8H4" />
                                    </svg>
                                    Upload Foto
                                    <input type="file"
                                           name="photos[]"
                                           multiple
                                           class="hidden"
                                           accept="image/jpeg,image/png,image/jpg"
                                           id="photoInput">
                                </label>
                                <span class="ml-3 text-xs text-gray-600" id="fileCount">
                                    Maksimal 3 foto (512KB per foto)
                                </span>
                            </div>
                            <div id="previewContainer" class="grid grid-cols-3 gap-2 hidden"></div>
                        </div>

                        <!-- Form Fields -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Luas (m²)</label>
                                <div class="relative rounded-lg">
                                    <input type="text" 
                                           name="luas" 
                                           value="{{ $detailSarpras->luas }}" 
                                           pattern="[0-9]*[.]?[0-9]+"
                                           onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46"
                                           class="block w-full rounded-lg border-gray-300 pr-10 focus:border-yellow-500"
                                           placeholder="Contoh: 43.54">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi</label>
                                <select name="kondisi" 
                                        class="block w-full rounded-lg border-gray-300 focus:border-yellow-500">
                                    @foreach(App\Models\DetailSarpras::KONDISI as $kondisi)
                                        <option value="{{ $kondisi }}" 
                                                {{ $detailSarpras->kondisi == $kondisi ? 'selected' : '' }}>
                                            {{ $kondisi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                                <textarea name="keterangan" 
                                          rows="4"
                                          class="block w-full rounded-lg border-gray-300 focus:border-yellow-500"
                                          placeholder="Tambahkan keterangan detail...">{{ $detailSarpras->keterangan }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6 border-t">
                        <button type="submit" 
                                class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Container -->
    <div id="modalContainer"></div>

    @push('scripts')
    <script>
        // Modal Component
        const ConfirmationModal = ({ isOpen, onClose, onConfirm, title, message }) => {
            if (!isOpen) return null;

            return React.createElement('div', {
                className: 'fixed inset-0 z-50 overflow-y-auto'
            }, [
                // Backdrop
                React.createElement('div', {
                    className: 'fixed inset-0 bg-black bg-opacity-50 transition-opacity'
                }),
                
                // Modal
                React.createElement('div', {
                    className: 'flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0'
                }, [
                    React.createElement('div', {
                        className: 'relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg'
                    }, [
                        // Content
                        React.createElement('div', {
                            className: 'bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4'
                        }, [
                            React.createElement('div', {
                                className: 'sm:flex sm:items-start'
                            }, [
                                // Warning Icon
                                React.createElement('div', {
                                    className: 'mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10'
                                }, [
                                    React.createElement('svg', {
                                        className: 'h-6 w-6 text-red-600',
                                        fill: 'none',
                                        viewBox: '0 0 24 24',
                                        strokeWidth: '1.5',
                                        stroke: 'currentColor'
                                    }, [
                                        React.createElement('path', {
                                            strokeLinecap: 'round',
                                            strokeLinejoin: 'round',
                                            d: 'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z'
                                        })
                                    ])
                                ]),
                                
                                // Text Content
                                React.createElement('div', {
                                    className: 'mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left'
                                }, [
                                    React.createElement('h3', {
                                        className: 'text-base font-semibold leading-6 text-gray-900'
                                    }, title),
                                    React.createElement('div', {
                                        className: 'mt-2'
                                    }, [
                                        React.createElement('p', {
                                            className: 'text-sm text-gray-500'
                                        }, message)
                                    ])
                                ])
                            ])
                        ]),
                        
                        // Buttons
                        React.createElement('div', {
                            className: 'bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6'
                        }, [
                            React.createElement('button', {
                                type: 'button',
                                className: 'inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto',
                                onClick: onConfirm
                            }, 'Hapus'),
                            React.createElement('button', {
                                type: 'button',
                                className: 'mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto',
                                onClick: onClose
                            }, 'Batal')
                        ])
                    ])
                ])
            ]);
        };

        // Utilities
        const showAlert = (type, message) => {
            const alert = document.createElement('div');
            alert.className = `fixed top-4 right-4 z-50 max-w-md bg-${type}-50 border-l-4 border-${type}-400 p-4 rounded-md`;
            alert.innerHTML = `
                <div class="flex">
                    <p class="text-${type}-700">${message}</p>
                    <button onclick="this.closest('div').remove()" class="ml-auto text-${type}-400 hover:text-${type}-500">×</button>
                </div>
            `;
            document.body.appendChild(alert);
            setTimeout(() => alert.remove(), 5000);
        };

        const formatFileSize = bytes => {
            return bytes < 1024 ? bytes + ' bytes' : 
                   bytes < 1048576 ? (bytes / 1024).toFixed(1) + ' KB' : 
                   (bytes / 1048576).toFixed(1) + ' MB';
        };
        // Modal State Management
        let modalState = {
            isOpen: false,
            photoIndex: null
        };

        // Function to render modal
        const renderModal = () => {
            const root = ReactDOM.createRoot(document.getElementById('modalContainer'));
            root.render(React.createElement(ConfirmationModal, {
                isOpen: modalState.isOpen,
                onClose: () => {
                    modalState.isOpen = false;
                    renderModal();
                },
                onConfirm: () => {
                    const photoIndex = modalState.photoIndex;
                    modalState.isOpen = false;
                    renderModal();
                    
                    fetch(`{{ route('admin.sekolah.delete-photo-sarpras', ['sekolah' => $sekolah->id, 'detailSarpras' => $detailSarpras->id]) }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ photo_index: photoIndex })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) showAlert('error', data.error);
                        else location.reload();
                    })
                    .catch(() => showAlert('error', 'Gagal menghapus foto'));
                },
                title: "Konfirmasi Hapus",
                message: "Apakah Anda yakin ingin menghapus foto ini? Tindakan ini tidak dapat dibatalkan."
            }));
        };

        // Image Handlers
        document.getElementById('imageGrid')?.addEventListener('click', (e) => {
            const img = e.target.closest('img');
            if (img) {
                document.getElementById('mainImage').src = img.src;
                document.querySelectorAll('#imageGrid img').forEach(thumb => {
                    thumb.classList.toggle('border-yellow-500', thumb === img);
                    thumb.classList.toggle('border-transparent', thumb !== img);
                });
            }

            const deleteBtn = e.target.closest('.delete-photo');
            if (deleteBtn) {
                modalState.isOpen = true;
                modalState.photoIndex = deleteBtn.dataset.index;
                renderModal();
            }
        });

        // File Upload Handler
        document.getElementById('photoInput')?.addEventListener('change', function() {
            const files = Array.from(this.files);
            const maxFiles = 3;
            const maxSize = 512 * 1024;
            const currentCount = document.querySelectorAll('#imageGrid > div').length;

            if (files.length + currentCount > maxFiles) {
                showAlert('error', `Maksimal ${maxFiles} foto`);
                this.value = '';
                return;
            }

            const oversizedFiles = files.filter(f => f.size > maxSize);
            if (oversizedFiles.length) {
                showAlert('error', 'File terlalu besar: ' + oversizedFiles.map(f => f.name).join(', '));
                this.value = '';
                return;
            }

            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = '';
            previewContainer.classList.remove('hidden');

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    previewContainer.insertAdjacentHTML('beforeend', `
                        <div class="relative">
                            <img src="${e.target.result}" class="w-full h-20 object-cover rounded-lg" alt="Preview">
                            <button type="button" 
                                    onclick="this.closest('div').remove()"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5">×</button>
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1">
                                ${file.name.slice(0, 15)}... (${formatFileSize(file.size)})
                            </div>
                        </div>
                    `);
                };
                reader.readAsDataURL(file);
            });

            document.getElementById('fileCount').textContent = 
                `${currentCount + files.length} dari ${maxFiles} foto (512KB per foto)`;
        });

        // Form Submit Handler
        document.getElementById('updateForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Menyimpan...
            `;
        });
    </script>
    @endpush
</x-admin-app-layout>