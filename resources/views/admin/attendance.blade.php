<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-green-950">Data Absensi</h1>
            <p class="text-gray-500 mt-1">Rekap kehadiran, izin, dan alpa karyawan.</p>
        </div>

        {{-- SEARCH --}}
<div class="mb-5">
    <form method="GET" action="{{ route('admin.attendance.index') }}">
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
                <a href="{{ route('admin.attendance.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl font-semibold text-center">
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-green-950 text-white">
                        <tr>
                            <th class="p-4 text-left">Nama</th>
                            <th class="p-4 text-left">Tanggal</th>
                            <th class="p-4 text-left">Masuk</th>
                            <th class="p-4 text-left">Pulang</th>
                            <th class="p-4 text-left">Status</th>
                            <th class="p-4 text-left">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($attendances as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-semibold text-gray-800">
                                    {{ $item->user->name }}
                                </td>

                                <td class="p-4 text-gray-600">
                                    {{ $item->date }}
                                </td>

                                <td class="p-4 text-gray-600">
                                    {{ $item->check_in ?? '-' }}
                                </td>

                                <td class="p-4 text-gray-600">
                                    {{ $item->check_out ?? '-' }}
                                </td>

                                <td class="p-4">
                                    @if($item->status == 'hadir')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            HADIR
                                        </span>
                                    @elseif($item->status == 'izin')
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            IZIN
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ALPA
                                        </span>
                                    @endif
                                </td>

                                <td class="p-4">
                                    <a href="{{ route('admin.attendance.history', $item->user->id) }}"
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-xs font-semibold transition">
                                        Riwayat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-gray-500">
                                    Belum ada data absensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if(isset($users))
                <div class="p-5 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>