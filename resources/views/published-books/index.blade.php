@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-green-950">Data Buku Terbit</h1>
            <p class="text-gray-500 mt-1">
                Arsipkan buku yang sudah terbit beserta PDF, sertifikat, dan cover.
            </p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-2xl mb-5 shadow-sm">
                {{ session('success') }}
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

        {{-- FORM TAMBAH --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5 mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Tambah Buku Terbit</h2>
                    <p class="text-xs text-gray-500 mt-1">
                        Tanggal terbit bisa mengikuti nama folder data testing yang sudah Anda punya.
                    </p>
                </div>

                <div class="hidden md:flex w-11 h-11 rounded-2xl bg-emerald-100 text-emerald-700 items-center justify-center text-xl">
                    BT
                </div>
            </div>

            <form action="{{ route('published-books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                            Tanggal Terbit
                        </label>

                        <input type="date"
                               name="published_date"
                               value="{{ old('published_date') }}"
                               class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-emerald-600 focus:ring-emerald-600"
                               required>
                    </div>

                    <div>
                        <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                            Penulis
                        </label>

                        <input type="text"
                               name="author_name"
                               value="{{ old('author_name') }}"
                               class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-emerald-600 focus:ring-emerald-600"
                               required>
                    </div>

                    <div>
                        <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                            Penerbit
                        </label>

                        <input type="text"
                               name="publisher"
                               value="{{ old('publisher') }}"
                               class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-emerald-600 focus:ring-emerald-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                    <div class="md:col-span-2">
                        <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                            Judul Buku
                        </label>

                        <textarea name="title"
                                  rows="2"
                                  class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-emerald-600 focus:ring-emerald-600"
                                  required>{{ old('title') }}</textarea>
                    </div>

                    <div>
                        <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                            ISBN
                        </label>

                        <input type="text"
                               name="isbn"
                               value="{{ old('isbn') }}"
                               class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-emerald-600 focus:ring-emerald-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                    <div>
                        <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                            PDF Buku
                        </label>

                        <input type="file"
                               name="book_pdf"
                               accept="application/pdf"
                               class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50"
                               required>
                    </div>

                    <div>
                        <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                            RAR/ZIP Sertifikat
                        </label>

                        <input type="file"
                               name="certificate_archive"
                               accept=".rar,.zip"
                               class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50">
                    </div>

                    <div>
                        <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                            Cover Buku
                        </label>

                        <input type="file"
                               name="cover"
                               accept="image/*"
                               class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                        Catatan
                    </label>

                    <input type="text"
                           name="note"
                           value="{{ old('note') }}"
                           class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-emerald-600 focus:ring-emerald-600">
                </div>

                <div class="mt-4 flex justify-end">
                    <button class="bg-green-700 hover:bg-green-800 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition">
                        Simpan Buku Terbit
                    </button>
                </div>
            </form>
        </div>

        {{-- SEARCH --}}
        <div class="mb-5">
            <form action="{{ route('published-books.index') }}" method="GET">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <div class="md:col-span-2">
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Kata Kunci
                            </label>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari judul, penulis, ISBN, penerbit..."
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
                            <a href="{{ route('published-books.index') }}"
                               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-2xl font-semibold text-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-green-950 text-white">
                        <tr>
                            <th class="p-4 text-left">Cover</th>
                            <th class="p-4 text-left">Tanggal Terbit</th>
                            <th class="p-4 text-left">Buku</th>
                            <th class="p-4 text-left">File</th>
                            <th class="p-4 text-left">Catatan</th>
                            <th class="p-4 text-left">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($publishedBooks as $book)

                            @php
                                $coverUrl = null;
                                $pdfUrl = null;
                                $certificateUrl = null;

                                if (!empty($book->cover_path)) {
                                    $coverPath = str_replace('\\', '/', $book->cover_path);
                                    $coverPath = ltrim($coverPath, '/');
                                    $coverPath = Str::replaceFirst('public/', '', $coverPath);
                                    $coverPath = Str::replaceFirst('storage/', '', $coverPath);

                                    $coverUrl = route('media.show', ['path' => $coverPath]);
                                }

                                if (!empty($book->book_pdf_path)) {
                                    $pdfPath = str_replace('\\', '/', $book->book_pdf_path);
                                    $pdfPath = ltrim($pdfPath, '/');
                                    $pdfPath = Str::replaceFirst('public/', '', $pdfPath);
                                    $pdfPath = Str::replaceFirst('storage/', '', $pdfPath);

                                    $pdfUrl = route('media.show', ['path' => $pdfPath]);
                                }

                                if (!empty($book->certificate_archive_path)) {
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
                                        <img src="{{ $coverUrl }}"
                                             alt="Cover {{ $book->title }}"
                                             class="w-16 h-24 object-cover rounded-xl border border-gray-200 shadow-sm cursor-pointer hover:scale-105 transition"
                                             onclick="openImage('{{ $coverUrl }}')">
                                    @else
                                        <div class="w-16 h-24 rounded-xl bg-gray-100 text-gray-400 flex items-center justify-center text-xs border text-center">
                                            No Cover
                                        </div>
                                    @endif
                                </td>

                                {{-- TANGGAL --}}
                                <td class="p-4 text-gray-700">
                                    {{ $book->published_date ? $book->published_date->format('d-m-Y') : '-' }}
                                </td>

                                {{-- BUKU --}}
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
                                                Lihat Cover
                                            </a>
                                        @endif
                                    </div>
                                </td>

                                {{-- CATATAN --}}
                                <td class="p-4 text-gray-600 max-w-xs">
                                    {{ $book->note ?? '-' }}
                                </td>

                                {{-- AKSI --}}
                                <td class="p-4">
                                    <div class="flex gap-2 flex-wrap">
                                        <button type="button"
                                                onclick="document.getElementById('edit-published-book-{{ $book->id }}').classList.toggle('hidden')"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-xl text-sm shadow-sm">
                                            Edit
                                        </button>

                                        <form action="{{ route('published-books.destroy', $book) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data buku terbit ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-xl text-sm shadow-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- FORM EDIT --}}
                            <tr id="edit-published-book-{{ $book->id }}" class="hidden bg-gray-50">
                                <td colspan="6" class="p-5">
                                    <form action="{{ route('published-books.update', $book) }}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <input type="date"
                                                   name="published_date"
                                                   value="{{ $book->published_date ? $book->published_date->format('Y-m-d') : '' }}"
                                                   class="rounded-2xl border-gray-200">

                                            <input type="text"
                                                   name="author_name"
                                                   value="{{ $book->author_name }}"
                                                   class="rounded-2xl border-gray-200">

                                            <input type="text"
                                                   name="publisher"
                                                   value="{{ $book->publisher }}"
                                                   placeholder="Penerbit"
                                                   class="rounded-2xl border-gray-200">
                                        </div>

                                        <textarea name="title"
                                                  rows="3"
                                                  class="w-full rounded-2xl border-gray-200 mt-4">{{ $book->title }}</textarea>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                            <input type="text"
                                                   name="isbn"
                                                   value="{{ $book->isbn }}"
                                                   placeholder="ISBN"
                                                   class="rounded-2xl border-gray-200">

                                            <input type="text"
                                                   name="note"
                                                   value="{{ $book->note }}"
                                                   placeholder="Catatan"
                                                   class="rounded-2xl border-gray-200">
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                            <div>
                                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                                    Ganti PDF Buku
                                                </label>

                                                <input type="file"
                                                       name="book_pdf"
                                                       accept="application/pdf"
                                                       class="w-full border border-gray-200 rounded-2xl p-3 text-sm bg-white">
                                            </div>

                                            <div>
                                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                                    Ganti Sertifikat
                                                </label>

                                                <input type="file"
                                                       name="certificate_archive"
                                                       accept=".rar,.zip"
                                                       class="w-full border border-gray-200 rounded-2xl p-3 text-sm bg-white">
                                            </div>

                                            <div>
                                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                                    Ganti Cover
                                                </label>

                                                @if($coverUrl)
                                                    <div class="mb-2">
                                                        <img src="{{ $coverUrl }}"
                                                             alt="Cover {{ $book->title }}"
                                                             class="w-16 h-24 object-cover rounded-xl border border-gray-200 shadow-sm">
                                                    </div>
                                                @endif

                                                <input type="file"
                                                       name="cover"
                                                       accept="image/*"
                                                       class="w-full border border-gray-200 rounded-2xl p-3 text-sm bg-white">
                                            </div>
                                        </div>

                                        <button class="mt-4 bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-2xl shadow-sm">
                                            Update
                                        </button>
                                    </form>
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