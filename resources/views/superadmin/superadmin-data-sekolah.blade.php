<x-superadmin-app-layout>
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Data Koordinator Wilayah</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($korwils as $korwil)
            <div class="bg-white rounded-lg border shadow-sm hover:shadow-md transition-shadow">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">{{ $korwil->nama }}</h3>
                    <div class="flex justify-end">
                        <a href="{{ route('super-admin.sekolah.sarpras', $korwil) }}" 
                           class="inline-flex items-center px-4 py-2 bg-red-800 text-white rounded-md hover:bg-red-700 transition-colors">
                            <span>Lihat Data</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-6">
                <p class="text-gray-600">Tidak ada koordinator wilayah yang ditemukan.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-6">
            {{ $korwils->links() }}
        </div>
    </div>
</x-superadmin-app-layout>