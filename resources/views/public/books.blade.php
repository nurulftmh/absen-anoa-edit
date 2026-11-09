<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Buku | PT ANOA Sejahtera Mandiri
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-50 text-gray-800">


{{-- NAVBAR --}}
<header class="bg-green-950 shadow-lg">

    <div class="max-w-7xl mx-auto px-6 py-4
                flex items-center justify-between">

        <a href="{{ url('/') }}"
           class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-2xl
                        bg-white p-1.5">

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="PT ANOA"
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
                    class="text-yellow-300"
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
                class="text-green-100 hover:text-yellow-300 transition"
            >
                Manuscript Published
            </a>

        </nav>


    </div>

</header>



{{-- HERO --}}
<section class="bg-gradient-to-br
                from-green-950
                via-green-900
                to-emerald-800">

    <div class="max-w-7xl mx-auto px-6 py-16">

        <p class="text-yellow-400
                  uppercase
                  tracking-wider
                  font-bold
                  text-sm">

            Koleksi Buku

        </p>

        <h2 class="text-4xl md:text-5xl
                   font-extrabold
                   text-white
                   mt-3">

            Buku PT ANOA Sejahtera Mandiri

        </h2>

        <p class="text-green-100 mt-4 max-w-2xl">

            Temukan karya buku yang sedang dikelola
            oleh PT ANOA Sejahtera Mandiri.

        </p>

    </div>

</section>



{{-- CONTENT --}}
<main class="max-w-7xl mx-auto px-6 py-12">


    {{-- SEARCH --}}
    <form
        method="GET"
        action="{{ route('public.books') }}"
        class="bg-white
               border border-gray-100
               shadow-sm
               rounded-3xl
               p-5
               mb-10"
    >

        <div class="flex flex-col md:flex-row gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari judul buku, nama penulis, atau status..."
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
                       font-bold
                       px-7
                       py-3
                       rounded-2xl"
            >

                🔍 Cari Buku

            </button>


            @if(request('search'))

                <a
                    href="{{ route('public.books') }}"
                    class="bg-gray-100
                           hover:bg-gray-200
                           text-gray-700
                           font-semibold
                           px-6
                           py-3
                           rounded-2xl
                           text-center"
                >

                    Reset

                </a>

            @endif

        </div>

    </form>



    {{-- JUMLAH --}}
    <div class="flex items-center justify-between mb-6">

        <div>

            <h3 class="text-2xl font-extrabold text-green-950">

                Daftar Buku

            </h3>

            @if($search)

                <p class="text-gray-500 text-sm mt-1">

                    Hasil pencarian:
                    <strong>{{ $search }}</strong>

                </p>

            @endif

        </div>


        <span class="bg-green-100
                     text-green-800
                     font-bold
                     px-4
                     py-2
                     rounded-full
                     text-sm">

            {{ $books->total() }} Buku

        </span>

    </div>



    {{-- BOOK CARDS --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($books as $book)

            <article
                class="bg-white
                       rounded-3xl
                       border border-gray-100
                       shadow-sm
                       hover:shadow-lg
                       transition
                       overflow-hidden"
            >

                <div class="h-3
                            bg-gradient-to-r
                            from-green-800
                            to-yellow-500">
                </div>


                <div class="p-6">

                    {{-- STATUS --}}
                    <div class="mb-4">

                        <span
                            class="inline-flex
                                   bg-green-100
                                   text-green-800
                                   px-3
                                   py-1
                                   rounded-full
                                   font-bold
                                   text-xs"
                        >

                            {{ $book->status }}

                        </span>

                    </div>


                    {{-- TITLE --}}
                    <h3
                        class="font-extrabold
                               text-green-950
                               text-xl
                               leading-snug"
                    >

                        {{ $book->title }}

                    </h3>


                    {{-- AUTHOR --}}
                    <div class="mt-5">

                        <p class="text-xs
                                  uppercase
                                  tracking-wide
                                  text-gray-400
                                  font-bold">

                            Penulis

                        </p>

                        <p class="text-gray-700 mt-1 leading-relaxed">

                            {{ $book->author_name }}

                        </p>

                    </div>


                    {{-- DATE --}}
                    @if($book->entry_date)

                        <div class="mt-5
                                    pt-4
                                    border-t
                                    border-gray-100">

                            <p class="text-gray-500 text-sm">

                                📅
                                {{ \Carbon\Carbon::parse($book->entry_date)->format('d M Y') }}

                            </p>

                        </div>

                    @endif

                </div>

            </article>

        @empty

            <div class="sm:col-span-2 lg:col-span-3">

                <div class="bg-white
                            rounded-3xl
                            p-12
                            text-center
                            border border-gray-100">

                    <div class="text-5xl mb-4">
                        📚
                    </div>

                    <h3 class="font-bold text-xl text-green-950">

                        Buku tidak ditemukan

                    </h3>

                    <p class="text-gray-500 mt-2">

                        Coba gunakan kata pencarian lainnya.

                    </p>

                </div>

            </div>

        @endforelse

    </div>



    {{-- PAGINATION --}}
    <div class="mt-10">

        {{ $books->links() }}

    </div>


</main>



{{-- FOOTER --}}
<footer class="bg-green-950 text-white mt-16">

    <div class="max-w-7xl mx-auto
                px-6 py-8
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


</body>
</html>