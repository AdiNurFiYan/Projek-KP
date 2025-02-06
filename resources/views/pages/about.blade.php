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
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left Column - Text Content -->
                <div class="space-y-8">
                    <!-- Sejarah Section -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">Sejarah</h2>
                        <div class="prose lg:prose-lg text-gray-600">
                            <p class="leading-relaxed">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                        </div>
                    </div>

                    <!-- Nama Pimpinan Section -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">Nama Pimpinan</h2>
                        <div class="space-y-4">
                            <!-- Single Leader Card -->
                            <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex items-center gap-6">
                                    <div class="w-16 h-16 bg-red-700 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-800">Lorem ipsum dolor sit amet</h3>
                                        <p class="text-gray-600 mt-1">Kepala Dinas</p>
                                        <div class="flex items-center mt-2 text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Periode: 2020 - 2024
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Image -->
                <div class="lg:mt-0 mt-8">
                    <div class="sticky top-8">
                        <img 
                            src="/path-to-your-image.jpg" 
                            alt="Kantor Dinas Pendidikan" 
                            class="w-full h-auto rounded-lg shadow-xl object-cover"
                        />
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>