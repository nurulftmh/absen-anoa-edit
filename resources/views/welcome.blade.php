<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT ANOA Sejahtera Mandiri | Penerbitan Buku dan Jurnal Kesehatan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        .hero-pattern {
            background:
                radial-gradient(circle at 10% 20%, rgba(212, 175, 55, 0.18), transparent 28%),
                radial-gradient(circle at 90% 10%, rgba(16, 185, 129, 0.18), transparent 30%),
                linear-gradient(135deg, #f8fafc 0%, #ffffff 45%, #ecfdf5 100%);
        }

        .gold-line {
            background: linear-gradient(90deg, #c59b2d, #f5d77a, #c59b2d);
        }
    </style>
</head>

<body class="bg-white text-gray-800">

    {{-- NAVBAR --}}
    <header class="fixed top-0 left-0 right-0 z-50 bg-green-950/95 backdrop-blur border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="#home" class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center shadow-lg p-1.5">
    <img src="{{ asset('images/logo.png') }}"
         alt="Logo PT ANOA Sejahtera Mandiri"
         class="w-full h-full object-contain">
</div>

                <div>
                    <h1 class="text-white font-extrabold leading-tight text-lg">
                        PT ANOA
                    </h1>
                    <p class="text-green-100 text-xs -mt-0.5">
                        Sejahtera Mandiri
                    </p>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-green-50">
                <a href="#home" class="hover:text-yellow-300 transition">Home</a>
                <a href="#tentang" class="hover:text-yellow-300 transition">Tentang Kami</a>
                <a href="#layanan" class="hover:text-yellow-300 transition">Layanan</a>
                <a href="#platform" class="hover:text-yellow-300 transition">Platform</a>
                <a href="#portofolio" class="hover:text-yellow-300 transition">Portofolio</a>
                <a href="#kontak" class="hover:text-yellow-300 transition">Kontak</a>
            </nav>

            <a href="#platform"
               class="hidden md:inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-green-950 font-bold px-5 py-3 rounded-2xl shadow transition">
                Platform Kami
            </a>
        </div>
    </header>

    {{-- HERO --}}
    <section id="home" class="pt-28 hero-pattern overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24 grid lg:grid-cols-2 gap-12 items-center">

            <div>
                <div class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-bold mb-5">
                    Penerbitan Buku & Jurnal Kesehatan
                </div>

                <h2 class="text-4xl md:text-6xl font-extrabold text-green-950 leading-tight">
                    Mitra Profesional Penerbitan Buku dan Jurnal Kesehatan
                </h2>

                <div class="w-32 h-1.5 gold-line rounded-full mt-6 mb-6"></div>

                <p class="text-gray-600 text-lg leading-relaxed max-w-xl">
                    PT ANOA Sejahtera Mandiri mendukung penulis, akademisi, institusi,
                    tenaga kesehatan, dan peneliti dalam menerbitkan karya ilmiah yang
                    kredibel, berkualitas, dan berdampak luas.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 mt-8">
                    <a href="#layanan"
                       class="bg-green-900 hover:bg-green-950 text-white font-bold px-7 py-4 rounded-2xl shadow transition text-center">
                        Lihat Layanan Kami
                    </a>

                    <a href="#platform"
                       class="bg-white hover:bg-green-50 text-green-950 border border-green-200 font-bold px-7 py-4 rounded-2xl shadow-sm transition text-center">
                        Kunjungi Platform
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-10">
                    <div class="flex items-center gap-2 text-sm font-semibold text-gray-600">
                        <span class="w-8 h-8 rounded-full bg-green-100 text-green-800 flex items-center justify-center">✓</span>
                        Profesional
                    </div>

                    <div class="flex items-center gap-2 text-sm font-semibold text-gray-600">
                        <span class="w-8 h-8 rounded-full bg-green-100 text-green-800 flex items-center justify-center">✓</span>
                        Berkualitas
                    </div>

                    <div class="flex items-center gap-2 text-sm font-semibold text-gray-600">
                        <span class="w-8 h-8 rounded-full bg-green-100 text-green-800 flex items-center justify-center">✓</span>
                        Terpercaya
                    </div>

                    <div class="flex items-center gap-2 text-sm font-semibold text-gray-600">
                        <span class="w-8 h-8 rounded-full bg-green-100 text-green-800 flex items-center justify-center">✓</span>
                        Berkelanjutan
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -top-8 -right-8 w-48 h-48 bg-yellow-300/30 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-8 -left-8 w-48 h-48 bg-green-400/20 rounded-full blur-3xl"></div>

                <div class="relative bg-white rounded-[2rem] shadow-2xl border border-green-100 overflow-hidden">
                    <div class="bg-green-950 p-5 flex items-center justify-between">
                        <div>
                            <p class="text-yellow-300 text-sm font-bold">Academic Publishing</p>
                            <h3 class="text-white text-xl font-extrabold">Book & Journal Services</h3>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center p-1.5 shadow">
    <img src="{{ asset('images/logo.png') }}"
         alt="Logo PT ANOA"
         class="w-full h-full object-contain">
</div>
                    </div>

                    <div class="p-7">
                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div class="h-32 rounded-2xl bg-gradient-to-br from-green-100 to-green-50 border border-green-100 p-4">
                                <div class="w-10 h-10 rounded-xl bg-green-800 mb-4"></div>
                                <div class="h-3 bg-green-800/30 rounded mb-2"></div>
                                <div class="h-3 bg-green-800/20 rounded w-2/3"></div>
                            </div>

                            <div class="h-32 rounded-2xl bg-gradient-to-br from-yellow-100 to-white border border-yellow-100 p-4">
                                <div class="w-10 h-10 rounded-xl bg-yellow-500 mb-4"></div>
                                <div class="h-3 bg-yellow-700/30 rounded mb-2"></div>
                                <div class="h-3 bg-yellow-700/20 rounded w-2/3"></div>
                            </div>

                            <div class="h-32 rounded-2xl bg-gradient-to-br from-emerald-100 to-white border border-emerald-100 p-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-700 mb-4"></div>
                                <div class="h-3 bg-emerald-700/30 rounded mb-2"></div>
                                <div class="h-3 bg-emerald-700/20 rounded w-2/3"></div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-3xl p-5 border border-gray-100">
                            <p class="text-sm font-bold text-green-950 mb-3">
                                Lingkup Layanan Penerbitan
                            </p>

                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-full bg-green-800 text-white flex items-center justify-center text-xs font-bold">1</span>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">Penerbitan Buku</p>
                                        <div class="h-2 bg-gray-300 rounded w-48 mt-1"></div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-full bg-green-800 text-white flex items-center justify-center text-xs font-bold">2</span>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">Pengelolaan Jurnal</p>
                                        <div class="h-2 bg-gray-300 rounded w-40 mt-1"></div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-full bg-green-800 text-white flex items-center justify-center text-xs font-bold">3</span>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">Publikasi Digital</p>
                                        <div class="h-2 bg-gray-300 rounded w-52 mt-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-5">
                            <a href="https://journal.anoasejahtera.com/ajst/login?source=%2Fajst%2Fsubmissions"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="text-center bg-green-900 hover:bg-green-950 text-white font-bold px-4 py-3 rounded-2xl transition text-sm">
                                Portal Jurnal
                            </a>

                            <a href="https://penerbiteureka.com/"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="text-center bg-yellow-500 hover:bg-yellow-400 text-green-950 font-bold px-4 py-3 rounded-2xl transition text-sm">
                                Portal Buku
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-8 bg-white rounded-t-[100%]"></div>
    </section>

    {{-- TENTANG KAMI --}}
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">

            <div class="relative rounded-[2rem] overflow-hidden shadow-xl border border-green-100 min-h-[420px]">
    <img src="{{ asset('images/gedung.png') }}"
         alt="Gedung PT ANOA Sejahtera Mandiri"
         class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-gradient-to-t from-green-950/90 via-green-950/40 to-transparent"></div>

    <div class="relative min-h-[420px] flex items-end p-8">
        <div>
            <div class="w-20 h-20 rounded-3xl bg-white flex items-center justify-center p-2 shadow-lg mb-6">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo PT ANOA"
                     class="w-full h-full object-contain">
            </div>

            <h3 class="text-4xl font-extrabold text-white leading-tight">
                PT ANOA <br> Sejahtera Mandiri
            </h3>

            <p class="text-green-100 mt-4 max-w-md">
                Mitra penerbitan buku dan jurnal kesehatan yang berorientasi pada
                kualitas, integritas, dan kontribusi ilmiah.
            </p>
        </div>
    </div>
</div>

            <div>
                <p class="text-yellow-600 font-extrabold uppercase tracking-wide mb-3">
                    Tentang Kami
                </p>

                <h2 class="text-3xl md:text-5xl font-extrabold text-green-950 leading-tight">
                    Membangun Ekosistem Publikasi Ilmiah yang Profesional
                </h2>

                <p class="text-gray-600 leading-relaxed mt-6">
                    PT ANOA Sejahtera Mandiri adalah perusahaan yang bergerak dalam bidang
                    penerbitan buku dan jurnal kesehatan. Kami hadir untuk mendukung
                    pengembangan karya ilmiah melalui layanan penerbitan yang profesional,
                    tertata, dan berorientasi pada mutu.
                </p>

                <p class="text-gray-600 leading-relaxed mt-4">
                    Kami mengelola kebutuhan penerbitan buku dan jurnal melalui pendekatan
                    editorial, desain, administrasi penerbitan, serta dukungan publikasi digital
                    agar karya dapat tersaji secara kredibel dan mudah diakses.
                </p>

                <div class="grid md:grid-cols-2 gap-5 mt-8">
                    <div class="bg-green-50 rounded-3xl p-6 border border-green-100">
                        <div class="w-12 h-12 rounded-2xl bg-green-800 text-white flex items-center justify-center text-2xl mb-4">
                            🎯
                        </div>

                        <h3 class="text-xl font-extrabold text-green-950 mb-2">Visi</h3>

                        <p class="text-gray-600 text-sm leading-relaxed">
                            Menjadi perusahaan penerbitan yang terpercaya dalam bidang buku
                            dan jurnal kesehatan yang berkualitas, inovatif, dan berdaya saing.
                        </p>
                    </div>

                    <div class="bg-yellow-50 rounded-3xl p-6 border border-yellow-100">
                        <div class="w-12 h-12 rounded-2xl bg-yellow-500 text-green-950 flex items-center justify-center text-2xl mb-4">
                            🚀
                        </div>

                        <h3 class="text-xl font-extrabold text-green-950 mb-2">Misi</h3>

                        <p class="text-gray-600 text-sm leading-relaxed">
                            Menyediakan layanan penerbitan profesional, mendukung publikasi
                            ilmiah, dan membangun kemitraan berkelanjutan dengan berbagai pihak.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LAYANAN --}}
    <section id="layanan" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-3xl mx-auto mb-12">
                <p class="text-yellow-600 font-extrabold uppercase tracking-wide mb-3">
                    Layanan Kami
                </p>

                <h2 class="text-3xl md:text-5xl font-extrabold text-green-950 leading-tight">
                    Solusi Penerbitan Terpercaya untuk Karya Berkualitas
                </h2>

                <p class="text-gray-600 mt-5 leading-relaxed">
                    Kami menyediakan layanan penerbitan yang dirancang untuk membantu karya
                    ilmiah tampil profesional, rapi, dan siap dipublikasikan.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm hover:shadow-xl transition">
                    <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-800 flex items-center justify-center text-3xl mb-5">
                        📘
                    </div>
                    <h3 class="text-xl font-extrabold text-green-950 mb-3">Penerbitan Buku</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Penerbitan buku akademik, referensi, monograf, buku ajar, dan buku umum
                        dengan tampilan profesional.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm hover:shadow-xl transition">
                    <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-800 flex items-center justify-center text-3xl mb-5">
                        🧾
                    </div>
                    <h3 class="text-xl font-extrabold text-green-950 mb-3">Penerbitan Jurnal Kesehatan</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Pendampingan pengelolaan dan penerbitan jurnal kesehatan dengan standar
                        editorial yang rapi dan kredibel.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm hover:shadow-xl transition">
                    <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-800 flex items-center justify-center text-3xl mb-5">
                        ✍️
                    </div>
                    <h3 class="text-xl font-extrabold text-green-950 mb-3">Layout & Editing</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Penataan naskah, copyediting, proofreading, dan desain layout agar karya
                        terlihat lebih rapi dan siap terbit.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm hover:shadow-xl transition">
                    <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-800 flex items-center justify-center text-3xl mb-5">
                        🔖
                    </div>
                    <h3 class="text-xl font-extrabold text-green-950 mb-3">ISBN & DOI Support</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Pendampingan kebutuhan identitas penerbitan seperti ISBN untuk buku dan
                        DOI untuk jurnal atau artikel.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm hover:shadow-xl transition">
                    <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-800 flex items-center justify-center text-3xl mb-5">
                        👥
                    </div>
                    <h3 class="text-xl font-extrabold text-green-950 mb-3">Editorial Assistance</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Pendampingan proses editorial, komunikasi naskah, dan penguatan kualitas
                        dokumen sebelum publikasi.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm hover:shadow-xl transition">
                    <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-800 flex items-center justify-center text-3xl mb-5">
                        💻
                    </div>
                    <h3 class="text-xl font-extrabold text-green-950 mb-3">Digital Publishing</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Publikasi digital, distribusi karya, e-book, dan penguatan tampilan karya
                        agar lebih mudah dijangkau pembaca.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- PLATFORM YANG DIKELOLA --}}
    <section id="platform" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-3xl mx-auto mb-12">
                <p class="text-yellow-600 font-extrabold uppercase tracking-wide mb-3">
                    Platform yang Kami Kelola
                </p>

                <h2 class="text-3xl md:text-5xl font-extrabold text-green-950 leading-tight">
                    Akses Jurnal dan Penerbitan Buku
                </h2>

                <p class="text-gray-600 mt-5 leading-relaxed">
                    PT ANOA Sejahtera Mandiri mengelola platform publikasi jurnal dan penerbitan
                    buku untuk mendukung kebutuhan akademik, penelitian, dan publikasi ilmiah.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">

                <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-green-950 to-emerald-800 p-8 shadow-xl">
                    <div class="absolute -right-16 -top-16 w-48 h-48 bg-yellow-300/20 rounded-full blur-3xl"></div>

                    <div class="relative">
                        <div class="w-16 h-16 rounded-3xl bg-yellow-500 text-green-950 flex items-center justify-center text-3xl mb-6">
                            🧾
                        </div>

                        <p class="text-yellow-300 font-extrabold uppercase tracking-wide text-sm mb-3">
                            Portal Jurnal
                        </p>

                        <h3 class="text-3xl font-extrabold text-white mb-4">
                            Anoa Journal of Science and Technology
                        </h3>

                        <p class="text-green-100 leading-relaxed mb-8">
                            Platform jurnal yang mendukung proses pengelolaan naskah,
                            publikasi ilmiah, dan administrasi jurnal secara digital.
                        </p>

                        <a href="https://journal.anoasejahtera.com/ajst/login?source=%2Fajst%2Fsubmissions"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center bg-yellow-500 hover:bg-yellow-400 text-green-950 font-extrabold px-6 py-4 rounded-2xl shadow transition">
                            Kunjungi Portal Jurnal
                        </a>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-yellow-50 to-white p-8 shadow-xl border border-yellow-100">
                    <div class="absolute -right-16 -top-16 w-48 h-48 bg-green-300/20 rounded-full blur-3xl"></div>

                    <div class="relative">
                        <div class="w-16 h-16 rounded-3xl bg-green-900 text-white flex items-center justify-center text-3xl mb-6">
                            📚
                        </div>

                        <p class="text-yellow-700 font-extrabold uppercase tracking-wide text-sm mb-3">
                            Penerbitan Buku
                        </p>

                        <h3 class="text-3xl font-extrabold text-green-950 mb-4">
                            Penerbit Eureka Media Aksara
                        </h3>

                        <p class="text-gray-600 leading-relaxed mb-8">
                            Platform penerbitan buku yang mendukung publikasi karya akademik,
                            buku ajar, referensi, monograf, dan berbagai karya ilmiah lainnya.
                        </p>

                        <a href="https://penerbiteureka.com/"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center bg-green-900 hover:bg-green-950 text-white font-extrabold px-6 py-4 rounded-2xl shadow transition">
                            Kunjungi Penerbit Buku
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- PORTOFOLIO --}}
    <section id="portofolio" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-3xl mx-auto mb-12">
                <p class="text-yellow-600 font-extrabold uppercase tracking-wide mb-3">
                    Portofolio Unggulan
                </p>

                <h2 class="text-3xl md:text-5xl font-extrabold text-green-950 leading-tight">
                    Ruang Karya dan Publikasi
                </h2>

                <p class="text-gray-600 mt-5 leading-relaxed">
                    Kami mendukung penerbitan karya ilmiah dalam bentuk buku, jurnal,
                    dan publikasi digital yang disusun secara profesional.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="rounded-3xl overflow-hidden bg-white border border-green-100 shadow-sm">
                    <div class="h-64 bg-gradient-to-br from-green-950 to-green-700 p-6 flex flex-col justify-between">
                        <p class="text-yellow-300 font-bold">BUKU KESEHATAN</p>
                        <h3 class="text-white text-2xl font-extrabold leading-tight">
                            Kesehatan Masyarakat
                        </h3>
                        <p class="text-green-100 text-sm">Teori dan Aplikasi</p>
                    </div>
                    <div class="p-5">
                        <p class="font-bold text-green-950">Kesehatan Masyarakat</p>
                        <p class="text-gray-500 text-sm mt-1">Buku Akademik</p>
                    </div>
                </div>

                <div class="rounded-3xl overflow-hidden bg-white border border-blue-100 shadow-sm">
                    <div class="h-64 bg-gradient-to-br from-blue-950 to-cyan-700 p-6 flex flex-col justify-between">
                        <p class="text-cyan-200 font-bold">REFERENSI</p>
                        <h3 class="text-white text-2xl font-extrabold leading-tight">
                            Epidemiologi Kesehatan
                        </h3>
                        <p class="text-cyan-100 text-sm">Untuk Masyarakat</p>
                    </div>
                    <div class="p-5">
                        <p class="font-bold text-green-950">Epidemiologi</p>
                        <p class="text-gray-500 text-sm mt-1">Buku Referensi</p>
                    </div>
                </div>

                <div class="rounded-3xl overflow-hidden bg-white border border-yellow-100 shadow-sm">
                    <div class="h-64 bg-gradient-to-br from-yellow-700 to-orange-400 p-6 flex flex-col justify-between">
                        <p class="text-white font-bold">BUKU GIZI</p>
                        <h3 class="text-white text-2xl font-extrabold leading-tight">
                            Gizi dan Kesehatan
                        </h3>
                        <p class="text-yellow-50 text-sm">Masyarakat</p>
                    </div>
                    <div class="p-5">
                        <p class="font-bold text-green-950">Gizi Kesehatan</p>
                        <p class="text-gray-500 text-sm mt-1">Buku Ilmiah</p>
                    </div>
                </div>

                <div class="rounded-3xl overflow-hidden bg-white border border-emerald-100 shadow-sm">
                    <div class="h-64 bg-gradient-to-br from-emerald-900 to-teal-500 p-6 flex flex-col justify-between">
                        <p class="text-emerald-100 font-bold">JURNAL</p>
                        <h3 class="text-white text-2xl font-extrabold leading-tight">
                            Jurnal Kesehatan
                        </h3>
                        <p class="text-emerald-50 text-sm">Publikasi Ilmiah</p>
                    </div>
                    <div class="p-5">
                        <p class="font-bold text-green-950">Jurnal Kesehatan</p>
                        <p class="text-gray-500 text-sm mt-1">Publikasi Berkala</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-10">
                <a href="https://journal.anoasejahtera.com/ajst/login?source=%2Fajst%2Fsubmissions"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="bg-green-900 hover:bg-green-950 text-white font-bold px-7 py-4 rounded-2xl shadow transition text-center">
                    Lihat Portal Jurnal
                </a>

                <a href="https://penerbiteureka.com/"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="bg-yellow-500 hover:bg-yellow-400 text-green-950 font-bold px-7 py-4 rounded-2xl shadow transition text-center">
                    Lihat Penerbit Buku
                </a>
            </div>
        </div>
    </section>

    {{-- KEUNGGULAN --}}
    <section id="keunggulan" class="py-20 bg-green-950">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="text-yellow-400 font-extrabold uppercase tracking-wide mb-3">
                        Keunggulan Kami
                    </p>

                    <h2 class="text-3xl md:text-5xl font-extrabold text-white leading-tight">
                        Mengapa Memilih PT ANOA Sejahtera Mandiri?
                    </h2>

                    <p class="text-green-100 mt-6 leading-relaxed">
                        Kami mengutamakan kualitas, ketelitian, dan komunikasi profesional
                        dalam setiap proses penerbitan agar karya dapat tampil kredibel dan
                        bernilai bagi pembaca.
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="bg-white/10 border border-white/10 rounded-3xl p-6">
                        <p class="text-4xl font-extrabold text-yellow-400">1.000+</p>
                        <p class="text-green-100 mt-2 font-semibold">Penulis & Peneliti Dilayani</p>
                    </div>

                    <div class="bg-white/10 border border-white/10 rounded-3xl p-6">
                        <p class="text-4xl font-extrabold text-yellow-400">250+</p>
                        <p class="text-green-100 mt-2 font-semibold">Proyek Buku Diterbitkan</p>
                    </div>

                    <div class="bg-white/10 border border-white/10 rounded-3xl p-6">
                        <p class="text-4xl font-extrabold text-yellow-400">150+</p>
                        <p class="text-green-100 mt-2 font-semibold">Publikasi Jurnal Didukung</p>
                    </div>

                    <div class="bg-white/10 border border-white/10 rounded-3xl p-6">
                        <p class="text-4xl font-extrabold text-yellow-400">98%</p>
                        <p class="text-green-100 mt-2 font-semibold">Komitmen Mutu Layanan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KONTAK TANPA FORM --}}
    <section id="kontak" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center max-w-3xl mx-auto mb-12">
                <p class="text-yellow-600 font-extrabold uppercase tracking-wide mb-3">
                    Kontak & Informasi
                </p>

                <h2 class="text-3xl md:text-5xl font-extrabold text-green-950 leading-tight">
                    Terhubung dengan PT ANOA Sejahtera Mandiri
                </h2>

                <p class="text-gray-600 mt-5 leading-relaxed">
                    Untuk informasi lebih lanjut mengenai penerbitan buku, jurnal kesehatan,
                    dan layanan publikasi ilmiah, silakan hubungi kami melalui kontak berikut.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-50 rounded-3xl p-7 border border-gray-100 text-center">
                    <div class="w-16 h-16 mx-auto rounded-3xl bg-green-100 text-green-800 flex items-center justify-center text-3xl mb-5">
                        📍
                    </div>
                    <h3 class="text-xl font-extrabold text-green-950 mb-2">Alamat</h3>
                    <p class="text-gray-600 text-sm">
                        Indonesia
                    </p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-7 border border-gray-100 text-center">
                    <div class="w-16 h-16 mx-auto rounded-3xl bg-green-100 text-green-800 flex items-center justify-center text-3xl mb-5">
                        ✉️
                    </div>
                    <h3 class="text-xl font-extrabold text-green-950 mb-2">Email</h3>
                    <p class="text-gray-600 text-sm">
                        anoasejahtera238@gmail.com
                    </p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-7 border border-gray-100 text-center">
                    <div class="w-16 h-16 mx-auto rounded-3xl bg-green-100 text-green-800 flex items-center justify-center text-3xl mb-5">
                        🌐
                    </div>
                    <h3 class="text-xl font-extrabold text-green-950 mb-2">Platform</h3>
                    <div class="space-y-2 text-sm">
                        <a href="https://journal.anoasejahtera.com/ajst/login?source=%2Fajst%2Fsubmissions"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="block text-green-800 font-bold hover:underline">
                            Portal Jurnal ANOA
                        </a>

                        <a href="https://penerbiteureka.com/"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="block text-green-800 font-bold hover:underline">
                            Penerbit Eureka
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-10 bg-green-950 rounded-[2rem] p-8 md:p-10 flex flex-col lg:flex-row items-center justify-between gap-6">
                <div>
                    <p class="text-yellow-400 font-extrabold uppercase tracking-wide mb-2">
                        Akses Platform
                    </p>

                    <h3 class="text-2xl md:text-3xl font-extrabold text-white">
                        Kunjungi portal jurnal dan penerbitan buku yang kami kelola.
                    </h3>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://journal.anoasejahtera.com/ajst/login?source=%2Fajst%2Fsubmissions"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="bg-yellow-500 hover:bg-yellow-400 text-green-950 font-extrabold px-6 py-4 rounded-2xl transition text-center">
                        Portal Jurnal
                    </a>

                    <a href="https://penerbiteureka.com/"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="bg-white hover:bg-green-50 text-green-950 font-extrabold px-6 py-4 rounded-2xl transition text-center">
                        Penerbit Buku
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-green-950 text-white">
        <div class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-4 gap-10">

            <div>
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-yellow-500 flex items-center justify-center text-green-950 text-2xl font-black">
                        A
                    </div>

                    <div>
                        <h3 class="font-extrabold text-lg">PT ANOA</h3>
                        <p class="text-green-100 text-sm">Sejahtera Mandiri</p>
                    </div>
                </div>

                <p class="text-green-100 text-sm leading-relaxed">
                    Mitra profesional penerbitan buku dan jurnal kesehatan yang berkomitmen
                    pada kualitas, integritas, dan dampak ilmiah.
                </p>
            </div>

            <div>
                <h4 class="font-extrabold mb-4 text-yellow-400">Layanan</h4>
                <ul class="space-y-3 text-green-100 text-sm">
                    <li>Penerbitan Buku</li>
                    <li>Penerbitan Jurnal Kesehatan</li>
                    <li>Layout & Editing</li>
                    <li>ISBN & DOI Support</li>
                </ul>
            </div>

            <div>
                <h4 class="font-extrabold mb-4 text-yellow-400">Platform</h4>
                <ul class="space-y-3 text-green-100 text-sm">
                    <li>
                        <a href="https://journal.anoasejahtera.com/ajst/login?source=%2Fajst%2Fsubmissions"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="hover:text-yellow-300">
                            Portal Jurnal ANOA
                        </a>
                    </li>
                    <li>
                        <a href="https://penerbiteureka.com/"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="hover:text-yellow-300">
                            Penerbit Eureka
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="font-extrabold mb-4 text-yellow-400">Link Cepat</h4>
                <ul class="space-y-3 text-green-100 text-sm">
                    <li><a href="#home" class="hover:text-yellow-300">Home</a></li>
                    <li><a href="#tentang" class="hover:text-yellow-300">Tentang Kami</a></li>
                    <li><a href="#layanan" class="hover:text-yellow-300">Layanan</a></li>
                    <li><a href="#kontak" class="hover:text-yellow-300">Kontak</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 py-5 text-center text-green-100 text-sm">
            © {{ date('Y') }} PT ANOA Sejahtera Mandiri. Semua hak dilindungi.
        </div>
    </footer>

</body>
</html>