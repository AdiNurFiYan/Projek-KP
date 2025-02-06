<x-admin-app-layout>
    <div class="bg-white p-6 rounded-lg shadow">
        <!-- Header -->
        <div class="mb-10 bg-[#940000] p-4 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-white text-center">Tingkatan Sekolah</h2>
        </div>

        <!-- Grid Data -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($korwils as $korwil)
            <div class="bg-white rounded-lg border shadow-sm hover:shadow-lg transition-shadow duration-300 transform hover:-translate-y-1">
                <div class="p-6 flex flex-col justify-between h-full">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ $korwil->nama }}</h3>
                    <div class="flex justify-end">
                        <a href="{{ $korwil->nama == 'SD' || $korwil->tingkat == 'SD' ? route('admin.data.sekolah', $korwil) : route('admin.sekolah.sarpras', $korwil) }}" 
                           class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500 transition-all duration-300 shadow-md hover:shadow-lg">
                            <span>Lihat Data</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-admin-app-layout>