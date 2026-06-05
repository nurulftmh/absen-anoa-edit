<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-6">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-green-950">
                    Riwayat Absen
                </h1>
                <p class="text-gray-500 mt-1">
                    Lihat seluruh riwayat kehadiran, jam masuk, jam pulang, dan status absensi Anda.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">
                            Data Riwayat Absensi
                        </h2>
                        <p class="text-sm text-gray-500">
                            Data diurutkan dari tanggal terbaru.
                        </p>
                    </div>

                    <a href="{{ route('dashboard') }}"
                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-semibold">
                        Kembali
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-green-950 text-white">
                                <th class="px-5 py-4 text-left font-semibold">No</th>
                                <th class="px-5 py-4 text-left font-semibold">Tanggal</th>
                                <th class="px-5 py-4 text-left font-semibold">Jam Masuk</th>
                                <th class="px-5 py-4 text-left font-semibold">Jam Pulang</th>
                                <th class="px-5 py-4 text-left font-semibold">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($attendances as $item)
                                <tr class="hover:bg-green-50/70 transition">
                                    <td class="px-5 py-4 text-gray-600">
                                        {{ $loop->iteration + ($attendances->currentPage() - 1) * $attendances->perPage() }}
                                    </td>

                                    <td class="px-5 py-4 font-semibold text-gray-800">
                                        {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                    </td>

                                    <td class="px-5 py-4 text-gray-600">
                                        {{ $item->check_in ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4 text-gray-600">
                                        {{ $item->check_out ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4">
                                        @if($item->status == 'hadir')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                                HADIR
                                            </span>
                                        @elseif($item->status == 'izin')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                IZIN
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                                ALPA
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-14 text-center text-gray-500">
                                        Belum ada riwayat absensi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-5 border-t border-gray-100 bg-gray-50">
                    {{ $attendances->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>