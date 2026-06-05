<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-green-950">
                Pengajuan Izin
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola pengajuan izin karyawan.
            </p>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-2xl mb-5">
                {{ session('success') }}
            </div>
        @endif

        {{-- SEARCH --}}
        <div class="mb-5">
            <form method="GET" action="{{ route('admin.leave.index') }}">

                <div class="flex flex-col md:flex-row gap-3">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama, email, alasan izin, atau status..."
                           class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-green-700 focus:ring-green-700">

                    <button class="bg-green-800 hover:bg-green-900 text-white px-6 py-3 rounded-2xl font-semibold">
                        Cari
                    </button>

                    @if(request('search'))
                        <a href="{{ route('admin.leave.index') }}"
                           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl font-semibold text-center">
                            Reset
                        </a>
                    @endif

                </div>

            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    {{-- TABLE HEAD --}}
                    <thead class="bg-green-950 text-white">
                        <tr>
                            <th class="p-4 text-left">Nama</th>
                            <th class="p-4 text-left">Tanggal</th>
                            <th class="p-4 text-left">Alasan</th>
                            <th class="p-4 text-left">Bukti</th>
                            <th class="p-4 text-left">Status</th>
                            <th class="p-4 text-left">Setujui / Tolak</th>
                            <th class="p-4 text-left">permintaan Terbaru</th>
                        </tr>
                    </thead>

                    {{-- TABLE BODY --}}
                    <tbody class="divide-y divide-gray-100">

                        @forelse($requests as $item)

                            <tr class="hover:bg-gray-50 transition">

                                {{-- NAMA --}}
                                <td class="p-4 font-semibold text-gray-800">
                                    {{ $item->user->name ?? '-' }}
                                </td>

                                {{-- TANGGAL --}}
                                <td class="p-4 text-gray-600 whitespace-nowrap">
                                    {{ $item->date }}
                                </td>

                                {{-- ALASAN --}}
                                <td class="p-4 text-gray-600">
                                    {{ $item->reason }}
                                </td>

                                {{-- FILE --}}
                                <td class="p-4">

                                    @if($item->proof_file)

                                        <a href="{{ asset('storage/' . $item->proof_file) }}"
                                           target="_blank"
                                           class="text-blue-700 hover:text-blue-900 font-semibold">
                                            Lihat File
                                        </a>

                                    @else

                                        <span class="text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>

                                {{-- STATUS --}}
                                <td class="p-4">

                                    @if($item->status == 'approved')

                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                            Disetujui
                                        </span>

                                    @elseif($item->status == 'rejected')

                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                            Ditolak
                                        </span>

                                    @else

                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                                            Pending
                                        </span>

                                    @endif

                                </td>

                                {{-- SETUJUI / TOLAK --}}
                                <td class="p-4">

                                    <div class="flex gap-2 flex-wrap">

                                        {{-- APPROVE --}}
                                        <form action="{{ route('admin.leave.approve', $item->id) }}"
                                              method="POST">

                                            @csrf

                                            <button type="submit"
                                                    class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                                                Setujui
                                            </button>

                                        </form>

                                        {{-- REJECT --}}
                                        <form action="{{ route('admin.leave.reject', $item->id) }}"
                                              method="POST">

                                            @csrf

                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                                                Tolak
                                            </button>

                                        </form>

                                    </div>

                                </td>

                                {{-- AKSI --}}
                                <td class="p-4">

                                    @if($item->status == 'pending')

                                        <div class="flex gap-2 flex-wrap">

                                            {{-- APPROVE --}}
                                            <form action="{{ route('admin.leave.approve', $item->id) }}"
                                                  method="POST">

                                                @csrf

                                                <button type="submit"
                                                        class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                                                    Setujui
                                                </button>

                                            </form>

                                            {{-- REJECT --}}
                                            <form action="{{ route('admin.leave.reject', $item->id) }}"
                                                  method="POST">

                                                @csrf

                                                <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                                                    Tolak
                                                </button>

                                            </form>

                                        </div>

                                    @else

                                        <span class="text-gray-400 font-medium">
                                            Selesai
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="p-6 text-center text-gray-500">
                                    Belum ada pengajuan izin.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            <div class="p-5 border-t border-gray-100">
                {{ $requests->links() }}
            </div>

        </div>

    </div>
</x-app-layout>