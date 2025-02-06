<x-superadmin-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Daftar Akun Admin</h2>
                        <button onclick="openModal()" class="bg-[#297BBF] text-white px-4 py-2 rounded-md hover:bg-[#64B5F6] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#297BBF]">
                            Tambah Admin
                        </button>
                    </div>

                    <!-- Alert Success -->
                    <div id="alertSuccess" class="fixed top-4 right-4 z-50 mb-4 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-lg hidden transform transition-transform duration-300 ease-in-out" role="alert">
                        <div class="flex items-center">
                            <div class="py-1">
                                <svg class="w-6 h-6 mr-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="block sm:inline" id="alertMessage"></span>
                        </div>
                    </div>

                    <!-- Admin List Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($admins as $index => $admin)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $admin->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $admin->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Aktif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button onclick="openEditModal({{ $admin->id }}, '{{ $admin->name }}', '{{ $admin->email }}')" 
                                            class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</button>
                                        <button onclick="openDeleteModal({{ $admin->id }})" 
                                            class="text-red-600 hover:text-red-900">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Admin Registration -->
    <div id="registrationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="text-center mb-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Admin Baru</h3>
                    <div class="mt-2 px-7 py-3">
                        <form id="registerForm" class="space-y-4">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input id="name" type="text" name="name" required 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input id="email" type="email" name="email" required 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input id="password" type="password" name="password" required 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" required 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            </div>

                            <div class="flex justify-end space-x-3 mt-6">
                                <button type="button" onclick="closeModal()" 
                                    class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Batal
                                </button>
                                <button type="submit" 
                                    class="bg-[#297BBF] text-white px-4 py-2 rounded-md hover:bg-[#64B5F6] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#297BBF]">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit Admin -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="text-center mb-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Admin</h3>
                    <div class="mt-2 px-7 py-3">
                        <form id="editForm" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_admin_id">
                            <div>
                                <label for="edit_name" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input id="edit_name" type="text" name="name" required 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            </div>

                            <div>
                                <label for="edit_email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input id="edit_email" type="email" name="email" required 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            </div>

                            <div>
                                <label for="edit_password" class="block text-sm font-medium text-gray-700">Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input id="edit_password" type="password" name="password"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            </div>

                            <div>
                                <label for="edit_password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                                <input id="edit_password_confirmation" type="password" name="password_confirmation"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#297BBF] focus:border-[#297BBF]">
                            </div>

                            <div class="flex justify-end space-x-3 mt-6">
                                <button type="button" onclick="closeEditModal()" 
                                    class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Batal
                                </button>
                                <button type="submit" 
                                    class="bg-[#297BBF] text-white px-4 py-2 rounded-md hover:bg-[#64B5F6] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#297BBF]">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modified Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="text-center">
                    <svg class="mx-auto mb-4 w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Konfirmasi Hapus</h3>
                    <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menghapus admin ini?</p>
                    <input type="hidden" id="delete_admin_id">
                    <div class="flex justify-center space-x-4">
                        <button type="button" onclick="closeDeleteModal()" 
                            class="bg-gray-200 text-gray-800 px-6 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <button onclick="confirmDelete()" 
                            class="bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function showAlert(message) {
            const alert = document.getElementById('alertSuccess');
            const alertMessage = document.getElementById('alertMessage');
            alertMessage.textContent = message;
            alert.classList.remove('hidden');
            alert.classList.add('transform', 'translate-y-0');
            
            setTimeout(() => {
                alert.classList.add('translate-y-[-100%]');
                setTimeout(() => {
                    alert.classList.add('hidden');
                    alert.classList.remove('translate-y-[-100%]');
                }, 300);
            }, 3000);
        }

        function openModal() {
            document.getElementById('registrationModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('registrationModal').classList.add('hidden');
            document.getElementById('registerForm').reset();
        }

        function openEditModal(id, name, email) {
            document.getElementById('edit_admin_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_password').value = '';
            document.getElementById('edit_password_confirmation').value = '';
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editForm').reset();
        }

        function openDeleteModal(id) {
            document.getElementById('delete_admin_id').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('delete_admin_id').value = '';
        }

        // Form submission handlers
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch('{{ route("super-admin.akun.register") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();

                if(data.status === 'success') {
                    closeModal();
                    showAlert('Admin berhasil ditambahkan!');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    alert(data.message || 'Terjadi kesalahan saat menambahkan admin');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menambahkan admin');
            }
        });

        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const adminId = document.getElementById('edit_admin_id').value;
            
            try {
                const response = await fetch(`/super-admin/akun/${adminId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();

                if(data.status === 'success') {
                    closeEditModal();
                    showAlert('Data admin berhasil diperbarui!');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    alert(data.message || 'Terjadi kesalahan saat memperbarui admin');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui admin');
            }
        });

        async function confirmDelete() {
            const id = document.getElementById('delete_admin_id').value;
            
            try {
                const response = await fetch(`/super-admin/akun/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if(data.status === 'success') {
                    closeDeleteModal();
                    showAlert('Admin berhasil dihapus!');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    alert(data.message || 'Terjadi kesalahan saat menghapus admin');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus admin');
            }
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const modals = [
                document.getElementById('registrationModal'),
                document.getElementById('editModal'),
                document.getElementById('deleteModal')
            ];
            
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                    if (modal.id === 'registrationModal') {
                        document.getElementById('registerForm').reset();
                    } else if (modal.id === 'editModal') {
                        document.getElementById('editForm').reset();
                    }
                }
            });
        }
    </script>
    @endpush

</x-superadmin-app-layout>