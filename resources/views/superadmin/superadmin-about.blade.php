<x-superadmin-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Main Content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Manage About Page Content</h2>
                    
                    <div class="grid grid-cols-1 gap-8">
                        <!-- About Information Form -->
                        <div class="bg-white p-6 rounded-lg border">
                            <h3 class="text-xl font-semibold mb-4">About Information</h3>
                            <form action="{{ route('super-admin.about.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Content -->
                                <div class="mb-4">
                                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content (History)</label>
                                    <textarea id="content" name="content" rows="8" 
                                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        required
                                    >{{ old('content', $about->content ?? '') }}</textarea>
                                </div>

                                <!-- Office Photo -->
                                <div class="mb-4">
                                    <label for="office_photo" class="block text-sm font-medium text-gray-700 mb-1">Office Photo</label>
                                    @if($about && $about->office_photo_path)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($about->office_photo_path) }}" 
                                            alt="Current Office Photo" 
                                            class="aspect-[3/4] w-48 object-cover rounded">
                                    </div>
                                    @endif
                                    <input type="file" id="office_photo" name="office_photo" 
                                        class="w-full border border-gray-300 rounded-md shadow-sm" 
                                        accept="image/*">
                                    <div id="office_photo_preview" class="mt-2 hidden">
                                        <img class="aspect-[3/4] w-48 object-cover rounded" alt="New Office Photo Preview">
                                    </div>
                                </div>

                                <!-- Google Maps Embed -->
                                <div class="mb-4">
                                    <label for="embed_map_code" class="block text-sm font-medium text-gray-700 mb-1">Google Maps Embed Code</label>
                                    <textarea id="embed_map_code" name="embed_map_code" rows="4" 
                                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    >{{ old('embed_map_code', $about->embed_map_code ?? '') }}</textarea>
                                    <p class="mt-1 text-sm text-gray-500">Paste the embed code from Google Maps here</p>
                                </div>

                                <!-- Address -->
                                <div class="mb-4">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <textarea id="address" name="address" rows="3" 
                                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    >{{ old('address', $about->address ?? '') }}</textarea>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Update About Information
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Leaders Section -->
                        <div class="bg-white p-6 rounded-lg border">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold">Leaders Information</h3>
                                <button onclick="openAddModal()" 
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Add New Leader
                                </button>
                            </div>

                            <!-- Leaders List -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($leaders as $leader)
                                <div class="border rounded-lg p-4">
                                    <div class="flex flex-col space-y-4">
                                        @if($leader->photo_path)
                                        <img src="{{ Storage::url($leader->photo_path) }}" 
                                            alt="{{ $leader->name }}" 
                                            class="w-36 h-48 object-cover rounded mx-auto">
                                        @endif
                                        <div>
                                            <h4 class="font-semibold text-lg">{{ $leader->name }}</h4>
                                            <p class="text-gray-600">{{ $leader->position }}</p>
                                            <p class="text-sm text-gray-500">{{ $leader->period_start }} - {{ $leader->period_end }}</p>
                                            <div class="mt-4 space-x-2">
                                                <button onclick="openEditModal({{ $leader->id }})" 
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                    Edit
                                                </button>
                                                <button onclick="confirmDelete({{ $leader->id }})"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Leader Modal -->
    <div id="addLeaderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium mb-4">Add New Leader</h3>
                <form id="addLeaderForm" action="{{ route('super-admin.about.leader.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" required
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                        <input type="text" name="position" required
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                        <input type="file" name="photo" required accept="image/*"
                            class="w-full border border-gray-300 rounded-md shadow-sm" 
                            id="add_photo">
                        <div id="add_photo_preview" class="mt-2 hidden">
                            <img                             class="w-24 h-32 object-cover rounded" alt="New Photo Preview">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Period Start</label>
                            <input type="number" name="period_start" required min="1900" max="2100"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Period End</label>
                            <input type="number" name="period_end" required min="1900" max="2100"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Add Leader
                        </button>
                        <button type="button" onclick="closeAddModal()" 
                            class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Leader Modal -->
    <div id="editLeaderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium mb-4">Edit Leader</h3>
                <form id="editLeaderForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" id="edit_name" required
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                        <input type="text" name="position" id="edit_position" required
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                        <div id="current_photo" class="mb-2">
                            <img id="edit_photo_preview" class="w-24 h-32 object-cover rounded" alt="Current Photo">
                        </div>
                        <input type="file" name="photo" id="edit_photo" accept="image/*"
                            class="w-full border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Period Start</label>
                            <input type="number" name="period_start" id="edit_period_start" required min="1900" max="2100"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Period End</label>
                            <input type="number" name="period_end" id="edit_period_end" required min="1900" max="2100"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Leader
                        </button>
                        <button type="button" onclick="closeEditModal()" 
                            class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg font-medium mb-4">Confirm Delete</h3>
            <p class="text-gray-600 mb-4">Are you sure you want to delete this leader?</p>
            <div class="flex justify-center space-x-4">
                <button type="button" onclick="deleteLeader()" 
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Delete
                </button>
                <button type="button" onclick="closeDeleteModal()" 
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="fixed bottom-5 right-5 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 translate-y-full">
    <div id="toastContent" class="flex items-center"></div>
</div>

@push('scripts')
    <script>
        let currentLeaderId = null;

        // Toast notification system
        function showToast(message, isSuccess = true) {
            const toast = document.getElementById('toast');
            const toastContent = document.getElementById('toastContent');
            
            // Set toast style based on status
            toast.className = `fixed bottom-5 right-5 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 ${
                isSuccess ? 'bg-green-500' : 'bg-red-500'
            } text-white`;
            
            // Set message
            toastContent.innerHTML = `
                <span class="mr-2">${isSuccess ? '✓' : '✕'}</span>
                <span>${message}</span>
            `;
            
            // Show toast
            toast.classList.remove('translate-y-full');
            
            // Hide toast after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-y-full');
            }, 3000);
        }

        // Initialize image previews
        function initializeImagePreviews() {
            // Preview image before upload
            function previewImage(input, imgElement) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.src = e.target.result;
                        imgElement.parentElement.classList.remove('hidden');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Office photo preview
            const officePhotoInput = document.getElementById('office_photo');
            if (officePhotoInput) {
                officePhotoInput.addEventListener('change', function() {
                    const previewContainer = document.getElementById('office_photo_preview');
                    const preview = previewContainer.querySelector('img');
                    previewImage(this, preview);
                });
            }

            // Add photo preview
            const addPhotoInput = document.getElementById('add_photo');
            if (addPhotoInput) {
                addPhotoInput.addEventListener('change', function() {
                    const previewContainer = document.getElementById('add_photo_preview');
                    const preview = previewContainer.querySelector('img');
                    previewImage(this, preview);
                });
            }

            // Edit photo preview
            const editPhotoInput = document.getElementById('edit_photo');
            if (editPhotoInput) {
                editPhotoInput.addEventListener('change', function() {
                    const preview = document.getElementById('edit_photo_preview');
                    previewImage(this, preview);
                });
            }
        }

        // Modal functions for Add Leader
        function openAddModal() {
            document.getElementById('addLeaderModal').classList.remove('hidden');
            document.getElementById('addLeaderForm').reset();
            const previewContainer = document.getElementById('add_photo_preview');
            if (previewContainer) {
                previewContainer.classList.add('hidden');
            }
        }

        function closeAddModal() {
            document.getElementById('addLeaderModal').classList.add('hidden');
            document.getElementById('addLeaderForm').reset();
            const previewContainer = document.getElementById('add_photo_preview');
            if (previewContainer) {
                previewContainer.classList.add('hidden');
            }
        }

        // Modal functions for Edit Leader
        function openEditModal(leaderId) {
            // Fetch leader data
            fetch(`/super-admin/about/leader/${leaderId}/get`)
                .then(response => response.json())
                .then(leader => {
                    document.getElementById('edit_name').value = leader.name;
                    document.getElementById('edit_position').value = leader.position;
                    document.getElementById('edit_period_start').value = leader.period_start;
                    document.getElementById('edit_period_end').value = leader.period_end;
                    
                    const currentPhoto = document.getElementById('current_photo');
                    const photoPreview = document.getElementById('edit_photo_preview');
                    
                    if (leader.photo_path) {
                        currentPhoto.classList.remove('hidden');
                        photoPreview.src = `/storage/${leader.photo_path}`;
                    } else {
                        currentPhoto.classList.add('hidden');
                    }
                    
                    document.getElementById('editLeaderForm').action = `/super-admin/about/leader/${leaderId}/edit`;
                    document.getElementById('editLeaderModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching leader data:', error);
                    showToast('Error loading leader data. Please try again.', false);
                });
        }

        function closeEditModal() {
            document.getElementById('editLeaderModal').classList.add('hidden');
            document.getElementById('editLeaderForm').reset();
            const currentPhoto = document.getElementById('current_photo');
            if (currentPhoto) {
                currentPhoto.classList.add('hidden');
            }
        }

        // Modal functions for Delete Confirmation
        function confirmDelete(leaderId) {
            currentLeaderId = leaderId;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
            currentLeaderId = null;
        }

        function deleteLeader() {
    if (!currentLeaderId) return;
    
    // Show loading state
    const deleteBtn = document.querySelector('#deleteConfirmModal button[onclick="deleteLeader()"]');
    const originalText = deleteBtn.innerText;
    deleteBtn.disabled = true;
    deleteBtn.innerText = 'Deleting...';

    fetch(`/super-admin/about/leader/${currentLeaderId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, true);
            closeDeleteModal();
            // Tambahkan reload halaman setelah penghapusan berhasil
            window.location.reload();
        } else {
            throw new Error(data.message || 'Error deleting leader');
        }
    })
    .catch(error => {
        showToast(error.message || 'Error deleting leader. Please try again.', false);
    })
    .finally(() => {
        // Reset button state
        deleteBtn.disabled = false;
        deleteBtn.innerText = originalText;
    });
}

        // Close modals when clicking outside
        window.onclick = function(event) {
            const modals = [
                { element: document.getElementById('addLeaderModal'), closeFunc: closeAddModal },
                { element: document.getElementById('editLeaderModal'), closeFunc: closeEditModal },
                { element: document.getElementById('deleteConfirmModal'), closeFunc: closeDeleteModal }
            ];

            modals.forEach(modal => {
                if (event.target === modal.element) {
                    modal.closeFunc();
                }
            });
        }

        // Form validation
        function validateForm(form) {
            const periodStart = parseInt(form.querySelector('[name="period_start"]').value);
            const periodEnd = parseInt(form.querySelector('[name="period_end"]').value);

            if (periodEnd < periodStart) {
                showToast('Period End year must be greater than or equal to Period Start year', false);
                return false;
            }
            return true;
        }

        // Add form validation to all forms
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize image previews
            initializeImagePreviews();

            // Add validation to forms
            const forms = ['addLeaderForm', 'editLeaderForm'];
            forms.forEach(formId => {
                const form = document.getElementById(formId);
                if (form) {
                    form.addEventListener('submit', function(e) {
                        if (!validateForm(this)) {
                            e.preventDefault();
                        }
                    });
                }
            });
        });
    </script>
@endpush
</x-superadmin-app-layout>