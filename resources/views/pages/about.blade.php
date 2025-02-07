<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-red-700 to-red-500 text-white py-16">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold text-center mb-4">ABOUT</h1>
                <div class="w-24 h-1 bg-white mx-auto"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-12">
            @if(session('success'))
            <div class="mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md shadow">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md shadow">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Edit Mode Toggle Button -->
            @auth
            <div class="mb-8 flex justify-end sticky top-4 z-50">
                <button onclick="toggleEditMode()" class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-4 py-2 rounded-md shadow-lg flex items-center gap-2 transition-transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9"></path>
                    </svg>
                    <span id="editButtonText">Edit Mode</span>
                </button>
            </div>
            @endauth

            <!-- View Mode Content -->
            <div id="viewMode" class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left Column - Text Content -->
                <div class="space-y-12">
                    <!-- Sejarah Section -->
                    <div class="bg-white rounded-lg shadow-lg p-8 border-l-4 border-red-600">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">Sejarah</h2>
                        <div class="prose lg:prose-lg text-gray-600">
                            {!! $about->content ?? 'No content available.' !!}
                        </div>
                    </div>

                    <!-- Nama Pimpinan Section -->
                    <div class="bg-white rounded-lg shadow-lg p-8 border-l-4 border-blue-600">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">Pimpinan</h2>
                        <div class="space-y-6">
                            @forelse($leaders as $leader)
                            <div class="p-6 bg-gray-50 rounded-lg border border-gray-200 transition-all hover:shadow-lg hover:bg-gray-100">
                                <div class="flex items-center gap-6">
                                    <div class="w-24 h-32 overflow-hidden rounded-lg">
                                        @if($leader->photo_path)
                                        <img src="{{ Storage::url($leader->photo_path) }}" alt="{{ $leader->name }}" class="w-full h-full object-cover" />
                                        @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold text-gray-800">{{ $leader->name }}</h3>
                                        <p class="text-gray-600 mt-1">{{ $leader->position }}</p>
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
                <div class="lg:mt-0 mt-8 space-y-8">
                    <!-- Kantor Image -->
                    <div class="bg-white p-4 rounded-lg shadow-lg border-l-4 border-green-600">
                        <h3 class="text-xl font-semibold mb-4 text-gray-800">Kantor Dinas Pendidikan</h3>
                        @if($about && $about->office_photo_path)
                        <img src="{{ Storage::url($about->office_photo_path) }}" alt="Kantor Dinas Pendidikan" class="w-full h-auto rounded-lg shadow-md object-cover" />
                        @else
                        <p class="text-gray-500">No office photo available.</p>
                        @endif
                    </div>

                    <!-- Location Section -->
                    <div class="bg-white p-4 rounded-lg shadow-lg border-l-4 border-yellow-600">
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
    </div>
</x-app-layout>
