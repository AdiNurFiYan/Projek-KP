<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="bg-red-700 text-white py-16">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold text-center mb-4">ABOUT</h1>
                <div class="w-24 h-1 bg-white mx-auto"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-12">
            @if(session('success'))
            <div class="mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Edit Mode Toggle Button (if user has permission) -->
            @auth
            <div class="mb-8 flex justify-end">
                <button onclick="toggleEditMode()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    <span id="editButtonText">Edit Mode</span>
                </button>
            </div>
            @endauth

            <!-- View Mode Content -->
            <div id="viewMode" class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left Column - Text Content -->
                <div class="space-y-8">
                    <!-- Sejarah Section -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">Sejarah</h2>
                        <div class="prose lg:prose-lg text-gray-600">
                            {!! $about->content ?? 'No content available.' !!}
                        </div>
                    </div>

                    <!-- Nama Pimpinan Section -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">Pimpinan</h2>
                        <div class="space-y-6">
                            @forelse($leaders as $leader)
                            <div class="p-6 bg-gray-50 rounded-lg border border-gray-200 transition-all hover:shadow-md">
                                <div class="flex items-center gap-6">
                                    <div class="shrink-0">
                                        <div class="w-24 h-32 overflow-hidden rounded-lg">
                                            @if($leader->photo_path)
                                            <img 
                                                src="{{ Storage::url($leader->photo_path) }}" 
                                                alt="{{ $leader->name }}" 
                                                class="w-full h-full object-cover"
                                            />
                                            @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold text-gray-800">{{ $leader->name }}</h3>
                                        <p class="text-gray-600 mt-1">{{ $leader->position }}</p>
                                        <div class="flex items-center mt-2 text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Periode: {{ $leader->period_start }} - {{ $leader->period_end }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500">Belum ada data pimpinan.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Column - Images and Location -->
                <div class="lg:mt-0 mt-8">
                    <div class="space-y-8">
                        <!-- Kantor Image -->
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <h3 class="text-xl font-semibold mb-4 text-gray-800">Kantor Dinas Pendidikan</h3>
                            @if($about && $about->office_photo_path)
                            <img 
                                src="{{ Storage::url($about->office_photo_path) }}" 
                                alt="Kantor Dinas Pendidikan" 
                                class="w-full h-auto rounded-lg shadow-md object-cover"
                            />
                            @else
                            <p class="text-gray-500">No office photo available.</p>
                            @endif
                        </div>

                        <!-- Location Section -->
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <h3 class="text-xl font-semibold mb-4 text-gray-800">Lokasi</h3>
                            @if($about && $about->embed_map_code)
                                {!! $about->embed_map_code !!}
                            @else
                            <p class="text-gray-500">No location map available.</p>
                            @endif
                            @if($about && $about->address)
                            <p class="mt-4 text-gray-600">{{ $about->address }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Mode Content -->
            <div id="editMode" class="hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- About Information Form -->
                    <div class="space-y-8">
                        <form <form action="{{ $leader ? route('about.leader.update', ['id' => $leader->id]) : route('about.leader.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
                            @csrf
                            <h2 class="text-3xl font-bold mb-6 text-gray-800">Edit Sejarah</h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Content</label>
                                    <textarea name="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('content', $about->content ?? '') }}</textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Office Photo</label>
                                    <input type="file" name="office_photo" class="mt-1 block w-full" accept="image/*">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Embed Map Code</label>
                                    <textarea name="embed_map_code" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('embed_map_code', $about->embed_map_code ?? '') }}</textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Address</label>
                                    <textarea name="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('address', $about->address ?? '') }}</textarea>
                                </div>
                                
                                <div>
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                        Update About Information
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Leader Information Form -->
                    <div class="space-y-8">
                        <!-- Leader Form - Use route for store if no leader ID, otherwise use update route -->
                        <form action="{{ $leader ? route('about.leader.update', $leader->id) : route('about.leader.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
                            @csrf
                            @if($leader)
                                @method('PUT')
                            @endif
                            <h2 class="text-3xl font-bold mb-6 text-gray-800">{{ $leader ? 'Edit' : 'Add' }} Pimpinan</h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $leader ? $leader->name : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Position</label>
                                    <input type="text" name="position" value="{{ old('position', $leader ? $leader->position : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                                    <input type="file" name="photo" class="mt-1 block w-full" accept="image/*" {{ $leader ? '' : 'required' }}>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Period Start</label>
                                        <input type="number" name="period_start" value="{{ old('period_start', $leader ? $leader->period_start : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required min="1900" max="2100">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Period End</label>
                                        <input type="number" name="period_end" value="{{ old('period_end', $leader ? $leader->period_end : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required min="1900" max="2100">
                                    </div>
                                </div>
                                
                                <div>
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                        {{ $leader ? 'Update' : 'Add' }} Leader Information
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleEditMode() {
            const viewMode = document.getElementById('viewMode');
            const editMode = document.getElementById('editMode');
            const editButtonText = document.getElementById('editButtonText');
            
            if (viewMode.classList.contains('hidden')) {
                viewMode.classList.remove('hidden');
                editMode.classList.add('hidden');
                editButtonText.textContent = 'Edit Mode';
            } else {
                viewMode.classList.add('hidden');
                editMode.classList.remove('hidden');
                editButtonText.textContent = 'View Mode';
            }
        }
    </script>
    @endpush
</x-app-layout>