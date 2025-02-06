<x-superadmin-app-layout>
    <div class="p-8">
        <!-- Welcome Message -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">
                Selamat Datang, {{ Auth::guard('super_admin')->user()->name }}
            </h1>
            <p class="text-gray-600 mt-1">
                {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </p>
        </div>

        <!-- Stats Dashboard -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mb-8">
            <!-- TK Schools -->
            <div class="bg-yellow-500 rounded-lg p-8 text-white shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="text-6xl font-bold mb-4">{{ $stats['tkCount'] }}</div>
                <p class="text-base">Total Sekolah TK</p>
            </div>

            <!-- SD Schools -->
            <div class="bg-green-500 rounded-lg p-8 text-white shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="text-6xl font-bold mb-4">{{ $stats['sdCount'] }}</div>
                <p class="text-base">Total Sekolah SD</p>
            </div>

            <!-- SMP Schools -->
            <div class="bg-red-500 rounded-lg p-8 text-white shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="text-6xl font-bold mb-4">{{ $stats['smpCount'] }}</div>
                <p class="text-base">Total Sekolah SMP</p>
            </div>

            <!-- KIB Reports -->
            <div class="bg-purple-500 rounded-lg p-8 text-white shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="text-6xl font-bold mb-4">{{ $stats['kibCount'] }}</div>
                <p class="text-base">Total Laporan KIB</p>
            </div>
        </div>

        <!-- Activity Table -->
        <div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">AKTIVITAS TERBARU</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="text-left p-3">Aktivitas</th>
                    <th class="text-left p-3">Nama</th>
                    <th class="text-left p-3">Akun</th>
                    <th class="text-left p-3">Waktu</th>
                    <th class="text-left p-3">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $activity->description }}</td>
                        <td class="p-3">{{ $activity->name ?? '-' }}</td>
                        <td class="p-3">
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-medium">
                                {{ $activity->user->name ?? '-' }}
                            </span>
                        </td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($activity->created_at)->format('H:i') }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($activity->created_at)->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">
                            Belum ada aktivitas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
    </div>
</x-superadmin-app-layout>