<footer class="border-t
               border-gray-200
               bg-white
               mt-10">

    <div class="max-w-5xl
                mx-auto
                px-6
                py-8">


        <div class="flex
                    flex-col
                    md:flex-row
                    md:items-center
                    md:justify-between
                    gap-5">


            <div>

                <p class="font-bold text-green-950">
                    PT ANOA Sejahtera Mandiri
                </p>

                <p class="text-sm text-gray-400 mt-1">
                    Buku & produk digital
                </p>

            </div>



            <div class="flex
                        flex-wrap
                        gap-x-5
                        gap-y-2
                        text-sm">


                <a
                    href="{{ route('public.terms') }}"
                    class="text-gray-600
                           hover:text-green-800
                           hover:underline"
                >
                    Syarat & Ketentuan
                </a>


                <a
                    href="{{ route('public.refund-policy') }}"
                    class="text-gray-600
                           hover:text-green-800
                           hover:underline"
                >
                    Kebijakan Refund
                </a>


                <a
                    href="{{ route('public.contact') }}"
                    class="text-gray-600
                           hover:text-green-800
                           hover:underline"
                >
                    Kontak Kami
                </a>

            </div>

        </div>



        <div class="mt-6
                    pt-5
                    border-t
                    border-gray-100
                    text-xs
                    text-gray-400">

            © {{ date('Y') }}
            PT ANOA Sejahtera Mandiri.
            Seluruh hak dilindungi.

        </div>

    </div>

</footer>