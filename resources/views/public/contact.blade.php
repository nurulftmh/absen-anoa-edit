<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Kontak Kami | PT ANOA Sejahtera Mandiri
    </title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-gray-50 min-h-screen">


<header class="bg-green-950">

    <div class="max-w-5xl
                mx-auto
                px-6
                py-5
                flex
                items-center
                justify-between">

        <a
            href="{{ url('/') }}"
            class="text-white font-bold"
        >
            PT ANOA Sejahtera Mandiri
        </a>

        <a
            href="{{ route('public.published-books') }}"
            class="text-green-100
                   hover:text-yellow-300"
        >
            Kembali ke Buku
        </a>

    </div>

</header>



<main class="max-w-4xl mx-auto px-6 py-12">


    <div class="bg-white
                rounded-3xl
                border
                border-gray-100
                shadow-sm
                overflow-hidden">


        <div class="bg-gradient-to-r
                    from-green-950
                    to-emerald-800
                    p-8
                    text-white">

            <p class="text-green-200
                      font-bold
                      uppercase
                      tracking-wide
                      text-sm">

                Bantuan Pelanggan

            </p>

            <h1 class="text-3xl
                       md:text-4xl
                       font-extrabold
                       mt-2">

                Kontak Kami

            </h1>

            <p class="text-green-100
                      mt-3
                      max-w-2xl">

                Hubungi PT ANOA Sejahtera Mandiri untuk
                pertanyaan mengenai pembelian buku,
                e-book, pembayaran, akses produk digital,
                atau refund.

            </p>

        </div>



        <div class="p-8">


            <div class="grid
                        grid-cols-1
                        md:grid-cols-2
                        gap-5">


                <div class="border
                            border-green-100
                            rounded-2xl
                            p-5">

                    <p class="text-sm
                              text-gray-400
                              uppercase
                              font-bold">

                        Nama Perusahaan

                    </p>

                    <p class="font-bold
                              text-green-950
                              mt-2">

                        PT ANOA Sejahtera Mandiri

                    </p>

                </div>



                <div class="border
                            border-green-100
                            rounded-2xl
                            p-5">

                    <p class="text-sm
                              text-gray-400
                              uppercase
                              font-bold">

                        Email

                    </p>

                    <a
                        href="mailto:anoasejahtera238@gmail.com"
                        class="font-bold
                               text-green-700
                               hover:underline
                               mt-2
                               block
                               break-all"
                    >
                        anoasejahtera238@gmail.com
                    </a>

                </div>



                <div class="border
                            border-green-100
                            rounded-2xl
                            p-5">

                    <p class="text-sm
                              text-gray-400
                              uppercase
                              font-bold">

                        Website

                    </p>

                    <a
                        href="https://anoasejahteramandiri.com"
                        class="font-bold
                               text-green-700
                               hover:underline
                               mt-2
                               block"
                    >
                        anoasejahteramandiri.com
                    </a>

                </div>



                <div class="border
                            border-green-100
                            rounded-2xl
                            p-5">

                    <p class="text-sm
                              text-gray-400
                              uppercase
                              font-bold">

                        Halaman Penjualan

                    </p>

                    <a
                        href="{{ route('public.published-books') }}"
                        class="font-bold
                               text-green-700
                               hover:underline
                               mt-2
                               block"
                    >
                        Buku & E-Book
                    </a>

                </div>


            </div>



            <div class="mt-8
                        bg-green-50
                        border
                        border-green-100
                        rounded-2xl
                        p-5">

                <p class="font-bold text-green-900">
                    Bantuan transaksi
                </p>

                <p class="text-gray-600 mt-2 leading-relaxed">

                    Untuk mempercepat pemeriksaan transaksi,
                    sertakan nomor order, nama pembeli,
                    email yang digunakan saat checkout,
                    dan penjelasan kendala ketika menghubungi kami.

                </p>

            </div>

        </div>

    </div>

</main>



@include('public.partials.legal-footer')


</body>
</html>