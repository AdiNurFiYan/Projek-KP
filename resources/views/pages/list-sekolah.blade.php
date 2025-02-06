<x-app-layout>
    <!-- Header Section -->
    <div class="relative bg-cover bg-center h-64" style="background-image: url('/images/datasekolah.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-5xl font-bold text-white uppercase">{{ $title }}</h1>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Search Bar -->
            <div class="mb-6">
                <form action="{{ route('korwil.list-sekolah', ['korwil' => $korwil]) }}" method="GET" class="flex justify-center">
                    <div class="w-full max-w-xl relative">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search"
                            value="{{ $search ?? '' }}"
                            class="w-full px-4 py-2 border rounded-full focus:outline-none focus:border-blue-500"
                        >
                        <button type="submit" class="absolute right-3 top-2">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-500">
    Menampilkan daftar sekolah {{ $jenis ?? '' }} di wilayah {{ $korwil->nama }}
</div>
                    <div class="flex items-center">
                        <span class="mr-2">Per Page</span>
                        <select
                            onchange="window.location.href = this.value"
                            class="border rounded py-1"
                        >
                            @foreach([10, 25, 50, 100] as $size)
                                <option
                                    value="{{ request()->fullUrlWithQuery(['per_page' => $size]) }}"
                                    {{ request()->get('per_page', 10) == $size ? 'selected' : '' }}
                                >
                                    {{ $size }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <table class="min-w-full">
                    <thead>
                        <tr class="bg-blue-500">
                            <th class="px-6 py-3 text-left text-white font-semibold">No</th>
                            <th class="px-6 py-3 text-left text-white font-semibold">Nama Sekolah</th>
                            <th class="px-6 py-3 text-left text-white font-semibold">Jenis</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($sekolahs as $index => $sekolah)
                        <tr class="bg-[#FFB930] border-b border-white hover:bg-[#FFA500] cursor-pointer" 
                            onclick="window.location='{{ route('korwil.sarpras', ['korwil' => $korwil->id, 'sekolah' => $sekolah->id]) }}'">
                            <td class="px-6 py-4">{{ $sekolahs->firstItem() + $index }}</td>
                            <td class="px-6 py-4">{{ $sekolah->nama }}</td>
                            <td class="px-6 py-4">{{ $sekolah->jenis }}</td>
                            <td class="px-6 py-4 text-right">
                                <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center">Tidak ada data sekolah</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4 flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        @if($sekolahs->total() > 0)
                            Showing {{ $sekolahs->firstItem() }} to {{ $sekolahs->lastItem() }} of {{ $sekolahs->total() }}
                        @else
                            Showing 0 results
                        @endif
                    </div>
                    <div class="flex space-x-1">
                        {{ $sekolahs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>