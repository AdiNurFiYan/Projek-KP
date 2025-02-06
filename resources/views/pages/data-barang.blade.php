<x-app-layout>
    <!-- Header Section -->
    <div class="relative bg-cover bg-center min-h-[256px] " style="background-image: url('/images/databarang.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-5xl font-bold text-white uppercase drop-shadow-lg text-center">DATA BARANG</h1>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
                @forelse($kibTypes as $kibType)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset($kibType->gambar) ?? asset('images/default-kib.png') }}"
                             alt="{{ $kibType->nama }}"
                             class="w-full aspect-video object-cover rounded-t-lg">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $kibType->nama }}</h2>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($kibType->deskripsi, 150) }}</p>
                            <a href="{{ route('data-barang.show', ['kibType' => $kibType->id]) }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m12 0l-6-6m6 6l-6 6"></path>
                                </svg>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25"></path>
                        </svg>
                        <p class="text-gray-500 text-lg mt-4">Belum ada data barang.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
