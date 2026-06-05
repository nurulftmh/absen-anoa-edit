<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 py-8">
        <div class="px-6 max-w-7xl mx-auto">

            {{-- HERO HEADER --}}
            <div class="relative overflow-hidden bg-green-950 rounded-[2rem] p-8 md:p-10 mb-8 shadow-xl shadow-green-950/15">
                <div class="absolute inset-0 bg-gradient-to-r from-green-950 via-green-900 to-emerald-800"></div>
                <div class="absolute -right-20 -top-20 w-72 h-72 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -left-20 -bottom-20 w-72 h-72 bg-emerald-300/10 rounded-full blur-2xl"></div>

                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-white/15 text-green-50 px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                            🛡️ Admin Panel
                        </div>

                        <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">
                            Dashboard Pimpinan
                        </h1>

                        <p class="text-green-100 mt-3 max-w-2xl leading-relaxed">
                            Kelola absensi, izin, progres kerja, manuscript, buku, dan data karyawan
                            PT Anoa Sejahtera Mandiri secara rapi dalam satu halaman.
                        </p>
                    </div>

                    <div class="flex items-center gap-4 bg-white/10 backdrop-blur rounded-3xl p-4 border border-white/10">
                        <img src="{{ asset('images/logo.png') }}"
                             class="w-16 h-16 object-contain bg-white rounded-2xl p-2 shadow">

                        <div>
                            <p class="text-green-100 text-sm">Sistem Internal</p>
                            <h2 class="text-white font-bold leading-tight">
                                PT Anoa Sejahtera Mandiri
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MENU UTAMA --}}
            <div class="mb-8">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Menu Pengelolaan</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Pilih modul yang ingin dikelola oleh admin.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    {{-- ABSENSI --}}
                    <a href="{{ route('admin.attendance.index') }}"
                       class="group relative overflow-hidden bg-white rounded-3xl p-6 border border-green-100 shadow-sm hover:shadow-xl hover:shadow-green-950/10 hover:-translate-y-1 transition">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-green-50 rounded-bl-full"></div>

                        <div class="relative">
                            <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-800 flex items-center justify-center text-2xl mb-5">
                                ✓
                            </div>

                            <h3 class="text-lg font-extrabold text-gray-900">Data Absensi</h3>
                            <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                                Pantau data hadir, izin, dan alpa karyawan secara terpusat.
                            </p>

                            <div class="mt-6 flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                    Modul Absensi
                                </span>
                                <span class="w-9 h-9 rounded-full bg-green-950 text-white flex items-center justify-center group-hover:translate-x-1 transition">
                                    →
                                </span>
                            </div>
                        </div>
                    </a>

                    {{-- IZIN --}}
                    <a href="{{ route('admin.leave.index') }}"
                       class="group relative overflow-hidden bg-white rounded-3xl p-6 border border-yellow-100 shadow-sm hover:shadow-xl hover:shadow-yellow-950/10 hover:-translate-y-1 transition">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-yellow-50 rounded-bl-full"></div>

                        <div class="relative">
                            <div class="w-14 h-14 rounded-2xl bg-yellow-100 text-yellow-700 flex items-center justify-center text-2xl mb-5">
                                !
                            </div>

                            <h3 class="text-lg font-extrabold text-gray-900">Pengajuan Izin</h3>
                            <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                                Tinjau, setujui, atau tolak pengajuan izin dari karyawan.
                            </p>

                            <div class="mt-6 flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                    Modul Izin
                                </span>
                                <span class="w-9 h-9 rounded-full bg-green-950 text-white flex items-center justify-center group-hover:translate-x-1 transition">
                                    →
                                </span>
                            </div>
                        </div>
                    </a>

                    {{-- PROGRES --}}
                    <a href="{{ route('admin.progress.index') }}"
                       class="group relative overflow-hidden bg-white rounded-3xl p-6 border border-blue-100 shadow-sm hover:shadow-xl hover:shadow-blue-950/10 hover:-translate-y-1 transition">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-blue-50 rounded-bl-full"></div>

                        <div class="relative">
                            <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl mb-5">
                                ↑
                            </div>

                            <h3 class="text-lg font-extrabold text-gray-900">Progres Kerja</h3>
                            <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                                Lihat progres kerja dan file yang diunggah oleh karyawan.
                            </p>

                            <div class="mt-6 flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                    Modul Progres
                                </span>
                                <span class="w-9 h-9 rounded-full bg-green-950 text-white flex items-center justify-center group-hover:translate-x-1 transition">
                                    →
                                </span>
                            </div>
                        </div>
                    </a>

                    {{-- MANUSCRIPT --}}
                    <a href="{{ route('admin.manuscripts.index') }}"
                       class="group relative overflow-hidden bg-white rounded-3xl p-6 border border-red-100 shadow-sm hover:shadow-xl hover:shadow-red-950/10 hover:-translate-y-1 transition">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-red-50 rounded-bl-full"></div>

                        <div class="relative">
                            <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-700 flex items-center justify-center text-2xl mb-5">
                                📄
                            </div>

                            <h3 class="text-lg font-extrabold text-gray-900">Data Manuscript</h3>
                            <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                                Kelola manuscript yang diunggah oleh karyawan.
                            </p>

                            <div class="mt-6 flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                    Modul Manuscript
                                </span>
                                <span class="w-9 h-9 rounded-full bg-green-950 text-white flex items-center justify-center group-hover:translate-x-1 transition">
                                    →
                                </span>
                            </div>
                        </div>
                    </a>

                    {{-- BUKU --}}
                    <a href="{{ route('admin.books.index') }}"
                       class="group relative overflow-hidden bg-white rounded-3xl p-6 border border-orange-100 shadow-sm hover:shadow-xl hover:shadow-orange-950/10 hover:-translate-y-1 transition">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-orange-50 rounded-bl-full"></div>

                        <div class="relative">
                            <div class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-700 flex items-center justify-center text-2xl mb-5">
                                📚
                            </div>

                            <h3 class="text-lg font-extrabold text-gray-900">Data Buku</h3>
                            <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                                Pantau data buku yang diinputkan oleh karyawan.
                            </p>

                            <div class="mt-6 flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                    Modul Buku
                                </span>
                                <span class="w-9 h-9 rounded-full bg-green-950 text-white flex items-center justify-center group-hover:translate-x-1 transition">
                                    →
                                </span>
                            </div>
                        </div>
                    </a>


                {{-- BUKU TERBIT --}}
                    <a href="{{ route('admin.published-books.index') }}"
                       class="group relative overflow-hidden bg-white rounded-3xl p-6 border border-emerald-100 shadow-sm hover:shadow-xl hover:shadow-emerald-950/10 hover:-translate-y-1 transition">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-emerald-50 rounded-bl-full"></div>

                        <div class="relative">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl font-bold mb-5">
                                BT
                            </div>

                            <h3 class="text-lg font-extrabold text-gray-900">Data Buku Terbit</h3>
                            <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                                Pantau arsip PDF buku, sertifikat, dan cover buku yang sudah terbit.
                            </p>

                            <div class="mt-6 flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                    Modul Buku Terbit
                                </span>
                                <span class="w-9 h-9 rounded-full bg-green-950 text-white flex items-center justify-center group-hover:translate-x-1 transition">
                                    →
                                </span>
                            </div>
                        </div>
                    </a>




                    {{-- USER --}}
                    <a href="{{ route('admin.users.index') }}"
                       class="group relative overflow-hidden bg-white rounded-3xl p-6 border border-purple-100 shadow-sm hover:shadow-xl hover:shadow-purple-950/10 hover:-translate-y-1 transition">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-purple-50 rounded-bl-full"></div>

                        <div class="relative">
                            <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center text-2xl mb-5">
                                👤
                            </div>

                            <h3 class="text-lg font-extrabold text-gray-900">Kelola Karyawan</h3>
                            <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                                Kelola akun, role, dan data user karyawan.
                            </p>

                            <div class="mt-6 flex items-center justify-between">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                                    Modul User
                                </span>
                                <span class="w-9 h-9 rounded-full bg-green-950 text-white flex items-center justify-center group-hover:translate-x-1 transition">
                                    →
                                </span>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

            {{-- COMPANY SUMMARY --}}
            <div class="bg-white rounded-[2rem] p-7 border border-green-100 shadow-sm">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-center">
                    <div class="lg:col-span-2">
                        <div class="inline-flex items-center gap-2 bg-green-50 text-green-800 px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                            Ringkasan Sistem
                        </div>

                        <h2 class="text-2xl font-extrabold text-green-950">
                            Sistem Absensi & Manajemen Kerja
                        </h2>

                        <p class="text-gray-500 mt-3 leading-relaxed">
                            Dashboard ini dirancang untuk membantu admin memantau aktivitas karyawan,
                            mulai dari kehadiran, izin, progres kerja, manuscript, buku, hingga pengelolaan akun
                            secara lebih terstruktur, bersih, dan profesional.
                        </p>
                    </div>

                    <div class="bg-gradient-to-br from-green-950 to-emerald-800 rounded-3xl p-6 text-white shadow-lg">
                        <p class="text-green-100 text-sm">Perusahaan</p>
                        <h3 class="text-xl font-bold mt-1">
                            PT Anoa Sejahtera Mandiri
                        </h3>
                        <p class="text-green-100 text-sm mt-4">
                            Panel admin internal untuk pengelolaan data karyawan.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>