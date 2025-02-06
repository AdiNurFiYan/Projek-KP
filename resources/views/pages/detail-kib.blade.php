<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $kibType->nama }}</h1>
                <p class="text-gray-600">{{ $kibType->deskripsi }}</p>
            </div>

            <!-- Daftar File -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Daftar File</h2>
                
                @if($kibs->isNotEmpty())
                    <div class="space-y-4">
                        @foreach($kibs as $kib)
                            <div class="flex items-center justify-between bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <div class="flex flex-col">
                                        <span class="text-gray-700">{{ $kib->nama_dokumen }}</span>
                                        <span class="text-sm text-gray-500">Diperbarui: {{ $kib->updated_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                <a href="{{ route('kib.download', $kib) }}" 
   style="background-color: #2ECB71;"
   class="inline-flex items-center px-4 py-2 text-white rounded-md transition-colors hover:opacity-90">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
    </svg>
    Download
</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="mt-4 text-gray-500 text-lg">Belum ada file untuk tipe KIB ini.</p>
                    </div>
                @endif
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-6">
                <a href="{{ route('data-barang') }}" 
                   style="background-color: #297BBF;" 
                   class="inline-flex items-center px-4 py-2 text-white rounded-md transition-colors hover:opacity-90">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Data Barang
                </a>
            </div>
        </div>
    </div>
</x-app-layout>