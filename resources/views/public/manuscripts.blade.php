@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Manuscript Published | PT ANOA Sejahtera Mandiri
    </title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-gray-50 text-gray-800">


{{-- ========================================================= --}}
{{-- NAVBAR --}}
{{-- ========================================================= --}}
<header class="bg-green-950 shadow-lg">

    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <a href="{{ url('/') }}"
           class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-2xl bg-white p-1.5">

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Logo PT ANOA"
                    class="w-full h-full object-contain"
                >

            </div>


            <div>

                <h1 class="text-white font-extrabold">
                    PT ANOA
                </h1>

                <p class="text-green-100 text-xs">
                    Sejahtera Mandiri
                </p>

            </div>

        </a>



        {{-- NAVIGATION --}}
        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold">

            <a
                href="{{ url('/') }}"
                class="text-green-100 hover:text-yellow-300 transition"
            >
                Home
            </a>


            @if(Route::has('public.books'))

                <a
                    href="{{ route('public.books') }}"
                    class="text-green-100 hover:text-yellow-300 transition"
                >
                    Buku
                </a>

            @endif


            @if(Route::has('public.published-books'))

                <a
                    href="{{ route('public.published-books') }}"
                    class="text-green-100 hover:text-yellow-300 transition"
                >
                    Buku Terbit
                </a>

            @endif


            <a
                href="{{ route('public.manuscripts') }}"
                class="text-yellow-300"
            >
                Manuscript Published
            </a>

        </nav>

    </div>

</header>



{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}
<section class="bg-gradient-to-br from-green-950 via-green-900 to-emerald-800">

    <div class="max-w-7xl mx-auto px-6 py-16">

        <p class="text-yellow-400
                  uppercase
                  tracking-wider
                  font-bold
                  text-sm">

            Publikasi Ilmiah

        </p>


        <h2 class="text-4xl
                   md:text-5xl
                   font-extrabold
                   text-white
                   mt-3">

            Manuscript Published

        </h2>


        <p class="text-green-100 mt-4 max-w-3xl">

            Daftar manuscript yang telah berhasil dipublikasikan
            bersama PT ANOA Sejahtera Mandiri.

        </p>

    </div>

</section>



{{-- ========================================================= --}}
{{-- CONTENT --}}
{{-- ========================================================= --}}
<main class="max-w-7xl mx-auto px-6 py-12">


    {{-- ===================================================== --}}
    {{-- SEARCH --}}
    {{-- ===================================================== --}}
    <form
        method="GET"
        action="{{ route('public.manuscripts') }}"
        class="bg-white
               rounded-3xl
               border border-gray-100
               shadow-sm
               p-5
               mb-10"
    >

        <div class="flex flex-col md:flex-row gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari penulis, judul manuscript, atau jurnal..."
                class="flex-1
                       rounded-2xl
                       border-gray-200
                       focus:border-green-700
                       focus:ring-green-700"
            >


            <button
                type="submit"
                class="bg-green-800
                       hover:bg-green-900
                       text-white
                       px-7
                       py-3
                       rounded-2xl
                       font-semibold
                       transition"
            >

                Cari

            </button>


            @if(request('search'))

                <a
                    href="{{ route('public.manuscripts') }}"
                    class="bg-gray-100
                           hover:bg-gray-200
                           text-gray-700
                           px-7
                           py-3
                           rounded-2xl
                           font-semibold
                           text-center
                           transition"
                >

                    Reset

                </a>

            @endif

        </div>

    </form>



    {{-- ===================================================== --}}
    {{-- HEADER LIST --}}
    {{-- ===================================================== --}}
    <div class="flex flex-col
                sm:flex-row
                sm:items-center
                sm:justify-between
                gap-4
                mb-6">

        <div>

            <h3 class="text-2xl
                       font-extrabold
                       text-green-950">

                Daftar Manuscript Published

            </h3>


            @if($search)

                <p class="text-gray-500 text-sm mt-1">

                    Hasil pencarian:

                    <strong>
                        {{ $search }}
                    </strong>

                </p>

            @endif

        </div>


        <span class="bg-green-100
                     text-green-800
                     px-4
                     py-2
                     rounded-full
                     font-bold
                     text-sm">

            {{ $manuscripts->total() }}
            Manuscript

        </span>

    </div>



    {{-- ===================================================== --}}
    {{-- TABLE --}}
    {{-- ===================================================== --}}
    <div class="bg-white
                rounded-3xl
                border border-gray-100
                shadow-sm
                overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">


                {{-- TABLE HEAD --}}
                <thead>

                    <tr class="bg-green-950 text-white">

                        <th class="px-5 py-4 text-left font-semibold">
                            Scopus/Sinta
                        </th>

                        <th class="px-5 py-4 text-left font-semibold">
                            Penulis
                        </th>

                        <th class="px-5 py-4 text-left font-semibold">
                            Judul
                        </th>

                        <th class="px-5 py-4 text-left font-semibold">
                            Jurnal / DOI
                        </th>

                    </tr>

                </thead>



                {{-- TABLE BODY --}}
                <tbody class="divide-y divide-gray-100">

                    @forelse($manuscripts as $item)

                        @php

                            $photoUrl = null;

                            if (!empty($item->photo)) {

                                $photoPath = str_replace(
                                    '\\',
                                    '/',
                                    $item->photo
                                );

                                $photoPath = ltrim(
                                    $photoPath,
                                    '/'
                                );

                                $photoPath = Str::replaceFirst(
                                    'public/',
                                    '',
                                    $photoPath
                                );

                                $photoPath = Str::replaceFirst(
                                    'storage/',
                                    '',
                                    $photoPath
                                );

                                $photoUrl = route(
                                    'media.show',
                                    ['path' => $photoPath]
                                );
                            }

                        @endphp



                        <tr class="hover:bg-green-50/60 transition">


                            {{-- ========================================= --}}
                            {{-- FOTO --}}
                            {{-- ========================================= --}}
                            <td class="px-5 py-5 align-top">

                                @if($photoUrl)

                                    <div class="flex flex-col items-start gap-2">


                                        {{-- THUMBNAIL --}}
                                        <img
                                            src="{{ $photoUrl }}"
                                            alt="Foto Manuscript"
                                            class="w-20
                                                   h-20
                                                   object-cover
                                                   rounded-2xl
                                                   border
                                                   border-gray-200
                                                   shadow-sm
                                                   cursor-pointer
                                                   hover:scale-105
                                                   transition"
                                            onclick="openImage('{{ $photoUrl }}')"
                                        >


                                        {{-- BUTTON --}}
                                        <button
                                            type="button"
                                            onclick="openImage('{{ $photoUrl }}')"
                                            class="bg-blue-600
                                                   hover:bg-blue-700
                                                   text-white
                                                   text-xs
                                                   font-semibold
                                                   px-3
                                                   py-1.5
                                                   rounded-xl
                                                   shadow-sm
                                                   transition"
                                        >

                                            Lihat Foto

                                        </button>

                                    </div>


                                @else

                                    <div class="flex flex-col items-start gap-2">

                                        <div class="w-20
                                                    h-20
                                                    bg-gray-100
                                                    rounded-2xl
                                                    flex
                                                    items-center
                                                    justify-center
                                                    text-gray-400
                                                    text-xs
                                                    border">

                                            No Image

                                        </div>


                                        <span class="text-xs text-gray-400">

                                            Tidak ada foto

                                        </span>

                                    </div>

                                @endif

                            </td>



                            {{-- ========================================= --}}
                            {{-- PENULIS --}}
                            {{-- ========================================= --}}
                            <td class="px-5
                                       py-5
                                       align-top
                                       min-w-[220px]">

                                <p class="font-semibold
                                          text-gray-800
                                          leading-relaxed">

                                    {{ $item->author_name }}

                                </p>

                            </td>



                            {{-- ========================================= --}}
                            {{-- JUDUL --}}
                            {{-- ========================================= --}}
                            <td class="px-5
                                       py-5
                                       align-top
                                       min-w-[350px]">

                                <p class="font-bold
                                          text-green-950
                                          leading-relaxed">

                                    {{ $item->title }}

                                </p>

                            </td>



                            {{-- ========================================= --}}
                            {{-- JURNAL / DOI --}}
                            {{-- ========================================= --}}
                            <td class="px-5
                                       py-5
                                       align-top
                                       min-w-[180px]">

                                @if(
                                    Str::startsWith(
                                        $item->journal,
                                        ['http://', 'https://']
                                    )
                                )

                                    <a
                                        href="{{ $item->journal }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex
                                               items-center
                                               gap-2
                                               bg-blue-50
                                               hover:bg-blue-100
                                               text-blue-700
                                               font-semibold
                                               px-4
                                               py-2
                                               rounded-xl
                                               transition"
                                    >

                                        🔗 Buka Jurnal / DOI

                                    </a>


                                @else

                                    <span class="text-gray-700 leading-relaxed">

                                        {{ $item->journal }}

                                    </span>

                                @endif

                            </td>


                        </tr>



                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="px-6
                                       py-16
                                       text-center"
                            >

                                <div class="text-5xl mb-4">
                                    📭
                                </div>


                                <h3 class="font-bold
                                           text-lg
                                           text-gray-800">

                                    Belum ada manuscript published

                                </h3>


                                <p class="text-gray-500 mt-2">

                                    Manuscript dengan status Published
                                    akan tampil otomatis di sini.

                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>



        {{-- ================================================= --}}
        {{-- PAGINATION --}}
        {{-- ================================================= --}}
        @if($manuscripts->hasPages())

            <div class="p-6
                        border-t
                        border-gray-100
                        bg-gray-50">

                {{ $manuscripts->links() }}

            </div>

        @endif

    </div>


</main>



{{-- ========================================================= --}}
{{-- MODAL FOTO --}}
{{-- ========================================================= --}}
<div
    id="imageModal"
    class="fixed
           inset-0
           z-[9999]
           hidden
           bg-black/80
           items-center
           justify-center
           p-4"
>

    <div class="relative max-w-5xl w-full">


        {{-- CLOSE BUTTON --}}
        <button
            type="button"
            onclick="closeImage()"
            class="absolute
                   -top-12
                   right-0
                   text-white
                   text-4xl
                   font-bold
                   hover:text-red-400
                   transition"
        >

            &times;

        </button>


        {{-- PREVIEW --}}
        <img
            id="previewImage"
            src=""
            alt="Preview Foto Manuscript"
            class="max-w-full
                   max-h-[85vh]
                   mx-auto
                   object-contain
                   rounded-2xl
                   bg-white
                   shadow-2xl"
        >

    </div>

</div>



{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}
<footer class="bg-green-950 text-white mt-16">

    <div class="max-w-7xl
                mx-auto
                px-6
                py-8
                text-center">

        <p class="font-bold">

            PT ANOA Sejahtera Mandiri

        </p>


        <p class="text-green-100 text-sm mt-2">

            © {{ date('Y') }}
            PT ANOA Sejahtera Mandiri.
            Semua hak dilindungi.

        </p>

    </div>

</footer>



{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}
<script>

    /*
    |--------------------------------------------------------------------------
    | BUKA FOTO
    |--------------------------------------------------------------------------
    */
    function openImage(src) {

        const modal =
            document.getElementById('imageModal');

        const image =
            document.getElementById('previewImage');


        image.src = src;


        modal.classList.remove('hidden');

        modal.classList.add('flex');


        document.body.style.overflow = 'hidden';

    }



    /*
    |--------------------------------------------------------------------------
    | TUTUP FOTO
    |--------------------------------------------------------------------------
    */
    function closeImage() {

        const modal =
            document.getElementById('imageModal');

        const image =
            document.getElementById('previewImage');


        modal.classList.remove('flex');

        modal.classList.add('hidden');


        image.src = '';


        document.body.style.overflow = '';

    }



    /*
    |--------------------------------------------------------------------------
    | KLIK AREA HITAM UNTUK MENUTUP
    |--------------------------------------------------------------------------
    */
    document
        .getElementById('imageModal')
        .addEventListener('click', function(event) {

            if (event.target === this) {

                closeImage();

            }

        });



    /*
    |--------------------------------------------------------------------------
    | TEKAN ESC UNTUK MENUTUP
    |--------------------------------------------------------------------------
    */
    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key === 'Escape') {

                const modal =
                    document.getElementById(
                        'imageModal'
                    );


                if (
                    !modal.classList.contains(
                        'hidden'
                    )
                ) {

                    closeImage();

                }

            }

        }
    );

</script>


</body>
</html>