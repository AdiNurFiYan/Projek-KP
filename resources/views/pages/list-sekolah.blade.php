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
            <div class="overflow-hidden">
                <div class="flex justify-between items-center mb-6 gap-4">
                    <div class="text-sm text-gray-500">
                        Menampilkan daftar sekolah {{ $jenis ?? '' }} di wilayah {{ $korwil->nama }}
                    </div>
                    <select
                        onchange="window.location.href = this.value"
                        class="bg-white border border-blue-300 text-blue-600 rounded-lg pl-3 pr-8 py-1.5 cursor-pointer text-sm font-medium hover:border-blue-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 min-w-[80px]"
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

                <div class="rounded-[20px] overflow-hidden">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-4 bg-blue-500 text-left text-white font-semibold rounded-tl-[20px]">No</th>
                                <th class="px-6 py-4 bg-blue-500 text-left text-white font-semibold">Nama Sekolah</th>
                                <th class="px-6 py-4 bg-blue-500 text-left text-white font-semibold">Jenis</th>
                                <th class="px-6 py-4 bg-blue-500 rounded-tr-[20px]"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sekolahs as $index => $sekolah)
                                <tr class="bg-[#FFB930] hover:bg-[#FFA500] cursor-pointer transition-colors" 
                                    onclick="window.location='{{ route('korwil.sarpras', ['korwil' => $korwil->id, 'sekolah' => $sekolah->id]) }}'">
                                    <td class="px-6 py-4 text-black">{{ $sekolahs->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 text-black">{{ $sekolah->nama }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-4 py-1 bg-white text-black rounded-full text-sm">
                                            {{ $sekolah->jenis }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <svg class="w-6 h-6 inline-block text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center bg-gray-50">Tidak ada data sekolah</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

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