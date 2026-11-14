@php
    use Illuminate\Support\Str;

    /*
    |--------------------------------------------------------------------------
    | HELPER URL MEDIA PUBLIC
    |--------------------------------------------------------------------------
    */
    $mediaUrl = function ($path) {

        if (empty($path)) {
            return null;
        }

        $path = str_replace('\\', '/', $path);
        $path = ltrim($path, '/');

        $path = Str::replaceFirst(
            'public/',
            '',
            $path
        );

        $path = Str::replaceFirst(
            'storage/',
            '',
            $path
        );

        return route(
            'media.show',
            [
                'path' => $path,
            ]
        );
    };
@endphp


<x-app-layout>

    <div class="p-6 max-w-7xl mx-auto">


        {{-- ====================================================== --}}
        {{-- HEADER --}}
        {{-- ====================================================== --}}

        <div class="mb-6">

            <h1 class="text-3xl font-bold text-green-950">
                Data Buku Terbit
            </h1>

            <p class="text-gray-500 mt-1">
                Arsipkan buku yang sudah terbit beserta file,
                cover, sertifikat, dan data penjualan e-book.
            </p>

        </div>



        {{-- ====================================================== --}}
        {{-- ALERT SUCCESS --}}
        {{-- ====================================================== --}}

        @if(session('success'))

            <div
                class="bg-green-50
                       border border-green-200
                       text-green-800
                       p-4
                       rounded-2xl
                       mb-5
                       shadow-sm"
            >

                {{ session('success') }}

            </div>

        @endif



        {{-- ====================================================== --}}
        {{-- ALERT ERROR --}}
        {{-- ====================================================== --}}

        @if($errors->any())

            <div
                class="bg-red-50
                       border border-red-200
                       text-red-800
                       p-4
                       rounded-2xl
                       mb-5
                       shadow-sm"
            >

                <ul class="list-disc ms-5">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif



        {{-- ====================================================== --}}
        {{-- FORM TAMBAH --}}
        {{-- ====================================================== --}}

        <div
            class="bg-white
                   rounded-3xl
                   shadow-sm
                   border border-gray-100
                   p-5
                   mb-8"
        >

            <div
                class="flex
                       items-center
                       justify-between
                       mb-4"
            >

                <div>

                    <h2 class="text-lg font-bold text-gray-800">
                        Tambah Buku Terbit
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Tambahkan informasi buku yang sudah terbit.
                        File PDF buku tidak wajib diunggah.
                    </p>

                </div>


                <div
                    class="hidden md:flex
                           w-11 h-11
                           rounded-2xl
                           bg-emerald-100
                           text-emerald-700
                           items-center
                           justify-center
                           text-xl"
                >
                    BT
                </div>

            </div>



            <form
                action="{{ route('published-books.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- ================================================== --}}
                {{-- DATA UTAMA --}}
                {{-- ================================================== --}}

                <div
                    class="grid
                           grid-cols-1
                           md:grid-cols-3
                           gap-3"
                >


                    {{-- TANGGAL TERBIT --}}

                    <div>

                        <label
                            class="block
                                   mb-1.5
                                   font-semibold
                                   text-xs
                                   text-gray-600"
                        >
                            Tanggal Terbit
                        </label>

                        <input
                            type="date"
                            name="published_date"
                            value="{{ old('published_date') }}"
                            class="w-full
                                   rounded-xl
                                   border-gray-200
                                   text-sm
                                   py-2.5
                                   focus:border-emerald-600
                                   focus:ring-emerald-600"
                            required
                        >

                    </div>



                    {{-- PENULIS --}}

                    <div>

                        <label
                            class="block
                                   mb-1.5
                                   font-semibold
                                   text-xs
                                   text-gray-600"
                        >
                            Penulis
                        </label>

                        <input
                            type="text"
                            name="author_name"
                            value="{{ old('author_name') }}"
                            class="w-full
                                   rounded-xl
                                   border-gray-200
                                   text-sm
                                   py-2.5
                                   focus:border-emerald-600
                                   focus:ring-emerald-600"
                            required
                        >

                    </div>



                    {{-- PENERBIT --}}

                    <div>

                        <label
                            class="block
                                   mb-1.5
                                   font-semibold
                                   text-xs
                                   text-gray-600"
                        >
                            Penerbit
                        </label>

                        <input
                            type="text"
                            name="publisher"
                            value="{{ old('publisher') }}"
                            class="w-full
                                   rounded-xl
                                   border-gray-200
                                   text-sm
                                   py-2.5
                                   focus:border-emerald-600
                                   focus:ring-emerald-600"
                        >

                    </div>

                </div>



                {{-- ================================================== --}}
                {{-- JUDUL + ISBN --}}
                {{-- ================================================== --}}

                <div
                    class="grid
                           grid-cols-1
                           md:grid-cols-3
                           gap-3
                           mt-3"
                >


                    {{-- JUDUL --}}

                    <div class="md:col-span-2">

                        <label
                            class="block
                                   mb-1.5
                                   font-semibold
                                   text-xs
                                   text-gray-600"
                        >
                            Judul Buku
                        </label>

                        <textarea
                            name="title"
                            rows="2"
                            class="w-full
                                   rounded-xl
                                   border-gray-200
                                   text-sm
                                   py-2.5
                                   focus:border-emerald-600
                                   focus:ring-emerald-600"
                            required
                        >{{ old('title') }}</textarea>

                    </div>



                    {{-- ISBN --}}

                    <div>

                        <label
                            class="block
                                   mb-1.5
                                   font-semibold
                                   text-xs
                                   text-gray-600"
                        >
                            ISBN
                        </label>

                        <input
                            type="text"
                            name="isbn"
                            value="{{ old('isbn') }}"
                            class="w-full
                                   rounded-xl
                                   border-gray-200
                                   text-sm
                                   py-2.5
                                   focus:border-emerald-600
                                   focus:ring-emerald-600"
                        >

                    </div>

                </div>



                {{-- ================================================== --}}
                {{-- FILE ARSIP --}}
                {{-- ================================================== --}}

                <div
                    class="grid
                           grid-cols-1
                           md:grid-cols-3
                           gap-3
                           mt-3"
                >


                    {{-- PDF BUKU --}}

                    <div>

                        <label
                            class="block
                                   mb-1.5
                                   font-semibold
                                   text-xs
                                   text-gray-600"
                        >

                            PDF Buku

                            <span class="font-normal text-gray-400">
                                (Opsional)
                            </span>

                        </label>

                        <input
                            type="file"
                            name="book_pdf"
                            accept=".pdf,application/pdf"
                            class="w-full
                                   border border-gray-200
                                   rounded-xl
                                   p-2.5
                                   text-sm
                                   bg-gray-50"
                        >

                        <p class="text-xs text-gray-400 mt-1">
                            Tidak wajib diunggah.
                            Format PDF, maksimal 100 MB.
                        </p>

                    </div>



                    {{-- SERTIFIKAT --}}

                    <div>

                        <label
                            class="block
                                   mb-1.5
                                   font-semibold
                                   text-xs
                                   text-gray-600"
                        >

                            Sertifikat

                            <span class="font-normal text-gray-400">
                                (Opsional)
                            </span>

                        </label>

                        <input
                            type="file"
                            name="certificate_archive"
                            accept=".rar,.zip,.pdf,application/pdf"
                            class="w-full
                                   border border-gray-200
                                   rounded-xl
                                   p-2.5
                                   text-sm
                                   bg-gray-50"
                        >

                        <p class="text-xs text-gray-400 mt-1">
                            RAR, ZIP, atau PDF.
                            Maksimal 100 MB.
                        </p>

                    </div>



                    {{-- COVER --}}

                    <div>

                        <label
                            class="block
                                   mb-1.5
                                   font-semibold
                                   text-xs
                                   text-gray-600"
                        >

                            Cover Buku

                            <span class="font-normal text-gray-400">
                                (Opsional)
                            </span>

                        </label>

                        <input
                            type="file"
                            name="cover"
                            accept="image/jpeg,image/png,image/webp"
                            class="w-full
                                   border border-gray-200
                                   rounded-xl
                                   p-2.5
                                   text-sm
                                   bg-gray-50"
                        >

                        <p class="text-xs text-gray-400 mt-1">
                            JPG, JPEG, PNG, atau WEBP.
                            Maksimal 10 MB.
                        </p>

                    </div>

                </div>



                {{-- ================================================== --}}
                {{-- PENJUALAN E-BOOK --}}
                {{-- ================================================== --}}

                <div
                    class="mt-6
                           border-t
                           border-gray-100
                           pt-5"
                >

                    <div class="mb-4">

                        <h3 class="text-lg font-bold text-green-950">
                            Penjualan E-Book
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Isi bagian ini jika buku tersedia untuk
                            dijual dalam bentuk digital.
                        </p>

                    </div>


                    <div
                        class="grid
                               grid-cols-1
                               md:grid-cols-3
                               gap-4"
                    >


                        {{-- HARGA --}}

                        <div>

                            <label
                                class="block
                                       mb-2
                                       text-sm
                                       font-semibold
                                       text-gray-700"
                            >
                                Harga E-Book
                            </label>


                            <div class="relative">

                                <span
                                    class="absolute
                                           left-4
                                           top-1/2
                                           -translate-y-1/2
                                           text-gray-500"
                                >
                                    Rp
                                </span>


                                <input
                                    type="number"
                                    name="price"
                                    value="{{ old('price') }}"
                                    min="0"
                                    step="1"
                                    placeholder="75000"
                                    class="w-full
                                           pl-12
                                           rounded-2xl
                                           border-gray-200
                                           focus:border-green-700
                                           focus:ring-green-700"
                                >

                            </div>


                            <p class="text-xs text-gray-400 mt-1">
                                Contoh: 75000
                            </p>

                        </div>



                        {{-- STATUS DIJUAL --}}

                        <div>

                            <label
                                class="block
                                       mb-2
                                       text-sm
                                       font-semibold
                                       text-gray-700"
                            >
                                Status Penjualan
                            </label>


                            <input
                                type="hidden"
                                name="is_for_sale"
                                value="0"
                            >


                            <label
                                class="flex
                                       items-center
                                       gap-3
                                       border
                                       border-gray-200
                                       rounded-2xl
                                       px-4
                                       py-3
                                       cursor-pointer
                                       hover:bg-green-50
                                       transition"
                            >

                                <input
                                    type="checkbox"
                                    name="is_for_sale"
                                    value="1"
                                    {{ old('is_for_sale') ? 'checked' : '' }}
                                    class="rounded
                                           border-gray-300
                                           text-green-700
                                           focus:ring-green-700"
                                >


                                <div>

                                    <p class="font-semibold text-gray-700">
                                        Dijual sebagai E-Book
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        Aktifkan untuk menampilkan tombol beli.
                                    </p>

                                </div>

                            </label>

                        </div>



                        {{-- FILE E-BOOK --}}

                        <div>

                            <label
                                class="block
                                       mb-2
                                       text-sm
                                       font-semibold
                                       text-gray-700"
                            >

                                File E-Book

                                <span class="font-normal text-gray-400">
                                    (PDF)
                                </span>

                            </label>


                            <input
                                type="file"
                                name="ebook_file"
                                accept=".pdf,application/pdf"
                                class="w-full
                                       border
                                       border-gray-200
                                       rounded-2xl
                                       px-3
                                       py-2.5
                                       text-sm
                                       bg-gray-50"
                            >


                            <p class="text-xs text-gray-400 mt-1">
                                File ini diperlukan jika buku dijual
                                sebagai e-book.
                            </p>

                        </div>

                    </div>

                </div>



                {{-- ================================================== --}}
                {{-- CATATAN --}}
                {{-- ================================================== --}}

                <div class="mt-4">

                    <label
                        class="block
                               mb-1.5
                               font-semibold
                               text-xs
                               text-gray-600"
                    >
                        Catatan
                    </label>

                    <input
                        type="text"
                        name="note"
                        value="{{ old('note') }}"
                        class="w-full
                               rounded-xl
                               border-gray-200
                               text-sm
                               py-2.5
                               focus:border-emerald-600
                               focus:ring-emerald-600"
                    >

                </div>



                {{-- ================================================== --}}
                {{-- SUBMIT --}}
                {{-- ================================================== --}}

                <div class="mt-5 flex justify-end">

                    <button
                        type="submit"
                        class="bg-green-700
                               hover:bg-green-800
                               text-white
                               px-6
                               py-2.5
                               rounded-xl
                               text-sm
                               font-semibold
                               shadow-sm
                               transition"
                    >

                        Simpan Buku Terbit

                    </button>

                </div>

            </form>

        </div>



        {{-- ====================================================== --}}
        {{-- SEARCH --}}
        {{-- ====================================================== --}}

        <div class="mb-5">

            <form
                action="{{ route('published-books.index') }}"
                method="GET"
            >

                <div
                    class="bg-white
                           rounded-3xl
                           shadow-sm
                           border border-gray-100
                           p-5"
                >

                    <div
                        class="grid
                               grid-cols-1
                               md:grid-cols-4
                               gap-3"
                    >


                        {{-- KEYWORD --}}

                        <div class="md:col-span-2">

                            <label
                                class="block
                                       mb-1.5
                                       font-semibold
                                       text-xs
                                       text-gray-600"
                            >
                                Kata Kunci
                            </label>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari judul, penulis, ISBN, penerbit..."
                                class="w-full
                                       rounded-2xl
                                       border-gray-200
                                       shadow-sm
                                       focus:border-green-700
                                       focus:ring-green-700"
                            >

                        </div>



                        {{-- DATE FROM --}}

                        <div>

                            <label
                                class="block
                                       mb-1.5
                                       font-semibold
                                       text-xs
                                       text-gray-600"
                            >
                                Dari Tanggal
                            </label>

                            <input
                                type="date"
                                name="date_from"
                                value="{{ request('date_from') }}"
                                class="w-full
                                       rounded-2xl
                                       border-gray-200
                                       shadow-sm
                                       focus:border-green-700
                                       focus:ring-green-700"
                            >

                        </div>



                        {{-- DATE TO --}}

                        <div>

                            <label
                                class="block
                                       mb-1.5
                                       font-semibold
                                       text-xs
                                       text-gray-600"
                            >
                                Sampai Tanggal
                            </label>

                            <input
                                type="date"
                                name="date_to"
                                value="{{ request('date_to') }}"
                                class="w-full
                                       rounded-2xl
                                       border-gray-200
                                       shadow-sm
                                       focus:border-green-700
                                       focus:ring-green-700"
                            >

                        </div>

                    </div>



                    <div
                        class="flex
                               flex-col
                               md:flex-row
                               gap-3
                               mt-4
                               justify-end"
                    >

                        <button
                            type="submit"
                            class="bg-green-800
                                   hover:bg-green-900
                                   text-white
                                   px-6
                                   py-3
                                   rounded-2xl
                                   font-semibold
                                   shadow-sm"
                        >

                            Cari Data

                        </button>


                        @if(
                            request('search')
                            || request('date_from')
                            || request('date_to')
                        )

                            <a
                                href="{{ route('published-books.index') }}"
                                class="bg-gray-100
                                       hover:bg-gray-200
                                       text-gray-700
                                       px-6
                                       py-3
                                       rounded-2xl
                                       font-semibold
                                       text-center"
                            >
                                Reset
                            </a>

                        @endif

                    </div>

                </div>

            </form>

        </div>



        {{-- ====================================================== --}}
        {{-- TABLE --}}
        {{-- ====================================================== --}}

        <div
            class="bg-white
                   rounded-3xl
                   shadow-sm
                   border border-gray-100
                   overflow-hidden"
        >

            <div class="overflow-x-auto">

                <table class="w-full">


                    {{-- TABLE HEAD --}}

                    <thead class="bg-green-950 text-white">

                        <tr>

                            <th class="p-4 text-left">
                                Cover
                            </th>

                            <th class="p-4 text-left">
                                Tanggal Terbit
                            </th>

                            <th class="p-4 text-left">
                                Buku
                            </th>

                            <th class="p-4 text-left">
                                File
                            </th>

                            <th class="p-4 text-left">
                                E-Book
                            </th>

                            <th class="p-4 text-left">
                                Catatan
                            </th>

                            <th class="p-4 text-left">
                                Aksi
                            </th>

                        </tr>

                    </thead>



                    {{-- TABLE BODY --}}

                    <tbody class="divide-y divide-gray-100">


                        @forelse($publishedBooks as $book)


                            @php
                                $coverUrl =
                                    $mediaUrl(
                                        $book->cover_path
                                    );

                                $pdfUrl =
                                    $mediaUrl(
                                        $book->book_pdf_path
                                    );

                                $certificateUrl =
                                    $mediaUrl(
                                        $book->certificate_archive_path
                                    );
                            @endphp



                            {{-- ========================================== --}}
                            {{-- DATA ROW --}}
                            {{-- ========================================== --}}

                            <tr class="hover:bg-gray-50 transition">


                                {{-- COVER --}}

                                <td class="p-4">

                                    @if($coverUrl)

                                        <img
                                            src="{{ $coverUrl }}"
                                            alt="Cover {{ $book->title }}"
                                            class="w-16
                                                   h-24
                                                   object-cover
                                                   rounded-xl
                                                   border
                                                   border-gray-200
                                                   shadow-sm
                                                   cursor-pointer
                                                   hover:scale-105
                                                   transition"
                                            onclick="openImage('{{ $coverUrl }}')"
                                        >

                                    @else

                                        <div
                                            class="w-16
                                                   h-24
                                                   rounded-xl
                                                   bg-gray-100
                                                   text-gray-400
                                                   flex
                                                   items-center
                                                   justify-center
                                                   text-xs
                                                   border
                                                   text-center"
                                        >
                                            No Cover
                                        </div>

                                    @endif

                                </td>



                                {{-- TANGGAL --}}

                                <td class="p-4 text-gray-700">

                                    {{
                                        $book->published_date
                                            ? $book->published_date->format('d-m-Y')
                                            : '-'
                                    }}

                                </td>



                                {{-- BUKU --}}

                                <td class="p-4">

                                    <p
                                        class="font-bold
                                               text-gray-900
                                               max-w-md"
                                    >
                                        {{ $book->title }}
                                    </p>


                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $book->author_name }}
                                    </p>


                                    <p class="text-xs text-gray-400 mt-1">

                                        {{
                                            $book->publisher
                                            ?? 'Penerbit belum diisi'
                                        }}

                                        @if($book->isbn)

                                            | ISBN {{ $book->isbn }}

                                        @endif

                                    </p>

                                </td>



                                {{-- FILE --}}

                                <td class="p-4">

                                    <div class="flex flex-col gap-2">


                                        {{-- PDF --}}

                                        @if($pdfUrl)

                                            <a
                                                href="{{ $pdfUrl }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="inline-flex
                                                       w-fit
                                                       text-blue-700
                                                       hover:underline
                                                       font-semibold
                                                       text-sm"
                                            >
                                                Buka PDF
                                            </a>

                                        @else

                                            <span class="text-xs text-gray-400">
                                                PDF belum ada
                                            </span>

                                        @endif



                                        {{-- CERTIFICATE --}}

                                        @if($certificateUrl)

                                            <a
                                                href="{{ $certificateUrl }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="inline-flex
                                                       w-fit
                                                       text-emerald-700
                                                       hover:underline
                                                       font-semibold
                                                       text-sm"
                                            >
                                                Unduh Sertifikat
                                            </a>

                                        @else

                                            <span class="text-xs text-gray-400">
                                                Sertifikat belum ada
                                            </span>

                                        @endif



                                        {{-- COVER --}}

                                        @if($coverUrl)

                                            <button
                                                type="button"
                                                onclick="openImage('{{ $coverUrl }}')"
                                                class="inline-flex
                                                       w-fit
                                                       text-orange-700
                                                       hover:underline
                                                       font-semibold
                                                       text-sm"
                                            >
                                                Lihat Cover
                                            </button>

                                        @endif

                                    </div>

                                </td>



                                {{-- E-BOOK --}}

                                <td class="p-4 min-w-[160px]">

                                    @if($book->is_for_sale)

                                        <div class="space-y-2">


                                            <span
                                                class="inline-flex
                                                       bg-green-100
                                                       text-green-700
                                                       px-3
                                                       py-1
                                                       rounded-full
                                                       text-xs
                                                       font-bold"
                                            >
                                                Dijual
                                            </span>


                                            @if($book->price !== null)

                                                <p class="font-bold text-gray-800">

                                                    Rp {{
                                                        number_format(
                                                            (float) $book->price,
                                                            0,
                                                            ',',
                                                            '.'
                                                        )
                                                    }}

                                                </p>

                                            @else

                                                <p class="text-xs text-orange-500">
                                                    Harga belum diisi
                                                </p>

                                            @endif


                                            @if($book->ebook_path)

                                                <p
                                                    class="text-xs
                                                           font-semibold
                                                           text-green-600"
                                                >
                                                    ✓ File e-book tersedia
                                                </p>

                                            @else

                                                <p
                                                    class="text-xs
                                                           font-semibold
                                                           text-red-500"
                                                >
                                                    File e-book belum ada
                                                </p>

                                            @endif

                                        </div>

                                    @else

                                        <span
                                            class="inline-flex
                                                   bg-gray-100
                                                   text-gray-500
                                                   px-3
                                                   py-1
                                                   rounded-full
                                                   text-xs
                                                   font-semibold"
                                        >
                                            Tidak Dijual
                                        </span>

                                    @endif

                                </td>



                                {{-- CATATAN --}}

                                <td
                                    class="p-4
                                           text-gray-600
                                           max-w-xs"
                                >
                                    {{ $book->note ?? '-' }}
                                </td>



                                {{-- AKSI --}}

                                <td class="p-4">

                                    <div class="flex gap-2 flex-wrap">


                                        {{-- EDIT --}}

                                        <button
                                            type="button"
                                            onclick="
                                                document
                                                .getElementById(
                                                    'edit-published-book-{{ $book->id }}'
                                                )
                                                .classList
                                                .toggle('hidden')
                                            "
                                            class="bg-yellow-500
                                                   hover:bg-yellow-600
                                                   text-white
                                                   px-3
                                                   py-2
                                                   rounded-xl
                                                   text-sm
                                                   shadow-sm"
                                        >
                                            Edit
                                        </button>



                                        {{-- DELETE --}}

                                        <form
                                            action="{{ route('published-books.destroy', $book) }}"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Yakin ingin menghapus data buku terbit ini?'
                                                )
                                            "
                                        >

                                            @csrf
                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="bg-red-600
                                                       hover:bg-red-700
                                                       text-white
                                                       px-3
                                                       py-2
                                                       rounded-xl
                                                       text-sm
                                                       shadow-sm"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>



                            {{-- ========================================== --}}
                            {{-- FORM EDIT --}}
                            {{-- ========================================== --}}

                            <tr
                                id="edit-published-book-{{ $book->id }}"
                                class="hidden bg-gray-50"
                            >

                                <td colspan="7" class="p-5">


                                    <form
                                        action="{{ route('published-books.update', $book) }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >

                                        @csrf
                                        @method('PATCH')



                                        {{-- ====================================== --}}
                                        {{-- BASIC DATA --}}
                                        {{-- ====================================== --}}

                                        <div
                                            class="grid
                                                   grid-cols-1
                                                   md:grid-cols-3
                                                   gap-4"
                                        >


                                            {{-- DATE --}}

                                            <div>

                                                <label class="block text-xs text-gray-500 mb-1">
                                                    Tanggal Terbit
                                                </label>

                                                <input
                                                    type="date"
                                                    name="published_date"
                                                    value="{{
                                                        $book->published_date
                                                            ? $book->published_date->format('Y-m-d')
                                                            : ''
                                                    }}"
                                                    class="w-full
                                                           rounded-2xl
                                                           border-gray-200"
                                                    required
                                                >

                                            </div>



                                            {{-- AUTHOR --}}

                                            <div>

                                                <label class="block text-xs text-gray-500 mb-1">
                                                    Penulis
                                                </label>

                                                <input
                                                    type="text"
                                                    name="author_name"
                                                    value="{{ $book->author_name }}"
                                                    class="w-full
                                                           rounded-2xl
                                                           border-gray-200"
                                                    required
                                                >

                                            </div>



                                            {{-- PUBLISHER --}}

                                            <div>

                                                <label class="block text-xs text-gray-500 mb-1">
                                                    Penerbit
                                                </label>

                                                <input
                                                    type="text"
                                                    name="publisher"
                                                    value="{{ $book->publisher }}"
                                                    class="w-full
                                                           rounded-2xl
                                                           border-gray-200"
                                                >

                                            </div>

                                        </div>



                                        {{-- TITLE --}}

                                        <div class="mt-4">

                                            <label class="block text-xs text-gray-500 mb-1">
                                                Judul Buku
                                            </label>

                                            <textarea
                                                name="title"
                                                rows="3"
                                                class="w-full
                                                       rounded-2xl
                                                       border-gray-200"
                                                required
                                            >{{ $book->title }}</textarea>

                                        </div>



                                        {{-- ISBN + NOTE --}}

                                        <div
                                            class="grid
                                                   grid-cols-1
                                                   md:grid-cols-2
                                                   gap-4
                                                   mt-4"
                                        >

                                            <div>

                                                <label class="block text-xs text-gray-500 mb-1">
                                                    ISBN
                                                </label>

                                                <input
                                                    type="text"
                                                    name="isbn"
                                                    value="{{ $book->isbn }}"
                                                    class="w-full
                                                           rounded-2xl
                                                           border-gray-200"
                                                >

                                            </div>


                                            <div>

                                                <label class="block text-xs text-gray-500 mb-1">
                                                    Catatan
                                                </label>

                                                <input
                                                    type="text"
                                                    name="note"
                                                    value="{{ $book->note }}"
                                                    class="w-full
                                                           rounded-2xl
                                                           border-gray-200"
                                                >

                                            </div>

                                        </div>



                                        {{-- ====================================== --}}
                                        {{-- PENJUALAN E-BOOK --}}
                                        {{-- ====================================== --}}

                                        <div
                                            class="mt-6
                                                   pt-5
                                                   border-t
                                                   border-gray-200"
                                        >

                                            <div class="mb-4">

                                                <h3
                                                    class="text-lg
                                                           font-bold
                                                           text-green-950"
                                                >
                                                    Penjualan E-Book
                                                </h3>

                                                <p
                                                    class="text-xs
                                                           text-gray-500
                                                           mt-1"
                                                >
                                                    Atur harga, status penjualan,
                                                    dan file digital e-book.
                                                </p>

                                            </div>



                                            <div
                                                class="grid
                                                       grid-cols-1
                                                       md:grid-cols-3
                                                       gap-4"
                                            >


                                                {{-- PRICE --}}

                                                <div>

                                                    <label
                                                        class="block
                                                               mb-2
                                                               text-sm
                                                               font-semibold
                                                               text-gray-700"
                                                    >
                                                        Harga E-Book
                                                    </label>


                                                    <div class="relative">

                                                        <span
                                                            class="absolute
                                                                   left-4
                                                                   top-1/2
                                                                   -translate-y-1/2
                                                                   text-gray-500"
                                                        >
                                                            Rp
                                                        </span>


                                                        <input
                                                            type="number"
                                                            name="price"
                                                            value="{{ $book->price }}"
                                                            min="0"
                                                            step="1"
                                                            placeholder="75000"
                                                            class="w-full
                                                                   pl-12
                                                                   rounded-2xl
                                                                   border-gray-200"
                                                        >

                                                    </div>

                                                </div>



                                                {{-- STATUS --}}

                                                <div>

                                                    <label
                                                        class="block
                                                               mb-2
                                                               text-sm
                                                               font-semibold
                                                               text-gray-700"
                                                    >
                                                        Status Penjualan
                                                    </label>


                                                    <input
                                                        type="hidden"
                                                        name="is_for_sale"
                                                        value="0"
                                                    >


                                                    <label
                                                        class="flex
                                                               items-center
                                                               gap-3
                                                               border
                                                               border-gray-200
                                                               rounded-2xl
                                                               px-4
                                                               py-3
                                                               bg-white"
                                                    >

                                                        <input
                                                            type="checkbox"
                                                            name="is_for_sale"
                                                            value="1"
                                                            {{
                                                                $book->is_for_sale
                                                                    ? 'checked'
                                                                    : ''
                                                            }}
                                                            class="rounded
                                                                   text-green-700
                                                                   focus:ring-green-700"
                                                        >


                                                        <div>

                                                            <p
                                                                class="font-semibold
                                                                       text-gray-700"
                                                            >
                                                                Dijual sebagai E-Book
                                                            </p>

                                                            <p class="text-xs text-gray-400">
                                                                Tombol beli akan tampil jika diaktifkan.
                                                            </p>

                                                        </div>

                                                    </label>

                                                </div>



                                                {{-- EBOOK FILE --}}

                                                <div>

                                                    <label
                                                        class="block
                                                               mb-2
                                                               text-sm
                                                               font-semibold
                                                               text-gray-700"
                                                    >

                                                        Ganti File E-Book

                                                        <span class="font-normal text-gray-400">
                                                            (Opsional jika sudah ada)
                                                        </span>

                                                    </label>


                                                    <input
                                                        type="file"
                                                        name="ebook_file"
                                                        accept=".pdf,application/pdf"
                                                        class="w-full
                                                               border
                                                               border-gray-200
                                                               rounded-2xl
                                                               p-3
                                                               text-sm
                                                               bg-white"
                                                    >


                                                    @if($book->ebook_path)

                                                        <p
                                                            class="text-xs
                                                                   text-green-600
                                                                   font-semibold
                                                                   mt-2"
                                                        >
                                                            ✓ File e-book sudah tersedia
                                                        </p>

                                                    @else

                                                        <p
                                                            class="text-xs
                                                                   text-gray-400
                                                                   mt-2"
                                                        >
                                                            Belum ada file e-book
                                                        </p>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>



                                        {{-- ====================================== --}}
                                        {{-- FILE ARSIP --}}
                                        {{-- ====================================== --}}

                                        <div
                                            class="grid
                                                   grid-cols-1
                                                   md:grid-cols-3
                                                   gap-4
                                                   mt-6"
                                        >


                                            {{-- PDF --}}

                                            <div>

                                                <label
                                                    class="block
                                                           mb-2
                                                           text-sm
                                                           font-semibold
                                                           text-gray-700"
                                                >

                                                    Ganti PDF Buku

                                                    <span class="font-normal text-gray-400">
                                                        (Opsional)
                                                    </span>

                                                </label>

                                                <input
                                                    type="file"
                                                    name="book_pdf"
                                                    accept=".pdf,application/pdf"
                                                    class="w-full
                                                           border
                                                           border-gray-200
                                                           rounded-2xl
                                                           p-3
                                                           text-sm
                                                           bg-white"
                                                >


                                                @if($book->book_pdf_path)

                                                    <p
                                                        class="text-xs
                                                               text-green-600
                                                               font-semibold
                                                               mt-2"
                                                    >
                                                        ✓ PDF buku sudah tersedia
                                                    </p>

                                                    <p class="text-xs text-gray-400 mt-1">
                                                        Kosongkan jika tidak ingin mengganti PDF lama.
                                                    </p>

                                                @else

                                                    <p class="text-xs text-gray-400 mt-2">
                                                        PDF buku belum tersedia dan tidak wajib diunggah.
                                                    </p>

                                                @endif

                                            </div>



                                            {{-- CERTIFICATE --}}

                                            <div>

                                                <label
                                                    class="block
                                                           mb-2
                                                           text-sm
                                                           font-semibold
                                                           text-gray-700"
                                                >

                                                    Ganti Sertifikat

                                                    <span class="font-normal text-gray-400">
                                                        (Opsional)
                                                    </span>

                                                </label>

                                                <input
                                                    type="file"
                                                    name="certificate_archive"
                                                    accept=".rar,.zip,.pdf,application/pdf"
                                                    class="w-full
                                                           border
                                                           border-gray-200
                                                           rounded-2xl
                                                           p-3
                                                           text-sm
                                                           bg-white"
                                                >


                                                @if($book->certificate_archive_path)

                                                    <p
                                                        class="text-xs
                                                               text-green-600
                                                               font-semibold
                                                               mt-2"
                                                    >
                                                        ✓ Sertifikat sudah tersedia
                                                    </p>

                                                @else

                                                    <p class="text-xs text-gray-400 mt-2">
                                                        Sertifikat belum tersedia.
                                                    </p>

                                                @endif

                                            </div>



                                            {{-- COVER --}}

                                            <div>

                                                <label
                                                    class="block
                                                           mb-2
                                                           text-sm
                                                           font-semibold
                                                           text-gray-700"
                                                >

                                                    Ganti Cover

                                                    <span class="font-normal text-gray-400">
                                                        (Opsional)
                                                    </span>

                                                </label>


                                                @if($coverUrl)

                                                    <div class="mb-2">

                                                        <img
                                                            src="{{ $coverUrl }}"
                                                            alt="Cover {{ $book->title }}"
                                                            class="w-16
                                                                   h-24
                                                                   object-cover
                                                                   rounded-xl
                                                                   border
                                                                   border-gray-200
                                                                   shadow-sm"
                                                        >

                                                    </div>

                                                @endif


                                                <input
                                                    type="file"
                                                    name="cover"
                                                    accept="image/jpeg,image/png,image/webp"
                                                    class="w-full
                                                           border
                                                           border-gray-200
                                                           rounded-2xl
                                                           p-3
                                                           text-sm
                                                           bg-white"
                                                >

                                                <p class="text-xs text-gray-400 mt-2">
                                                    Kosongkan jika tidak ingin mengganti cover.
                                                </p>

                                            </div>

                                        </div>



                                        {{-- UPDATE --}}

                                        <button
                                            type="submit"
                                            class="mt-5
                                                   bg-blue-700
                                                   hover:bg-blue-800
                                                   text-white
                                                   px-5
                                                   py-2
                                                   rounded-2xl
                                                   shadow-sm"
                                        >
                                            Update
                                        </button>

                                    </form>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="p-10
                                           text-center
                                           text-gray-500"
                                >

                                    <p class="font-semibold">
                                        Belum ada data buku terbit.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>



                {{-- PAGINATION --}}

                <div class="p-6 border-t border-gray-100">

                    {{ $publishedBooks->links() }}

                </div>

            </div>

        </div>

    </div>



    {{-- ====================================================== --}}
    {{-- MODAL PREVIEW COVER --}}
    {{-- ====================================================== --}}

    <div
        id="imageModal"
        class="fixed
               inset-0
               bg-black/80
               hidden
               items-center
               justify-center
               z-50
               p-6"
    >

        <div
            class="relative
                   max-w-5xl
                   w-full
                   flex
                   justify-center"
        >

            <button
                type="button"
                onclick="closeImage()"
                class="absolute
                       top-0
                       right-0
                       -mt-12
                       text-white
                       text-4xl
                       font-bold
                       hover:text-red-400
                       transition"
            >
                &times;
            </button>


            <img
                id="previewImage"
                src=""
                alt="Preview Cover"
                class="max-h-[90vh]
                       rounded-3xl
                       shadow-2xl
                       border-4
                       border-white"
            >

        </div>

    </div>



    {{-- ====================================================== --}}
    {{-- JAVASCRIPT --}}
    {{-- ====================================================== --}}

    <script>

        function openImage(src) {

            document
                .getElementById('previewImage')
                .src = src;


            const modal =
                document.getElementById('imageModal');


            modal.classList.remove('hidden');

            modal.classList.add('flex');

        }


        function closeImage() {

            const modal =
                document.getElementById('imageModal');


            modal.classList.remove('flex');

            modal.classList.add('hidden');


            document
                .getElementById('previewImage')
                .src = '';

        }


        document
            .getElementById('imageModal')
            .addEventListener(
                'click',
                function(event) {

                    if (event.target === this) {

                        closeImage();

                    }

                }
            );


        document.addEventListener(
            'keydown',
            function(event) {

                if (event.key === 'Escape') {

                    closeImage();

                }

            }
        );

       </script>


    {{-- ====================================================== --}}
    {{-- LEGAL FOOTER --}}
    {{-- ====================================================== --}}

    @include('public.partials.legal-footer')


</x-app-layout>