<x-app-layout>
    <!-- Header Section - Made responsive -->
    <div class="relative bg-cover bg-center h-40 sm:h-48 md:h-64" style="background-image: url('/images/datasekolah.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center px-4">
            <h1 class="text-2xl sm:text-3xl md:text-5xl font-bold text-white uppercase text-center">{{ $title }}</h1>
        </div>
    </div>

    <!-- Content Section - Added responsive padding -->
    <div class="container mx-auto px-3 sm:px-4 lg:px-8 py-4 md:py-8">
        <div class="bg-white rounded-lg shadow-lg p-3 sm:p-4 md:p-6">
            <!-- Search Bar - Made responsive -->
            <div class="mb-4 md:mb-6">
                <form id="search-form" action="{{ route('korwil.list-sekolah', ['korwil' => $korwil]) }}" method="GET" class="flex justify-center">
                    <div class="w-full max-w-xl relative">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search"
                            value="{{ $search ?? '' }}"
                            class="w-full px-3 sm:px-4 py-2 text-sm md:text-base border rounded-full focus:outline-none focus:border-blue-500"
                        >
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <!-- Header with School List Info and Per Page Dropdown -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-2 sm:space-y-0 mb-4">
                    <div class="text-xs sm:text-sm text-gray-500">
                        Menampilkan daftar sekolah {{ $jenis ?? '' }} di wilayah {{ $korwil->nama }}
                    </div>
                    <div class="flex items-center gap-1 self-start sm:self-auto">
                        <label class="text-xs sm:text-sm text-gray-500 whitespace-nowrap">Per page:</label>
                        <select 
                            name="per_page" 
                            onchange="this.form.submit()" 
                            class="border rounded-lg px-1 sm:px-2 py-1 text-xs sm:text-sm focus:outline-none focus:border-blue-500 min-w-[60px] sm:min-w-[70px]" 
                            form="search-form"
                        >
                            <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                </div>

                <div class="rounded-lg md:rounded-[20px] overflow-hidden">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-2 sm:px-4 md:px-6 py-3 md:py-4 bg-blue-500 text-left text-white font-semibold text-xs sm:text-sm rounded-tl-lg md:rounded-tl-[20px] whitespace-nowrap">No</th>
                                <th class="px-2 sm:px-4 md:px-6 py-3 md:py-4 bg-blue-500 text-left text-white font-semibold text-xs sm:text-sm">Nama Sekolah</th>
                                <th class="hidden sm:table-cell px-2 sm:px-4 md:px-6 py-3 md:py-4 bg-blue-500 text-left text-white font-semibold text-xs sm:text-sm">Jenis</th>
                                <th class="px-2 sm:px-4 md:px-6 py-3 md:py-4 bg-blue-500 rounded-tr-lg md:rounded-tr-[20px] w-10 sm:w-16"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sekolahs as $index => $sekolah)
                                <tr class="bg-[#FFB930] hover:bg-[#FFA500] cursor-pointer transition-colors" 
                                    onclick="window.location='{{ route('korwil.sarpras', ['korwil' => $korwil->id, 'sekolah' => $sekolah->id]) }}'">
                                    <td class="px-2 sm:px-4 md:px-6 py-3 md:py-4 text-black text-xs sm:text-sm md:text-base">{{ $sekolahs->firstItem() + $index }}</td>
                                    <td class="px-2 sm:px-4 md:px-6 py-3 md:py-4 text-black text-xs sm:text-sm md:text-base">{{ $sekolah->nama }}</td>
                                    <td class="hidden sm:table-cell px-2 sm:px-4 md:px-6 py-3 md:py-4">
                                        <span class="px-2 sm:px-3 md:px-4 py-1 bg-white text-black rounded-full text-xs sm:text-sm">
                                            {{ $sekolah->jenis }}
                                        </span>
                                    </td>
                                    <td class="px-2 sm:px-4 md:px-6 py-3 md:py-4 text-right">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 inline-block text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-2 sm:px-4 md:px-6 py-6 md:py-8 text-center bg-gray-50 text-xs sm:text-sm md:text-base">Tidak ada data sekolah</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Responsive Pagination -->
                <div class="mt-4 flex flex-col sm:flex-row justify-between items-center gap-3 sm:gap-0">
                    <div class="text-xs sm:text-sm text-gray-500 order-2 sm:order-1">
                        @if($sekolahs->total() > 0)
                        Showing {{ $sekolahs->firstItem() }} to {{ $sekolahs->lastItem() }} of {{ $sekolahs->total() }}
                        @else
                            Showing 0 results
                        @endif
                    </div>
                    
                    <!-- Pagination Controls -->
                    <div class="inline-flex items-center gap-1 sm:gap-2 order-1 sm:order-2">
                        @if ($sekolahs->onFirstPage())
                            <span class="px-2 sm:px-3 py-1 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $sekolahs->previousPageUrl() }}" class="px-2 sm:px-3 py-1 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors duration-200">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        @endif

                        @foreach ($sekolahs->getUrlRange(1, $sekolahs->lastPage()) as $page => $url)
                            @if ($page == $sekolahs->currentPage())
                                <span class="px-2 sm:px-3 py-1 rounded-lg bg-blue-600 text-white text-xs sm:text-sm">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="px-2 sm:px-3 py-1 rounded-lg hover:bg-blue-50 text-gray-600 hover:text-blue-600 transition-colors duration-200 text-xs sm:text-sm">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        @if ($sekolahs->hasMorePages())
                            <a href="{{ $sekolahs->nextPageUrl() }}" class="px-2 sm:px-3 py-1 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors duration-200">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <span class="px-2 sm:px-3 py-1 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>