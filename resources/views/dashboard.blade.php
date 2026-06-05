<x-app-layout>
     @if(isset($rejectedLeave) && $rejectedLeave)
        <div class="mb-5">
            <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="text-2xl">❌</div>

                    <div>
                        <h3 class="font-bold">
                            Pengajuan izin Anda ditolak
                        </h3>

                        <p class="text-sm mt-1">
                            Izin tanggal
                            <span class="font-semibold">
                                {{ \Carbon\Carbon::parse($rejectedLeave->date)->format('d M Y') }}
                            </span>
                            ditolak oleh pimpinan.
                        </p>

                        <p class="text-sm mt-1 text-red-700">
                            Alasan pengajuan: {{ $rejectedLeave->reason }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 py-8">
        <div class="px-6 max-w-7xl mx-auto">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-2xl mb-5 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl mb-5 shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl mb-5 shadow-sm">
                    <ul class="list-disc ms-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- HERO --}}
            <div class="relative overflow-hidden bg-green-950 rounded-[2rem] p-8 md:p-10 mb-8 shadow-xl shadow-green-950/15">
                <div class="absolute inset-0 bg-gradient-to-r from-green-950 via-green-900 to-emerald-800"></div>
                <div class="absolute -right-20 -top-20 w-72 h-72 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -left-20 -bottom-20 w-72 h-72 bg-emerald-300/10 rounded-full blur-2xl"></div>

                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-white/15 text-green-50 px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                            👋 Dashboard User
                        </div>

                        <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">
                            Selamat Datang, {{ auth()->user()->name }}
                        </h1>

                        <p class="text-green-100 mt-3 max-w-2xl leading-relaxed">
                            Kelola absensi harian, progres kerja, pengajuan izin, manuscript, dan buku
                            dalam satu halaman yang rapi.
                        </p>
                    </div>

                    <div class="flex items-center gap-4 bg-white/10 backdrop-blur rounded-3xl p-4 border border-white/10">
                        <img src="{{ asset('images/logo.png') }}"
                             class="w-16 h-16 object-contain bg-white rounded-2xl p-2 shadow">

                        <div>
                            <p class="text-green-100 text-sm">PT Anoa Sejahtera Mandiri</p>
                            <h2 class="text-white font-bold leading-tight">
                                Sistem Kerja Karyawan
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            {{-- STATUS HARI INI --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                <div class="lg:col-span-2 bg-white rounded-[2rem] p-7 border border-green-100 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                        <div>
                            <div class="inline-flex items-center gap-2 bg-green-50 text-green-800 px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                                Absensi Hari Ini
                            </div>

                            <h2 class="text-2xl font-extrabold text-green-950">
                                Status Kehadiran
                            </h2>

                            <p class="text-gray-500 mt-2 leading-relaxed">
                                Lakukan absen masuk sebelum bekerja dan absen pulang setelah 8 jam kerja.
                            </p>
                        </div>

                        <div>
                            @if(!$attendance)
                                <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-bold border border-gray-200">
                                    ⏳ Belum Absen
                                </span>
                            @elseif($attendance->status == 'hadir')
                                <span class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold border border-green-200">
                                    ✅ HADIR
                                </span>
                            @elseif($attendance->status == 'izin')
                                <span class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold border border-yellow-200">
                                    🟡 IZIN
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold border border-red-200">
                                    🔴 ALPA
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <div class="bg-green-50 rounded-3xl p-5 border border-green-100">
                            <p class="text-sm text-gray-500">Jam Masuk</p>
                            <p class="text-3xl font-extrabold text-green-950 mt-1">
                                {{ $attendance->check_in ?? '-' }}
                            </p>
                        </div>

                        <div class="bg-red-50 rounded-3xl p-5 border border-red-100">
                            <p class="text-sm text-gray-500">Jam Pulang</p>
                            <p class="text-3xl font-extrabold text-red-700 mt-1">
                                {{ $attendance->check_out ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        @if(!$attendance)
                            <form action="{{ route('attendance.checkin') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full md:w-auto bg-green-800 hover:bg-green-900 text-white font-bold px-8 py-3 rounded-2xl shadow-sm transition">
                                    Absen Masuk
                                </button>
                            </form>
                        @elseif(!$attendance->check_out && $attendance->status === 'hadir')
                            <form action="{{ route('attendance.checkout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full md:w-auto bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-3 rounded-2xl shadow-sm transition">
                                    Absen Pulang
                                </button>
                            </form>
                        @else
                            <div class="bg-gray-50 text-gray-600 p-4 rounded-2xl text-sm border border-gray-100">
                                Absensi hari ini sudah tercatat.
                            </div>
                        @endif
                    </div>
                </div>

                {{-- AKSES KERJA --}}
                <div class="bg-white rounded-[2rem] p-7 border border-green-100 shadow-sm">
                    <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                        Akses Kerja
                    </div>

                    <h2 class="text-2xl font-extrabold text-gray-900">
                        Modul Karyawan
                    </h2>

                    <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                        Buka halaman kerja sesuai kebutuhan tanpa banyak tombol di layar.
                    </p>

                    <div class="mt-6 space-y-3">
                        <a href="{{ route('work.progress.page') }}"
                           class="group flex items-center justify-between p-4 rounded-2xl bg-blue-50 hover:bg-blue-100 border border-blue-100 transition">
                            <div>
                                <p class="font-bold text-blue-800">Progres Kerja</p>
                                <p class="text-xs text-blue-600 mt-1">Upload progres dan file kerja</p>
                            </div>
                            <span class="text-blue-700 group-hover:translate-x-1 transition">→</span>
                        </a>

                        <a href="{{ route('manuscripts.index') }}"
                           class="group flex items-center justify-between p-4 rounded-2xl bg-indigo-50 hover:bg-indigo-100 border border-indigo-100 transition">
                            <div>
                                <p class="font-bold text-indigo-800">Manuscript</p>
                                <p class="text-xs text-indigo-600 mt-1">Kelola data manuscript</p>
                            </div>
                            <span class="text-indigo-700 group-hover:translate-x-1 transition">→</span>
                        </a>

                        <a href="{{ route('books.index') }}"
                           class="group flex items-center justify-between p-4 rounded-2xl bg-orange-50 hover:bg-orange-100 border border-orange-100 transition">
                            <div>
                                <p class="font-bold text-orange-800">Buku</p>
                                <p class="text-xs text-orange-600 mt-1">Kelola data buku</p>
                            </div>
                            <span class="text-orange-700 group-hover:translate-x-1 transition">→</span>
                        </a>

                        <a href="{{ route('published-books.index') }}"
                           class="group flex items-center justify-between p-4 rounded-2xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-100 transition">
                            <div>
                                <p class="font-bold text-emerald-800">Buku Terbit</p>
                                <p class="text-xs text-emerald-600 mt-1">Arsip PDF, sertifikat, dan cover</p>
                            </div>
                            <span class="text-emerald-700 group-hover:translate-x-1 transition">→</span>
                        </a>
                        
                    </div>

                </div>

            </div>

            {{-- IZIN DAN RIWAYAT --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- FORM IZIN --}}
                <div class="bg-white rounded-[2rem] p-7 border border-green-100 shadow-sm">
                    <div class="inline-flex items-center gap-2 bg-yellow-50 text-yellow-700 px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                        Pengajuan Izin
                    </div>

                    <h2 class="text-2xl font-extrabold text-gray-900">
                        Ajukan Izin
                    </h2>

                    <p class="text-gray-500 mt-2 text-sm leading-relaxed mb-6">
                        Kirim pengajuan izin kepada pimpinan untuk diproses.
                    </p>

                    <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Izin</label>
                        <input type="date"
                               name="date"
                               class="w-full border-gray-200 rounded-2xl shadow-sm focus:border-green-700 focus:ring-green-700 mb-4">

                        <label class="block text-sm font-bold text-gray-700 mb-2">Alasan Izin</label>
                        <textarea name="reason"
                                  rows="4"
                                  class="w-full border-gray-200 rounded-2xl shadow-sm focus:border-green-700 focus:ring-green-700 mb-4"
                                  placeholder="Contoh: Sakit / keperluan keluarga"></textarea>

                        <label class="block text-sm font-bold text-gray-700 mb-2">Upload Bukti</label>
                        <input type="file"
                               name="proof_file"
                               class="w-full border border-gray-200 rounded-2xl p-3 text-sm mb-5 bg-gray-50">

                        <button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 rounded-2xl shadow-sm transition">
                            Kirim Izin
                        </button>
                    </form>
                </div>

                {{-- RIWAYAT ABSENSI --}}
                <div class="bg-white rounded-[2rem] border border-green-100 shadow-sm overflow-hidden">
                    <div class="p-7 border-b border-gray-100">
                        <div class="inline-flex items-center gap-2 bg-green-50 text-green-800 px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                            Riwayat
                        </div>

                        <h2 class="text-2xl font-extrabold text-gray-900">
                            Riwayat Absensi
                        </h2>

                        <p class="text-gray-500 text-sm mt-2">
                            Data absensi terbaru kamu.
                        </p>
                    </div>

                    <div class="overflow-x-auto max-h-[400px] overflow-y-auto">
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
                                        <td class="px-5 py-4 text-gray-700 font-semibold">
                                            {{ $item->date }}
                                        </td>

                                        <td class="px-5 py-4 text-gray-600">
                                            {{ $item->check_in ?? '-' }}
                                        </td>

                                        <td class="px-5 py-4 text-gray-600">
                                            {{ $item->check_out ?? '-' }}
                                        </td>

                                        <td class="px-5 py-4">
                                            @if($item->status == 'hadir')
                                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-bold border border-green-200">
                                                    ✅ HADIR
                                                </span>
                                            @elseif($item->status == 'izin')
                                                <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-full text-xs font-bold border border-yellow-200">
                                                    🟡 IZIN
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1.5 rounded-full text-xs font-bold border border-red-200">
                                                    🔴 ALPA
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-20 h-20 rounded-full bg-green-50 flex items-center justify-center text-4xl mb-4">
                                                    📭
                                                </div>
                                                <h3 class="text-lg font-bold text-gray-800">
                                                    Belum ada data absensi
                                                </h3>
                                                <p class="text-gray-500 mt-1">
                                                    Riwayat absensi kamu akan tampil di sini.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>