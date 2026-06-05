<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 py-8">
        <div class="px-6 max-w-7xl mx-auto">

            {{-- HEADER --}}
            <div class="mb-8 bg-white/80 backdrop-blur rounded-3xl shadow-sm border border-green-100 p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-4 py-1.5 rounded-full text-sm font-semibold mb-3">
                            📚 Admin Buku
                        </div>

                        <h1 class="text-3xl md:text-4xl font-extrabold text-green-950 tracking-tight">
                            Data Buku Karyawan
                        </h1>

                        <p class="text-gray-500 mt-2 max-w-2xl">
                            Lihat, pantau, dan kelola seluruh data buku yang telah diinputkan oleh karyawan.
                        </p>
                    </div>

                    <div class="bg-green-950 text-white rounded-2xl px-6 py-4 shadow-md">
                        <p class="text-sm text-green-100">Total Buku</p>
                        <p class="text-3xl font-bold">{{ $books->total() }}</p>
                    </div>
                </div>

                {{-- SEARCH --}}
                <form action="{{ route('admin.books.index') }}" method="GET" class="mt-6">
                    <div class="flex flex-col md:flex-row gap-3">
                        <div class="relative w-full">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                🔍
                            </span>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari karyawan, penulis, judul, status, atau catatan..."
                                   class="w-full pl-11 rounded-2xl border-gray-200 bg-gray-50 shadow-sm focus:bg-white focus:border-green-700 focus:ring-green-700">
                        </div>

                        <button type="submit"
                                class="bg-green-800 hover:bg-green-900 text-white px-7 py-3 rounded-2xl font-semibold shadow-sm transition">
                            Cari
                        </button>

                        @if(request('search'))
                            <a href="{{ route('admin.books.index') }}"
                               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-7 py-3 rounded-2xl font-semibold transition text-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- TABLE CARD --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-green-950/5 border border-green-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Daftar Buku</h2>
                        <p class="text-sm text-gray-500">Data buku berdasarkan input karyawan.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-green-950 text-white">
                                <th class="px-5 py-4 text-left font-semibold">Karyawan</th>
                                <th class="px-5 py-4 text-left font-semibold">Tanggal Masuk</th>
                                <th class="px-5 py-4 text-left font-semibold">Penulis</th>
                                <th class="px-5 py-4 text-left font-semibold">Judul Buku</th>
                                <th class="px-5 py-4 text-left font-semibold">Docs</th>
                                <th class="px-5 py-4 text-left font-semibold">Status</th>
                                <th class="px-5 py-4 text-left font-semibold">Catatan</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($books as $book)
                                <tr class="hover:bg-green-50/70 transition">

                                    {{-- KARYAWAN --}}
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-11 h-11 rounded-2xl bg-green-100 text-green-800 flex items-center justify-center font-bold shadow-sm">
                                                {{ strtoupper(substr($book->user->name ?? 'U', 0, 1)) }}
                                            </div>

                                            <div>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $book->user->name ?? '-' }}
                                                </p>
                                                <p class="text-xs text-gray-400">
                                                    Karyawan
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- TANGGAL --}}
                                    <td class="px-5 py-4">
                                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full text-xs font-semibold border border-gray-200">
                                            📅 {{ \Carbon\Carbon::parse($book->entry_date)->format('d-m-Y') }}
                                        </span>
                                    </td>

                                    {{-- PENULIS --}}
                                    <td class="px-5 py-4">
                                        <div class="font-semibold text-gray-800">
                                            {{ $book->author_name }}
                                        </div>
                                    </td>

                                    {{-- JUDUL --}}
                                    <td class="px-5 py-4 max-w-md">
                                        <div class="font-semibold text-gray-800 leading-snug">
                                            {{ $book->title }}
                                        </div>
                                    </td>

                                    {{-- DOCS --}}
                                    <td class="px-5 py-4">
                                        @if($book->docs_link)
                                            <a href="{{ $book->docs_link }}"
                                               target="_blank"
                                               class="inline-flex items-center gap-1 text-indigo-700 hover:text-indigo-900 font-semibold bg-indigo-50 px-3 py-1.5 rounded-xl">
                                                📄 Buka Docs
                                            </a>
                                        @else
                                            <span class="text-gray-400">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-5 py-4">
                                        @if($book->status == 'On Progress')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700 border border-indigo-200">
                                                ✍️ On Progress
                                            </span>
                                        @elseif($book->status == 'Draft')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                                📝 Draft
                                            </span>
                                        @elseif($book->status == 'Selesai')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                                ✅ Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                ⏳ {{ $book->status }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- CATATAN --}}
                                    <td class="px-5 py-4 max-w-xs">
                                        <p class="text-gray-600 leading-relaxed">
                                            {{ $book->note ?? '-' }}
                                        </p>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-20 h-20 rounded-full bg-green-50 flex items-center justify-center text-4xl mb-4">
                                                📚
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-800">
                                                Belum ada data buku
                                            </h3>
                                            <p class="text-gray-500 mt-1">
                                                Data buku yang diinputkan karyawan akan tampil di sini.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="p-6 border-t border-gray-100 bg-gray-50">
                    {{ $books->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>