<x-app-layout>
    <!-- Header Section -->
    <div class="relative bg-cover bg-center h-64" style="background-image: url('/images/databarang.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-5xl font-bold text-white uppercase">DATA BARANG</h1>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($kibTypes as $kibType)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ $kibType->image_url ?? asset('images/default-kib.png') }}"
                             alt="{{ $kibType->nama }}"
                             class="w-full h-48 object-cover rounded-t-lg">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $kibType->nama }}</h2>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($kibType->deskripsi, 150) }}</p>
                            <a href="{{ route('data-barang.show', ['kibType' => $kibType->id]) }}" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                            Lihat Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p class="text-gray-500">Belum ada data barang.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>