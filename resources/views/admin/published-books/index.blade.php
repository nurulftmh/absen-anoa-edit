<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-green-950">Data Buku Terbit</h1>
            <p class="text-gray-500 mt-1">
                Pantau seluruh buku terbit yang diarsipkan oleh karyawan.
            </p>
        </div>

        <div class="mb-5">
            <form action="{{ route('admin.published-books.index') }}" method="GET">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <div class="md:col-span-2">
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">Kata Kunci</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Cari judul, penulis, ISBN, penerbit, karyawan..."
                                   class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-green-700 focus:ring-green-700">
                        </div>

                        <div>
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">Dari Tanggal</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}"
                                   class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-green-700 focus:ring-green-700">
                        </div>

                        <div>
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">Sampai Tanggal</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}"
                                   class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-green-700 focus:ring-green-700">
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-3 mt-4 justify-end">
                        <button class="bg-green-800 hover:bg-green-900 text-white px-6 py-3 rounded-2xl font-semibold shadow-sm">
                            Cari Data
                        </button>

                        @if(request('search') || request('date_from') || request('date_to'))
                            <a href="{{ route('admin.published-books.index') }}"
                               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl font-semibold text-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-green-950 text-white">
                        <tr>
                            <th class="p-4 text-left">Cover</th>
                            <th class="p-4 text-left">Tanggal Terbit</th>
                            <th class="p-4 text-left">Buku</th>
                            <th class="p-4 text-left">Penginput</th>
                            <th class="p-4 text-left">File</th>
                            <th class="p-4 text-left">Catatan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($publishedBooks as $book)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    @if($book->cover_path)
                                        <img src="{{ asset('storage/' . $book->cover_path) }}"
                                             alt="Cover {{ $book->title }}"
                                             class="w-16 h-24 object-cover rounded-xl border border-gray-200">
                                    @else
                                        <div class="w-16 h-24 rounded-xl bg-gray-100 text-gray-400 flex items-center justify-center text-xs">
                                            Cover
                                        </div>
                                    @endif
                                </td>

                                <td class="p-4 text-gray-700">
                                    {{ $book->published_date->format('d-m-Y') }}
                                </td>

                                <td class="p-4">
                                    <p class="font-bold text-gray-900 max-w-md">{{ $book->title }}</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $book->author_name }}</p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $book->publisher ?? 'Penerbit belum diisi' }}
                                        @if($book->isbn)
                                            | ISBN {{ $book->isbn }}
                                        @endif
                                    </p>
                                </td>

                                <td class="p-4">
                                    <p class="font-semibold text-gray-800">{{ $book->user->name ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">{{ $book->user->email ?? '-' }}</p>
                                </td>

                                <td class="p-4">
                                    <div class="flex flex-col gap-2">
                                        <a href="{{ asset('storage/' . $book->book_pdf_path) }}"
                                           target="_blank"
                                           class="inline-flex w-fit text-blue-700 hover:underline font-semibold text-sm">
                                            Buka PDF
                                        </a>

                                        @if($book->certificate_archive_path)
                                            <a href="{{ asset('storage/' . $book->certificate_archive_path) }}"
                                               target="_blank"
                                               class="inline-flex w-fit text-emerald-700 hover:underline font-semibold text-sm">
                                                Unduh Sertifikat
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400">Sertifikat belum ada</span>
                                        @endif

                                        @if($book->cover_path)
                                            <a href="{{ asset('storage/' . $book->cover_path) }}"
                                               target="_blank"
                                               class="inline-flex w-fit text-orange-700 hover:underline font-semibold text-sm">
                                                Lihat Cover
                                            </a>
                                        @endif
                                    </div>
                                </td>

                                <td class="p-4 text-gray-600 max-w-xs">
                                    {{ $book->note ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-10 text-center text-gray-500">
                                    <p class="font-semibold">Belum ada data buku terbit.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-6 border-t border-gray-100">
                    {{ $publishedBooks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>