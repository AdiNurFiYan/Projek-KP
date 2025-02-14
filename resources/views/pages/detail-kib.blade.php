<x-app-layout>
    <!-- Main container with responsive padding -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">
        <div class="bg-white shadow-lg rounded-xl p-4 sm:p-6 border border-gray-100">
            <!-- Header with responsive spacing and text sizes -->
            <div class="mb-6 sm:mb-8 pb-4 sm:pb-6 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-2">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $kibType->nama }}</h1>
                </div>
                <p class="text-gray-600 sm:ml-11">{{ $kibType->deskripsi }}</p>
            </div>

            <!-- Daftar File Section with improved responsive layout -->
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 sm:p-6 border border-gray-200">
                <div class="flex items-center mb-4 sm:mb-6">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">Daftar File</h2>
                </div>
                
                @if($kibs->isNotEmpty())
                    <div class="space-y-3 sm:space-y-4">
                        @foreach($kibs as $kib)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-white p-4 sm:p-5 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-100 gap-4">
                                <div class="flex items-start sm:items-center space-x-3 sm:space-x-4">
                                    <div class="bg-blue-50 p-2 sm:p-3 rounded-lg shrink-0">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-gray-800 font-medium break-words">{{ $kib->nama_dokumen }}</span>
                                        <div class="flex items-center text-sm text-gray-500 mt-1">
                                            <svg class="w-4 h-4 mr-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="truncate">Diperbarui: {{ $kib->updated_at->format('d M Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end sm:justify-center">
                                    <a href="{{ route('kib.download', $kib) }}" 
                                       class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-emerald-500 text-white rounded-lg transition-all duration-200 hover:bg-emerald-600 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                        <svg class="w-4 h-4 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 sm:py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                        <svg class="mx-auto h-12 w-12 sm:h-16 sm:w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="mt-4 text-gray-600 text-base sm:text-lg font-medium">Belum ada file untuk tipe KIB ini.</p>
                        <p class="mt-2 text-gray-500 text-sm sm:text-base">File yang diupload akan muncul di sini</p>
                    </div>
                @endif
            </div>

            <!-- Tombol Kembali with responsive styling -->
            <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-200">
                <a href="{{ route('data-barang') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-blue-600 text-white rounded-lg transition-all duration-200 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Data Barang
                </a>
            </div>
        </div>
    </div>
</x-app-layout>