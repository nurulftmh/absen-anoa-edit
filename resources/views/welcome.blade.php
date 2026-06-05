<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Anoa Sejahtera Mandiri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-900">

<div class="relative min-h-screen overflow-hidden">

    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/bg.jpg') }}"
             alt="Office Background"
             class="w-full h-full object-cover opacity-70">
        <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 to-white/30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/20 via-transparent to-transparent"></div>
    </div>

    <!-- Decorative Accents -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-green-900/20 rounded-full blur-3xl"></div>
    <div class="absolute top-40 right-10 w-72 h-72 bg-yellow-500/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-green-700/10 rounded-full blur-3xl"></div>

    <!-- Navbar -->
    <nav class="relative z-10 flex items-center justify-between px-6 md:px-16 py-6">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}"
                 alt="Logo PT Anoa Sejahtera Mandiri"
                 class="w-12 h-12 object-contain">
            <div>
                <p class="font-bold text-green-950 leading-tight">PT ANOA</p>
                <p class="text-xs text-slate-600">Sejahtera Mandiri</p>
            </div>
        </div>

        <div>
            @auth
                <a href="{{ route('dashboard') }}"
                   class="px-5 py-2.5 rounded-full bg-green-900 text-white text-sm font-medium shadow hover:bg-green-800 transition">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-5 py-2.5 rounded-full bg-green-900 text-white text-sm font-medium shadow hover:bg-green-800 transition">
                    Login
                </a>
            @endauth
        </div>
    </nav>

    <!-- Hero -->
    <main class="relative z-10 px-6 md:px-16 pt-12 md:pt-24">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">

            <!-- Left Content -->
            <section>
                <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur px-4 py-2 rounded-full shadow-sm border border-white/70 mb-6">
                    <span class="w-2 h-2 rounded-full bg-green-700"></span>
                    <span class="text-sm text-slate-700">Sistem Absensi Digital Perusahaan</span>
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-green-950">
                    Kelola Kehadiran dan Progres Kerja dengan Lebih Teratur
                </h1>

                <p class="mt-6 text-lg text-slate-600 max-w-xl leading-relaxed">
                    Platform internal untuk mencatat absen masuk, absen pulang, pengajuan izin,
                    status alpa, dan laporan progres kerja karyawan secara lebih rapi dan transparan.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="px-7 py-3 rounded-xl bg-green-900 text-white font-semibold shadow-lg hover:bg-green-800 transition">
                            Masuk Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-7 py-3 rounded-xl bg-green-900 text-white font-semibold shadow-lg hover:bg-green-800 transition">
                            Masuk Sistem
                        </a>

                        <a href="{{ route('register') }}"
                           class="px-7 py-3 rounded-xl bg-white/80 backdrop-blur text-green-900 font-semibold border border-green-900/10 shadow hover:bg-white transition">
                            Daftar Akun
                        </a>
                    @endauth
                </div>

                <!-- Feature Pills -->
                <div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-3 max-w-2xl">
                    <div class="bg-white/75 backdrop-blur rounded-xl p-4 shadow-sm border border-white/70">
                        <p class="text-sm font-semibold text-green-950">Absen Masuk</p>
                        <p class="text-xs text-slate-500 mt-1">Jam kerja tercatat</p>
                    </div>
                    <div class="bg-white/75 backdrop-blur rounded-xl p-4 shadow-sm border border-white/70">
                        <p class="text-sm font-semibold text-green-950">Absen Pulang</p>
                        <p class="text-xs text-slate-500 mt-1">Validasi 8 jam</p>
                    </div>
                    <div class="bg-white/75 backdrop-blur rounded-xl p-4 shadow-sm border border-white/70">
                        <p class="text-sm font-semibold text-green-950">Pengajuan Izin</p>
                        <p class="text-xs text-slate-500 mt-1">Approval admin</p>
                    </div>
                    <div class="bg-white/75 backdrop-blur rounded-xl p-4 shadow-sm border border-white/70">
                        <p class="text-sm font-semibold text-green-950">Progres Kerja</p>
                        <p class="text-xs text-slate-500 mt-1">Upload file kerja</p>
                    </div>
                </div>
            </section>

            <!-- Right Card -->
            <section class="relative">
                <div class="bg-white/85 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/80 p-8 md:p-10 max-w-md mx-auto">
                    <div class="flex justify-center">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Logo PT Anoa Sejahtera Mandiri"
                             class="w-40 h-40 object-contain drop-shadow">
                    </div>

                    <div class="text-center mt-4">
                        <h2 class="text-2xl font-bold text-green-950">
                            PT ANOA SEJAHTERA MANDIRI
                        </h2>
                        <p class="mt-3 text-slate-600 text-sm leading-relaxed">
                            Sistem absensi berbasis web untuk mendukung disiplin kerja,
                            pelaporan kegiatan, dan pengelolaan izin karyawan.
                        </p>
                    </div>

                    <div class="mt-8 space-y-3">
                        <div class="flex items-center justify-between bg-slate-50 rounded-xl px-4 py-3">
                            <span class="text-sm text-slate-600">Status Sistem</span>
                            <span class="text-sm font-semibold text-green-700">Aktif</span>
                        </div>

                        

                        <div class="flex items-center justify-between bg-slate-50 rounded-xl px-4 py-3">
                            <span class="text-sm text-slate-600">Fitur Utama</span>
                            <span class="text-sm font-semibold text-green-700">Absensi</span>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>
</div>

</body>
</html>