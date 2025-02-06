<x-admin-app-layout>
    <div class="bg-white p-6 rounded-lg shadow">
        <!-- Header -->
        <div class="mb-10 bg-[#940000] p-4 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-white text-center">Data Jenis KIB</h2>
        </div>

        <!-- Grid Data -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($kibTypes as $kibType)
            <div class="bg-white rounded-lg border shadow-sm hover:shadow-lg transition-shadow duration-300 transform hover:-translate-y-1 h-40">
                <div class="p-6 flex flex-col justify-between h-full">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $kibType->nama }}</h3>
                    <div class="flex justify-end">
                        <a href="{{ route('admin.kib.detail', $kibType) }}" 
                           class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500 transition-all duration-300 shadow-md hover:shadow-lg">
                            <span>Lihat Detail</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-6">
                <p class="text-gray-600">Tidak ada jenis KIB yang ditemukan.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $kibTypes->links() }}
        </div>
    </div>
</x-admin-app-layout>