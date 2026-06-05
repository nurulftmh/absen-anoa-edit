<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-6">

            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-green-950">
                        Riwayat Absensi Karyawan
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Riwayat absensi dari:
                        <span class="font-semibold text-gray-800">
                            {{ $user->name }}
                        </span>
                    </p>
                </div>

                <a href="{{ route('admin.attendance.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-semibold transition">
                    Kembali
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
<div class="mb-5">
    <form method="GET" action="{{ route('admin.attendance') }}">

        <div class="flex flex-col md:flex-row gap-3">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari nama atau email karyawan..."
                   class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-green-700 focus:ring-green-700">

            <button class="bg-green-800 hover:bg-green-900 text-white px-6 py-3 rounded-2xl font-semibold">
                Cari
            </button>

            @if(request('search'))
                <a href="{{ route('admin.attendance') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl font-semibold text-center">
                    Reset
                </a>
            @endif

        </div>

    </form>
</div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-green-950 text-white">
                                <th class="px-5 py-4 text-left font-semibold">Tanggal</th>
                                <th class="px-5 py-4 text-left font-semibold">Masuk</th>
                                <th class="px-5 py-4 text-left font-semibold">Pulang</th>
                                <th class="px-5 py-4 text-left font-semibold">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($attendances as $item)
                                <tr class="hover:bg-green-50/70 transition">

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
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                                HADIR
                                            </span>
                                        @elseif($item->status == 'izin')
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold border border-yellow-200">
                                                IZIN
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold border border-red-200">
                                                ALPA
                                            </span>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-14 text-center text-gray-500">
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