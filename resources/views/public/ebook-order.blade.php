<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Order E-Book | PT ANOA Sejahtera Mandiri
    </title>

    <script src="https://cdn.tailwindcss.com"></script>


    {{-- ========================================================= --}}
    {{-- MIDTRANS SNAP JS --}}
    {{-- ========================================================= --}}

    @if(config('services.midtrans.is_production'))

        {{-- PRODUCTION --}}
        <script
            src="https://app.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}">
        </script>

    @else

        {{-- SANDBOX --}}
        <script
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}">
        </script>

    @endif

</head>


<body class="bg-gray-50 min-h-screen">


{{-- ========================================================= --}}
{{-- HEADER --}}
{{-- ========================================================= --}}

<header class="bg-green-950">

    <div
        class="max-w-5xl mx-auto
               px-6 py-5
               flex items-center
               justify-between
               gap-4"
    >

        <a
            href="{{ url('/') }}"
            class="text-white
                   font-bold
                   text-xl"
        >
            PT ANOA Sejahtera Mandiri
        </a>


        <a
            href="{{ route('public.published-books') }}"
            class="text-green-100
                   hover:text-yellow-300
                   transition
                   whitespace-nowrap"
        >
            Kembali ke Buku
        </a>

    </div>

</header>



{{-- ========================================================= --}}
{{-- CONTENT --}}
{{-- ========================================================= --}}

<main class="max-w-3xl mx-auto px-6 py-12">


    {{-- ===================================================== --}}
    {{-- SUCCESS MESSAGE --}}
    {{-- ===================================================== --}}

    @if(session('success'))

        <div
            class="bg-green-50
                   border
                   border-green-200
                   text-green-800
                   rounded-2xl
                   p-4
                   mb-6"
        >
            {{ session('success') }}
        </div>

    @endif



    {{-- ===================================================== --}}
    {{-- ERROR MESSAGE --}}
    {{-- ===================================================== --}}

    @if($errors->any())

        <div
            class="bg-red-50
                   border
                   border-red-200
                   text-red-700
                   rounded-2xl
                   p-4
                   mb-6"
        >

            <ul class="list-disc ml-5 space-y-1">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif



    {{-- ===================================================== --}}
    {{-- ORDER CARD --}}
    {{-- ===================================================== --}}

    <div
        class="bg-white
               rounded-3xl
               border
               border-gray-100
               shadow-sm
               p-8"
    >


        {{-- LABEL --}}

        <p
            class="text-green-700
                   font-bold
                   uppercase
                   tracking-wide
                   text-sm"
        >
            Order E-Book
        </p>



        {{-- ================================================= --}}
        {{-- TITLE --}}
        {{-- ================================================= --}}

        <h1
            class="text-2xl
                   font-extrabold
                   text-green-950
                   mt-3
                   leading-snug"
        >
            {{ $order->publishedBook->title }}
        </h1>



        {{-- ================================================= --}}
        {{-- AUTHOR --}}
        {{-- ================================================= --}}

        @if($order->publishedBook->author_name)

            <p class="text-gray-500 mt-3 leading-relaxed">
                {{ $order->publishedBook->author_name }}
            </p>

        @endif



        {{-- ================================================= --}}
        {{-- ORDER INFORMATION --}}
        {{-- ================================================= --}}

        <div class="mt-7 space-y-4">


            {{-- ORDER NUMBER --}}

            <div
                class="flex
                       flex-col
                       sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-2
                       border-b
                       border-gray-100
                       pb-3"
            >

                <span class="text-gray-500">
                    Nomor Order
                </span>

                <span
                    class="font-bold
                           text-gray-800
                           text-right
                           break-all"
                >
                    {{ $order->order_number }}
                </span>

            </div>



            {{-- BUYER --}}

            <div
                class="flex
                       flex-col
                       sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-2
                       border-b
                       border-gray-100
                       pb-3"
            >

                <span class="text-gray-500">
                    Pembeli
                </span>

                <span
                    class="font-semibold
                           text-gray-800
                           text-right"
                >
                    {{ $order->buyer_name }}
                </span>

            </div>



            {{-- EMAIL --}}

            <div
                class="flex
                       flex-col
                       sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-2
                       border-b
                       border-gray-100
                       pb-3"
            >

                <span class="text-gray-500">
                    Email
                </span>

                <span
                    class="font-semibold
                           text-gray-800
                           text-right
                           break-all"
                >
                    {{ $order->buyer_email }}
                </span>

            </div>



            {{-- WHATSAPP --}}

            <div
                class="flex
                       flex-col
                       sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-2
                       border-b
                       border-gray-100
                       pb-3"
            >

                <span class="text-gray-500">
                    WhatsApp
                </span>

                <span
                    class="font-semibold
                           text-gray-800
                           text-right"
                >
                    {{ $order->buyer_phone }}
                </span>

            </div>



            {{-- TOTAL --}}

            <div
                class="flex
                       flex-col
                       sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-2
                       border-b
                       border-gray-100
                       pb-3"
            >

                <span class="text-gray-500">
                    Total
                </span>

                <span
                    class="font-extrabold
                           text-green-800
                           text-xl"
                >
                    Rp {{
                        number_format(
                            (float) $order->amount,
                            0,
                            ',',
                            '.'
                        )
                    }}
                </span>

            </div>



            {{-- ================================================= --}}
            {{-- PAYMENT STATUS --}}
            {{-- ================================================= --}}

            <div
                class="flex
                       flex-col
                       sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-2"
            >

                <span class="text-gray-500">
                    Status Pembayaran
                </span>


                {{-- PAID --}}

                @if($order->payment_status === 'paid')

                    <span
                        class="inline-flex
                               w-fit
                               bg-green-100
                               text-green-700
                               px-4
                               py-1.5
                               rounded-full
                               font-bold
                               text-sm"
                    >
                        ✓ Paid
                    </span>


                {{-- PENDING --}}

                @elseif($order->payment_status === 'pending')

                    <span
                        class="inline-flex
                               w-fit
                               bg-yellow-100
                               text-yellow-700
                               px-4
                               py-1.5
                               rounded-full
                               font-bold
                               text-sm"
                    >
                        Pending
                    </span>


                {{-- EXPIRED --}}

                @elseif($order->payment_status === 'expired')

                    <span
                        class="inline-flex
                               w-fit
                               bg-gray-100
                               text-gray-700
                               px-4
                               py-1.5
                               rounded-full
                               font-bold
                               text-sm"
                    >
                        Expired
                    </span>


                {{-- FAILED / CANCELLED --}}

                @elseif(
                    $order->payment_status === 'failed'
                    || $order->payment_status === 'cancelled'
                )

                    <span
                        class="inline-flex
                               w-fit
                               bg-red-100
                               text-red-700
                               px-4
                               py-1.5
                               rounded-full
                               font-bold
                               text-sm"
                    >
                        {{ ucfirst($order->payment_status) }}
                    </span>


                {{-- REFUNDED --}}

                @elseif($order->payment_status === 'refunded')

                    <span
                        class="inline-flex
                               w-fit
                               bg-purple-100
                               text-purple-700
                               px-4
                               py-1.5
                               rounded-full
                               font-bold
                               text-sm"
                    >
                        Refunded
                    </span>


                {{-- OTHER --}}

                @else

                    <span
                        class="inline-flex
                               w-fit
                               bg-gray-100
                               text-gray-600
                               px-4
                               py-1.5
                               rounded-full
                               font-bold
                               text-sm"
                    >
                        {{ ucfirst($order->payment_status) }}
                    </span>

                @endif

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- PENDING + PAYMENT BUTTON --}}
        {{-- ===================================================== --}}

        @if(
            $order->payment_status === 'pending'
            && $order->snap_token
        )

            <div
                class="mt-8
                       pt-6
                       border-t
                       border-gray-100"
            >


                <div
                    class="bg-blue-50
                           border
                           border-blue-100
                           text-blue-700
                           rounded-2xl
                           p-4
                           mb-4"
                >

                    Silakan klik tombol di bawah untuk memilih
                    metode pembayaran melalui Midtrans.

                </div>



                <button
                    type="button"
                    id="pay-button"
                    class="w-full
                           bg-green-800
                           hover:bg-green-900
                           disabled:bg-gray-400
                           text-white
                           font-bold
                           px-6
                           py-4
                           rounded-2xl
                           shadow-sm
                           transition"
                >
                    💳 Bayar Sekarang
                </button>


                <p
                    class="text-xs
                           text-gray-400
                           text-center
                           mt-3"
                >
                    Pembayaran diproses melalui Midtrans.
                </p>

            </div>



        {{-- ===================================================== --}}
        {{-- PAID + DOWNLOAD E-BOOK --}}
        {{-- ===================================================== --}}

        @elseif($order->payment_status === 'paid')

            <div
                class="mt-8
                       bg-green-50
                       border
                       border-green-200
                       text-green-700
                       rounded-2xl
                       p-5"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="w-10
                               h-10
                               flex
                               items-center
                               justify-center
                               bg-green-100
                               rounded-full
                               text-xl
                               flex-shrink-0"
                    >
                        ✓
                    </div>


                    <div>

                        <p class="font-bold text-lg">
                            Pembayaran berhasil
                        </p>

                        <p class="text-sm mt-1 leading-relaxed">
                            Pembayaran Anda telah berhasil diverifikasi.
                            E-book sekarang sudah dapat diunduh.
                        </p>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- DOWNLOAD BUTTON --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route(
                        'ebook.order.download',
                        ['token' => $order->public_token]
                    ) }}"
                    class="mt-5
                           flex
                           items-center
                           justify-center
                           gap-2
                           w-full
                           bg-green-800
                           hover:bg-green-900
                           text-white
                           font-bold
                           px-6
                           py-4
                           rounded-2xl
                           shadow-sm
                           transition"
                >
                    <span>
                        ⬇
                    </span>

                    <span>
                        Download E-Book
                    </span>
                </a>



                <div
                    class="mt-4
                           pt-4
                           border-t
                           border-green-200"
                >

                    <p
                        class="text-xs
                               text-green-700
                               leading-relaxed"
                    >
                        Simpan halaman order ini jika Anda ingin
                        mengunduh kembali e-book di kemudian hari.
                    </p>

                </div>

            </div>



        {{-- ===================================================== --}}
        {{-- SNAP TOKEN NOT AVAILABLE --}}
        {{-- ===================================================== --}}

        @elseif(
            $order->payment_status === 'pending'
            && !$order->snap_token
        )

            <div
                class="mt-8
                       bg-red-50
                       border
                       border-red-200
                       text-red-700
                       rounded-2xl
                       p-5"
            >

                <p class="font-bold">
                    Token pembayaran belum tersedia.
                </p>

                <p class="text-sm mt-1">
                    Silakan coba muat ulang halaman atau buat
                    order baru.
                </p>

            </div>



        {{-- ===================================================== --}}
        {{-- EXPIRED --}}
        {{-- ===================================================== --}}

        @elseif($order->payment_status === 'expired')

            <div
                class="mt-8
                       bg-gray-50
                       border
                       border-gray-200
                       text-gray-700
                       rounded-2xl
                       p-5"
            >

                <p class="font-bold">
                    Pembayaran telah kedaluwarsa.
                </p>

                <p class="text-sm mt-1">
                    Silakan kembali ke halaman buku dan buat
                    transaksi baru.
                </p>

                <a
                    href="{{ route('public.published-books') }}"
                    class="mt-4
                           flex
                           items-center
                           justify-center
                           w-full
                           bg-gray-800
                           hover:bg-gray-900
                           text-white
                           font-bold
                           px-6
                           py-3
                           rounded-xl
                           transition"
                >
                    Kembali ke Buku
                </a>

            </div>



        {{-- ===================================================== --}}
        {{-- FAILED / CANCELLED --}}
        {{-- ===================================================== --}}

        @elseif(
            $order->payment_status === 'failed'
            || $order->payment_status === 'cancelled'
        )

            <div
                class="mt-8
                       bg-red-50
                       border
                       border-red-200
                       text-red-700
                       rounded-2xl
                       p-5"
            >

                <p class="font-bold">
                    Pembayaran tidak berhasil.
                </p>

                <p class="text-sm mt-1">
                    Silakan kembali ke halaman buku dan buat
                    transaksi baru.
                </p>

            </div>



        {{-- ===================================================== --}}
        {{-- REFUNDED --}}
        {{-- ===================================================== --}}

        @elseif($order->payment_status === 'refunded')

            <div
                class="mt-8
                       bg-purple-50
                       border
                       border-purple-200
                       text-purple-700
                       rounded-2xl
                       p-5"
            >

                <p class="font-bold">
                    Transaksi telah direfund.
                </p>

                <p class="text-sm mt-1">
                    Akses download e-book tidak tersedia untuk
                    transaksi yang telah direfund.
                </p>

            </div>

        @endif


    </div>



    {{-- ===================================================== --}}
    {{-- SECURITY INFO --}}
    {{-- ===================================================== --}}

    <div
        class="mt-6
               text-center
               text-xs
               text-gray-400
               leading-relaxed"
    >

        Halaman order ini memiliki tautan akses khusus.
        Jangan membagikan tautan ini kepada orang lain.

    </div>


</main>



{{-- ========================================================= --}}
{{-- MIDTRANS JAVASCRIPT --}}
{{-- ========================================================= --}}

@if(
    $order->payment_status === 'pending'
    && $order->snap_token
)

<script>

    /*
    |--------------------------------------------------------------------------
    | PAY BUTTON
    |--------------------------------------------------------------------------
    */

    const payButton =
        document.getElementById('pay-button');


    if (payButton) {

        payButton.addEventListener(
            'click',
            function () {

                /*
                |--------------------------------------------------------------------------
                | DISABLE BUTTON
                |--------------------------------------------------------------------------
                */

                payButton.disabled = true;

                payButton.innerHTML =
                    'Membuka Pembayaran...';


                /*
                |--------------------------------------------------------------------------
                | OPEN MIDTRANS SNAP
                |--------------------------------------------------------------------------
                */

                window.snap.pay(
                    @json($order->snap_token),
                    {


                        /*
                        |--------------------------------------------------------------------------
                        | SUCCESS
                        |--------------------------------------------------------------------------
                        */

                        onSuccess: function(result) {

                            console.log(
                                'Payment Success',
                                result
                            );

                            alert(
                                'Pembayaran berhasil diproses.'
                            );

                            window.location.reload();

                        },


                        /*
                        |--------------------------------------------------------------------------
                        | PENDING
                        |--------------------------------------------------------------------------
                        */

                        onPending: function(result) {

                            console.log(
                                'Payment Pending',
                                result
                            );

                            alert(
                                'Pembayaran masih menunggu penyelesaian.'
                            );

                            window.location.reload();

                        },


                        /*
                        |--------------------------------------------------------------------------
                        | ERROR
                        |--------------------------------------------------------------------------
                        */

                        onError: function(result) {

                            console.error(
                                'Payment Error',
                                result
                            );

                            alert(
                                'Pembayaran gagal. Silakan coba kembali.'
                            );

                            payButton.disabled = false;

                            payButton.innerHTML =
                                '💳 Bayar Sekarang';

                        },


                        /*
                        |--------------------------------------------------------------------------
                        | CLOSE
                        |--------------------------------------------------------------------------
                        */

                        onClose: function() {

                            console.log(
                                'Payment popup closed'
                            );

                            payButton.disabled = false;

                            payButton.innerHTML =
                                '💳 Bayar Sekarang';

                        }

                    }
                );

            }
        );

    }

</script>

@endif


</body>
</html>