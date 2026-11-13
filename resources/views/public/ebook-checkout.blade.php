<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Checkout E-Book | PT ANOA Sejahtera Mandiri
    </title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-gray-50">

<header class="bg-green-950">

    <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">

        <a
            href="{{ url('/') }}"
            class="text-white font-bold text-xl"
        >
            PT ANOA Sejahtera Mandiri
        </a>


        <a
            href="{{ route('public.published-books') }}"
            class="text-green-100 hover:text-yellow-300"
        >
            Kembali ke Buku
        </a>

    </div>

</header>



<main class="max-w-5xl mx-auto px-6 py-12">

    <div class="grid lg:grid-cols-2 gap-8">


        {{-- DETAIL BUKU --}}
        <div class="bg-white
                    rounded-3xl
                    border border-gray-100
                    shadow-sm
                    p-7">

            <p class="text-sm
                      uppercase
                      tracking-wider
                      text-green-700
                      font-bold">

                E-Book

            </p>


            <h1 class="text-2xl
                       font-extrabold
                       text-green-950
                       mt-3
                       leading-snug">

                {{ $publishedBook->title }}

            </h1>


            <p class="text-gray-600 mt-4">
                {{ $publishedBook->author_name }}
            </p>


            @if($publishedBook->publisher)

                <p class="text-gray-500 text-sm mt-2">
                    Penerbit:
                    {{ $publishedBook->publisher }}
                </p>

            @endif


            @if($publishedBook->isbn)

                <p class="text-gray-400 text-sm mt-2">
                    ISBN {{ $publishedBook->isbn }}
                </p>

            @endif


            <div class="mt-7 pt-5 border-t border-gray-100">

                <p class="text-sm text-gray-500">
                    Total Pembayaran
                </p>


                <p class="text-3xl
                          font-extrabold
                          text-green-900
                          mt-1">

                    Rp {{
                        number_format(
                            (float) $publishedBook->price,
                            0,
                            ',',
                            '.'
                        )
                    }}

                </p>

            </div>

        </div>



        {{-- FORM PEMBELI --}}
        <div class="bg-white
                    rounded-3xl
                    border border-gray-100
                    shadow-sm
                    p-7">

            <h2 class="text-xl
                       font-extrabold
                       text-green-950">

                Data Pembeli

            </h2>


            <p class="text-gray-500 text-sm mt-2 mb-6">
                Isi data berikut untuk melanjutkan pembayaran.
            </p>



            @if($errors->any())

                <div class="mb-5
                            bg-red-50
                            border border-red-200
                            text-red-700
                            rounded-2xl
                            p-4">

                    <ul class="list-disc ms-5">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            <form
                method="POST"
                action="{{
                    route(
                        'ebook.checkout.store',
                        $publishedBook
                    )
                }}"
            >

                @csrf


                {{-- NAMA --}}
                <div class="mb-4">

                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Nama Lengkap
                    </label>


                    <input
                        type="text"
                        name="buyer_name"
                        value="{{ old('buyer_name') }}"
                        required
                        class="w-full
                               rounded-2xl
                               border-gray-200
                               focus:border-green-700
                               focus:ring-green-700"
                    >

                </div>



                {{-- EMAIL --}}
                <div class="mb-4">

                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Email
                    </label>


                    <input
                        type="email"
                        name="buyer_email"
                        value="{{ old('buyer_email') }}"
                        required
                        class="w-full
                               rounded-2xl
                               border-gray-200
                               focus:border-green-700
                               focus:ring-green-700"
                    >

                    <p class="text-xs text-gray-400 mt-1">
                        Email akan digunakan untuk informasi pembelian.
                    </p>

                </div>



                {{-- WHATSAPP --}}
                <div class="mb-6">

                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        No. WhatsApp
                    </label>


                    <input
                        type="text"
                        name="buyer_phone"
                        value="{{ old('buyer_phone') }}"
                        placeholder="08xxxxxxxxxx"
                        required
                        class="w-full
                               rounded-2xl
                               border-gray-200
                               focus:border-green-700
                               focus:ring-green-700"
                    >

                </div>



                <button
                    type="submit"
                    class="w-full
                           bg-green-800
                           hover:bg-green-900
                           text-white
                           font-bold
                           px-6
                           py-4
                           rounded-2xl
                           transition"
                >

                    Lanjutkan Pembayaran

                </button>

            </form>

        </div>

    </div>

</main>


</body>
</html>