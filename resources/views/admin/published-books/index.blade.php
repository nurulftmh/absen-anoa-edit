@php
    use Illuminate\Support\Str;
@endphp

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
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Kata Kunci
                            </label>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari judul, penulis, ISBN, penerbit, karyawan..."
                                   class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-green-700 focus:ring-green-700">
                        </div>

                        <div>
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Dari Tanggal
                            </label>

                            <input type="date"
                                   name="date_from"
                                   value="{{ request('date_from') }}"
                                   class="w-full rounded-2xl border-gray-200 shadow-sm focus:border-green-700 focus:ring-green-700">
                        </div>

                        <div>
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Sampai Tanggal
                            </label>

                            <input type="date"
                                   name="date_to"
                                   value="{{ request('date_to') }}"
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
                            @php
                                /*
                                    Normalisasi path agar aman jika data di database tersimpan sebagai:
                                    public/folder/file.jpg
                                    storage/folder/file.jpg
                                    /storage/folder/file.jpg
                                    folder/file.jpg
                                */

                                $coverUrl = null;
                                $pdfUrl = null;
                                $certificateUrl = null;

                                if ($book->cover_path) {
                                    $coverPath = str_replace('\\', '/', $book->cover_path);
                                    $coverPath = ltrim($coverPath, '/');
                                    $coverPath = Str::replaceFirst('public/', '', $coverPath);
                                    $coverPath = Str::replaceFirst('storage/', '', $coverPath);

                                    $coverUrl = route('media.show', ['path' => $coverPath]);
                                }

                                if ($book->book_pdf_path) {
                                    $pdfPath = str_replace('\\', '/', $book->book_pdf_path);
                                    $pdfPath = ltrim($pdfPath, '/');
                                    $pdfPath = Str::replaceFirst('public/', '', $pdfPath);
                                    $pdfPath = Str::replaceFirst('storage/', '', $pdfPath);

                                    $pdfUrl = route('media.show', ['path' => $pdfPath]);
                                }

                                if ($book->certificate_archive_path) {
                                    $certificatePath = str_replace('\\', '/', $book->certificate_archive_path);
                                    $certificatePath = ltrim($certificatePath, '/');
                                    $certificatePath = Str::replaceFirst('public/', '', $certificatePath);
                                    $certificatePath = Str::replaceFirst('storage/', '', $certificatePath);

                                    $certificateUrl = route('media.show', ['path' => $certificatePath]);
                                }
                            @endphp

                            <tr class="hover:bg-gray-50 transition">

                                {{-- COVER --}}
                                <td class="p-4">
                                    @if($coverUrl)
                                        <div class="flex flex-col items-start gap-2">
                                            <img src="{{ $coverUrl }}"
                                                 alt="Cover {{ $book->title }}"
                                                 class="w-16 h-24 object-cover rounded-xl border border-gray-200 shadow-sm cursor-pointer hover:scale-105 transition"
                                                 onclick="openImage('{{ $coverUrl }}')"
                                                 

                                            <button type="button"
                                                    onclick="openImage('{{ $coverUrl }}')"
                                                    class="text-xs bg-orange-100 text-orange-700 hover:bg-orange-200 px-3 py-1 rounded-xl font-semibold transition">
                                                Lihat Cover
                                            </button>
                                        </div>
                                    @else
                                        <div class="w-16 h-24 rounded-xl bg-gray-100 text-gray-400 flex items-center justify-center text-xs border text-center">
                                            No Cover
                                        </div>
                                    @endif
                                </td>

                                {{-- TANGGAL TERBIT --}}
                                <td class="p-4 text-gray-700">
                                    {{ $book->published_date ? $book->published_date->format('d-m-Y') : '-' }}
                                </td>

                                {{-- DATA BUKU --}}
                                <td class="p-4">
                                    <p class="font-bold text-gray-900 max-w-md">
                                        {{ $book->title }}
                                    </p>

                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $book->author_name }}
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $book->publisher ?? 'Penerbit belum diisi' }}

                                        @if($book->isbn)
                                            | ISBN {{ $book->isbn }}
                                        @endif
                                    </p>
                                </td>

                                {{-- PENGINPUT --}}
                                <td class="p-4">
                                    <p class="font-semibold text-gray-800">
                                        {{ $book->user->name ?? '-' }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $book->user->email ?? '-' }}
                                    </p>
                                </td>

                                {{-- FILE --}}
                                <td class="p-4">
                                    <div class="flex flex-col gap-2">

                                        @if($pdfUrl)
                                            <a href="{{ $pdfUrl }}"
                                               target="_blank"
                                               class="inline-flex w-fit text-blue-700 hover:underline font-semibold text-sm">
                                                Buka PDF
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400">
                                                PDF belum ada
                                            </span>
                                        @endif

                                        @if($certificateUrl)
                                            <a href="{{ $certificateUrl }}"
                                               target="_blank"
                                               class="inline-flex w-fit text-emerald-700 hover:underline font-semibold text-sm">
                                                Unduh Sertifikat
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400">
                                                Sertifikat belum ada
                                            </span>
                                        @endif

                                        @if($coverUrl)
                                            <a href="{{ $coverUrl }}"
                                               target="_blank"
                                               class="inline-flex w-fit text-orange-700 hover:underline font-semibold text-sm">
                                                Buka Cover Asli
                                            </a>
                                        @endif
                                    </div>
                                </td>

                                {{-- CATATAN --}}
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

    {{-- MODAL PREVIEW COVER --}}
    <div id="imageModal"
         class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 p-6">

        <div class="relative max-w-5xl w-full flex justify-center">
            <button type="button"
                    onclick="closeImage()"
                    class="absolute top-0 right-0 -mt-12 text-white text-4xl font-bold hover:text-red-400 transition">
                &times;
            </button>

            <img id="previewImage"
                 src=""
                 alt="Preview Cover"
                 class="max-h-[90vh] rounded-3xl shadow-2xl border-4 border-white">
        </div>
    </div>

    <script>
        function openImage(src) {
            document.getElementById('previewImage').src = src;

            const modal = document.getElementById('imageModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeImage() {
            const modal = document.getElementById('imageModal');

            modal.classList.remove('flex');
            modal.classList.add('hidden');

            document.getElementById('previewImage').src = '';
        }
    </script>
</x-app-layout>