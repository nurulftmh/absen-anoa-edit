<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 py-8">
        <div class="px-6 max-w-7xl mx-auto">
<div class="mb-5">
    <form method="GET" action="{{ route('admin.progress.index') }}">

        <div class="flex flex-col md:flex-row gap-3">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari nama karyawan atau progres kerja..."
                   class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-green-700 focus:ring-green-700">

            <button class="bg-green-800 hover:bg-green-900 text-white px-6 py-3 rounded-2xl font-semibold">
                Cari
            </button>

            @if(request('search'))
                <a href="{{ route('admin.progress.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl font-semibold text-center">
                    Reset
                </a>
            @endif

        </div>

    </form>
</div>
            {{-- HEADER --}}
            <div class="mb-8 bg-white/80 backdrop-blur rounded-3xl shadow-sm border border-green-100 p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-4 py-1.5 rounded-full text-sm font-semibold mb-3">
                            📋 Monitoring Progres
                        </div>

                        <h1 class="text-3xl md:text-4xl font-extrabold text-green-950 tracking-tight">
                            Progres Kerja Karyawan
                        </h1>

                        <p class="text-gray-500 mt-2 max-w-2xl">
                            Pantau laporan kerja, file lampiran, serta waktu pembaruan progres karyawan berdasarkan tanggal.
                        </p>
                    </div>

                    <div class="bg-green-950 text-white rounded-2xl px-6 py-4 shadow-md">
                        <p class="text-sm text-green-100">Total Progres</p>
                        <p class="text-3xl font-bold">{{ $progress->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- EMPTY STATE --}}
            @if($progress->count() == 0)
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-6 rounded-3xl shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="text-3xl">📭</div>
                        <div>
                            <h3 class="font-bold">Belum ada progres kerja</h3>
                            <p class="text-sm mt-1">Data progres karyawan yang masuk akan tampil di halaman ini.</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- GROUP BY DATE --}}
            @php
                $groupedProgress = $progress->groupBy(function ($item) {
                    return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
                });
            @endphp

            <div class="space-y-5">
                @foreach($groupedProgress as $date => $items)
                    <details class="group bg-white rounded-3xl border border-green-100 shadow-sm overflow-hidden">
                        <summary class="list-none cursor-pointer select-none">
                            <div class="flex items-center justify-between p-6 bg-gradient-to-r from-green-950 to-emerald-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-white/15 text-white flex items-center justify-center text-2xl border border-white/20">
                                        📅
                                    </div>

                                    <div>
                                        <h2 class="text-xl font-bold text-white">
                                            {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}
                                        </h2>

                                        <p class="text-sm text-green-100 mt-1">
                                            {{ $items->count() }} progres kerja
                                        </p>
                                    </div>
                                </div>

                                <div class="text-white text-2xl transition group-open:rotate-180">
                                    ⌄
                                </div>
                            </div>
                        </summary>

                        <div class="p-6 bg-gray-50">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                @foreach($items as $item)
                                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition">

                                        {{-- CARD HEADER --}}
                                        <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-white to-green-50">
                                            <div class="flex items-start justify-between gap-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-12 h-12 rounded-2xl bg-green-100 text-green-800 flex items-center justify-center text-xl font-bold">
                                                        {{ strtoupper(substr($item->attendance->user->name ?? 'U', 0, 1)) }}
                                                    </div>

                                                    <div>
                                                        <h2 class="font-bold text-gray-900 leading-tight">
                                                            {{ $item->attendance->user->name ?? 'User tidak ditemukan' }}
                                                        </h2>

                                                        <p class="text-xs text-gray-500 mt-1">
                                                            ID Progres #{{ $item->id }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">
                                                    Progres
                                                </span>
                                            </div>
                                        </div>

                                        {{-- BODY --}}
                                        <div class="p-5">

                                            {{-- TIME --}}
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                                                <div class="bg-green-50 rounded-2xl p-4 border border-green-100">
                                                    <p class="text-xs text-gray-500 mb-1">Diunggah</p>
                                                    <p class="text-sm font-bold text-green-950">
                                                        {{ $item->created_at->format('H:i') }}
                                                    </p>
                                                </div>

                                                <div class="bg-blue-50 rounded-2xl p-4 border border-blue-100">
                                                    <p class="text-xs text-gray-500 mb-1">Terakhir Diedit</p>
                                                    <p class="text-sm font-bold text-blue-900">
                                                        {{ $item->updated_at->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- DESCRIPTION --}}
                                            <div class="mb-5">
                                                <p class="text-sm font-bold text-gray-800 mb-2">
                                                    Deskripsi Progres
                                                </p>

                                                <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
                                                    <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                                                        {{ $item->description }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- FILES --}}
                                            <div>
                                                <div class="flex items-center justify-between mb-3">
                                                    <p class="text-sm font-bold text-gray-800">
                                                        Lampiran File
                                                    </p>

                                                    <span class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full">
                                                        {{ $item->files ? $item->files->count() : 0 }} file
                                                    </span>
                                                </div>

                                                @if($item->files && $item->files->count())
                                                    <div class="space-y-2">
                                                        @foreach($item->files as $file)
                                                            <a href="{{ asset('storage/' . $file->file_path) }}"
                                                               target="_blank"
                                                               class="flex items-center justify-between gap-3 bg-green-50 text-green-800 px-4 py-3 rounded-2xl hover:bg-green-100 border border-green-100 transition">
                                                                <div class="flex items-center gap-3 min-w-0">
                                                                    <div class="w-9 h-9 rounded-xl bg-white flex items-center justify-center shadow-sm">
                                                                        📎
                                                                    </div>

                                                                    <span class="truncate text-sm font-semibold">
                                                                        {{ $file->file_name }}
                                                                    </span>
                                                                </div>

                                                                <span class="shrink-0 text-xs font-bold">
                                                                    Buka →
                                                                </span>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="bg-gray-50 border border-dashed border-gray-200 rounded-2xl p-5 text-center">
                                                        <p class="text-gray-400 text-sm">
                                                            Tidak ada file lampiran.
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </details>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>