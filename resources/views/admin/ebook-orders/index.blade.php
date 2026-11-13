<x-app-layout>

    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 py-8">

        <div class="px-6 max-w-7xl mx-auto">


            {{-- ====================================================== --}}
            {{-- HERO --}}
            {{-- ====================================================== --}}
            <div class="relative overflow-hidden
                        bg-green-950
                        rounded-[2rem]
                        p-8 md:p-10
                        mb-8
                        shadow-xl
                        shadow-green-950/15">

                <div class="absolute inset-0
                            bg-gradient-to-r
                            from-green-950
                            via-green-900
                            to-emerald-800">
                </div>

                <div class="absolute
                            -right-20
                            -top-20
                            w-72
                            h-72
                            bg-white/10
                            rounded-full
                            blur-2xl">
                </div>

                <div class="absolute
                            -left-20
                            -bottom-20
                            w-72
                            h-72
                            bg-emerald-300/10
                            rounded-full
                            blur-2xl">
                </div>


                <div class="relative
                            flex
                            flex-col
                            lg:flex-row
                            lg:items-center
                            lg:justify-between
                            gap-6">

                    <div>

                        <div class="inline-flex
                                    items-center
                                    gap-2
                                    bg-white/15
                                    text-green-50
                                    px-4
                                    py-1.5
                                    rounded-full
                                    text-sm
                                    font-semibold
                                    mb-4">

                            💳 Modul Penjualan

                        </div>


                        <h1 class="text-3xl
                                   md:text-5xl
                                   font-extrabold
                                   text-white
                                   tracking-tight">

                            Penjualan E-Book

                        </h1>


                        <p class="text-green-100
                                  mt-3
                                  max-w-2xl
                                  leading-relaxed">

                            Pantau transaksi, pembayaran Midtrans,
                            status pesanan, serta aktivitas download
                            e-book PT Anoa Sejahtera Mandiri.

                        </p>

                    </div>


                    <div class="flex
                                items-center
                                gap-4
                                bg-white/10
                                backdrop-blur
                                rounded-3xl
                                p-4
                                border
                                border-white/10">

                        <div class="w-16
                                    h-16
                                    bg-white
                                    rounded-2xl
                                    flex
                                    items-center
                                    justify-center
                                    text-3xl
                                    shadow">

                            📚

                        </div>

                        <div>

                            <p class="text-green-100 text-sm">
                                Sistem Pembayaran
                            </p>

                            <h2 class="text-white font-bold leading-tight">
                                Midtrans E-Book
                            </h2>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ====================================================== --}}
            {{-- SUMMARY --}}
            {{-- ====================================================== --}}
            <div class="mb-8">

                <div class="mb-5">

                    <h2 class="text-xl font-bold text-gray-900">
                        Ringkasan Penjualan
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Statistik transaksi e-book saat ini.
                    </p>

                </div>


                <div class="grid
                            grid-cols-1
                            sm:grid-cols-2
                            lg:grid-cols-3
                            xl:grid-cols-6
                            gap-4">


                    {{-- TOTAL ORDER --}}
                    <div class="relative
                                overflow-hidden
                                bg-white
                                rounded-3xl
                                p-5
                                border
                                border-slate-100
                                shadow-sm">

                        <div class="absolute
                                    -right-8
                                    -top-8
                                    w-24
                                    h-24
                                    bg-slate-50
                                    rounded-full">
                        </div>

                        <div class="relative">

                            <div class="w-11 h-11
                                        rounded-2xl
                                        bg-slate-100
                                        text-slate-700
                                        flex
                                        items-center
                                        justify-center
                                        text-xl
                                        mb-4">
                                🧾
                            </div>

                            <p class="text-xs
                                      font-bold
                                      uppercase
                                      tracking-wide
                                      text-gray-400">
                                Total Order
                            </p>

                            <p class="text-3xl
                                      font-extrabold
                                      text-gray-900
                                      mt-2">

                                {{ number_format($summary['total']) }}

                            </p>

                        </div>

                    </div>



                    {{-- PAID --}}
                    <div class="relative
                                overflow-hidden
                                bg-white
                                rounded-3xl
                                p-5
                                border
                                border-green-100
                                shadow-sm">

                        <div class="absolute
                                    -right-8
                                    -top-8
                                    w-24
                                    h-24
                                    bg-green-50
                                    rounded-full">
                        </div>

                        <div class="relative">

                            <div class="w-11 h-11
                                        rounded-2xl
                                        bg-green-100
                                        text-green-700
                                        flex
                                        items-center
                                        justify-center
                                        text-xl
                                        mb-4">
                                ✓
                            </div>

                            <p class="text-xs
                                      font-bold
                                      uppercase
                                      tracking-wide
                                      text-gray-400">
                                Paid
                            </p>

                            <p class="text-3xl
                                      font-extrabold
                                      text-green-700
                                      mt-2">

                                {{ number_format($summary['paid']) }}

                            </p>

                        </div>

                    </div>



                    {{-- PENDING --}}
                    <div class="relative
                                overflow-hidden
                                bg-white
                                rounded-3xl
                                p-5
                                border
                                border-yellow-100
                                shadow-sm">

                        <div class="absolute
                                    -right-8
                                    -top-8
                                    w-24
                                    h-24
                                    bg-yellow-50
                                    rounded-full">
                        </div>

                        <div class="relative">

                            <div class="w-11 h-11
                                        rounded-2xl
                                        bg-yellow-100
                                        text-yellow-700
                                        flex
                                        items-center
                                        justify-center
                                        text-xl
                                        mb-4">
                                ⏳
                            </div>

                            <p class="text-xs
                                      font-bold
                                      uppercase
                                      tracking-wide
                                      text-gray-400">
                                Pending
                            </p>

                            <p class="text-3xl
                                      font-extrabold
                                      text-yellow-600
                                      mt-2">

                                {{ number_format($summary['pending']) }}

                            </p>

                        </div>

                    </div>



                    {{-- EXPIRED --}}
                    <div class="relative
                                overflow-hidden
                                bg-white
                                rounded-3xl
                                p-5
                                border
                                border-gray-100
                                shadow-sm">

                        <div class="absolute
                                    -right-8
                                    -top-8
                                    w-24
                                    h-24
                                    bg-gray-50
                                    rounded-full">
                        </div>

                        <div class="relative">

                            <div class="w-11 h-11
                                        rounded-2xl
                                        bg-gray-100
                                        text-gray-600
                                        flex
                                        items-center
                                        justify-center
                                        text-xl
                                        mb-4">
                                ⏱
                            </div>

                            <p class="text-xs
                                      font-bold
                                      uppercase
                                      tracking-wide
                                      text-gray-400">
                                Expired
                            </p>

                            <p class="text-3xl
                                      font-extrabold
                                      text-gray-600
                                      mt-2">

                                {{ number_format($summary['expired']) }}

                            </p>

                        </div>

                    </div>



                    {{-- DOWNLOAD --}}
                    <div class="relative
                                overflow-hidden
                                bg-white
                                rounded-3xl
                                p-5
                                border
                                border-blue-100
                                shadow-sm">

                        <div class="absolute
                                    -right-8
                                    -top-8
                                    w-24
                                    h-24
                                    bg-blue-50
                                    rounded-full">
                        </div>

                        <div class="relative">

                            <div class="w-11 h-11
                                        rounded-2xl
                                        bg-blue-100
                                        text-blue-700
                                        flex
                                        items-center
                                        justify-center
                                        text-xl
                                        mb-4">
                                ↓
                            </div>

                            <p class="text-xs
                                      font-bold
                                      uppercase
                                      tracking-wide
                                      text-gray-400">
                                Download
                            </p>

                            <p class="text-3xl
                                      font-extrabold
                                      text-blue-700
                                      mt-2">

                                {{ number_format($summary['downloads']) }}

                            </p>

                        </div>

                    </div>



                    {{-- REVENUE --}}
                    <div class="relative
                                overflow-hidden
                                bg-gradient-to-br
                                from-green-950
                                to-emerald-800
                                rounded-3xl
                                p-5
                                shadow-lg">

                        <div class="absolute
                                    -right-8
                                    -top-8
                                    w-24
                                    h-24
                                    bg-white/10
                                    rounded-full">
                        </div>

                        <div class="relative">

                            <div class="w-11 h-11
                                        rounded-2xl
                                        bg-white/15
                                        text-white
                                        flex
                                        items-center
                                        justify-center
                                        text-xl
                                        mb-4">
                                Rp
                            </div>

                            <p class="text-xs
                                      font-bold
                                      uppercase
                                      tracking-wide
                                      text-green-100">
                                Pendapatan
                            </p>

                            <p class="text-xl
                                      font-extrabold
                                      text-white
                                      mt-2">

                                Rp {{
                                    number_format(
                                        (float) $summary['revenue'],
                                        0,
                                        ',',
                                        '.'
                                    )
                                }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ====================================================== --}}
            {{-- FILTER --}}
            {{-- ====================================================== --}}
            <div class="bg-white
                        rounded-[2rem]
                        border
                        border-green-100
                        shadow-sm
                        p-6
                        mb-6">

                <div class="flex
                            flex-col
                            md:flex-row
                            md:items-center
                            md:justify-between
                            gap-3
                            mb-5">

                    <div>

                        <h2 class="text-lg font-bold text-gray-900">
                            Filter Transaksi
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Cari transaksi berdasarkan order, pembeli,
                            buku, status, atau metode pembayaran.
                        </p>

                    </div>

                </div>


                <form
                    method="GET"
                    action="{{ route('admin.ebook-orders.index') }}"
                >

                    <div class="grid
                                grid-cols-1
                                md:grid-cols-2
                                xl:grid-cols-4
                                gap-4">


                        {{-- SEARCH --}}
                        <div class="xl:col-span-2">

                            <label class="block
                                          text-xs
                                          font-bold
                                          text-gray-500
                                          uppercase
                                          tracking-wide
                                          mb-2">

                                Pencarian

                            </label>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Nomor order, nama, email, WA, judul buku..."
                                class="w-full
                                       rounded-2xl
                                       border-gray-200
                                       bg-gray-50
                                       px-4
                                       py-3
                                       focus:bg-white
                                       focus:border-green-700
                                       focus:ring-green-700"
                            >

                        </div>



                        {{-- STATUS --}}
                        <div>

                            <label class="block
                                          text-xs
                                          font-bold
                                          text-gray-500
                                          uppercase
                                          tracking-wide
                                          mb-2">

                                Status

                            </label>

                            <select
                                name="status"
                                class="w-full
                                       rounded-2xl
                                       border-gray-200
                                       bg-gray-50
                                       px-4
                                       py-3
                                       focus:bg-white
                                       focus:border-green-700
                                       focus:ring-green-700"
                            >

                                <option value="">
                                    Semua Status
                                </option>

                                @foreach([
                                    'pending',
                                    'paid',
                                    'expired',
                                    'cancelled',
                                    'failed',
                                    'refunded'
                                ] as $item)

                                    <option
                                        value="{{ $item }}"
                                        {{
                                            request('status') === $item
                                                ? 'selected'
                                                : ''
                                        }}
                                    >
                                        {{ ucfirst($item) }}
                                    </option>

                                @endforeach

                            </select>

                        </div>



                        {{-- PAYMENT TYPE --}}
                        <div>

                            <label class="block
                                          text-xs
                                          font-bold
                                          text-gray-500
                                          uppercase
                                          tracking-wide
                                          mb-2">

                                Metode Pembayaran

                            </label>

                            <input
                                type="text"
                                name="payment_type"
                                value="{{ request('payment_type') }}"
                                placeholder="Contoh: qris"
                                class="w-full
                                       rounded-2xl
                                       border-gray-200
                                       bg-gray-50
                                       px-4
                                       py-3
                                       focus:bg-white
                                       focus:border-green-700
                                       focus:ring-green-700"
                            >

                        </div>

                    </div>


                    <div class="flex
                                flex-col
                                sm:flex-row
                                justify-end
                                gap-3
                                mt-5">

                        <a
                            href="{{ route('admin.ebook-orders.index') }}"
                            class="inline-flex
                                   items-center
                                   justify-center
                                   bg-gray-100
                                   hover:bg-gray-200
                                   text-gray-700
                                   px-6
                                   py-3
                                   rounded-2xl
                                   font-semibold
                                   transition"
                        >
                            Reset
                        </a>


                        <button
                            type="submit"
                            class="inline-flex
                                   items-center
                                   justify-center
                                   gap-2
                                   bg-green-800
                                   hover:bg-green-900
                                   text-white
                                   px-6
                                   py-3
                                   rounded-2xl
                                   font-semibold
                                   shadow-sm
                                   transition">

                            🔎 Filter

                        </button>

                    </div>

                </form>

            </div>



            {{-- ====================================================== --}}
            {{-- TABLE --}}
            {{-- ====================================================== --}}
            <div class="bg-white
                        rounded-[2rem]
                        border
                        border-green-100
                        shadow-sm
                        overflow-hidden">

                <div class="px-6
                            py-5
                            border-b
                            border-gray-100
                            flex
                            items-center
                            justify-between">

                    <div>

                        <h2 class="text-lg font-bold text-gray-900">
                            Daftar Transaksi
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $orders->total() }} transaksi ditemukan
                        </p>

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-green-950 text-white">

                            <tr>

                                <th class="px-5 py-4 text-left">
                                    Order
                                </th>

                                <th class="px-5 py-4 text-left">
                                    Pembeli
                                </th>

                                <th class="px-5 py-4 text-left">
                                    Buku
                                </th>

                                <th class="px-5 py-4 text-left">
                                    Harga
                                </th>

                                <th class="px-5 py-4 text-left">
                                    Status
                                </th>

                                <th class="px-5 py-4 text-left">
                                    Pembayaran
                                </th>

                                <th class="px-5 py-4 text-left">
                                    Download
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse($orders as $order)

                                @php

                                    $statusClass = match(
                                        $order->payment_status
                                    ) {
                                        'paid' =>
                                            'bg-green-100 text-green-700',

                                        'pending' =>
                                            'bg-yellow-100 text-yellow-700',

                                        'expired' =>
                                            'bg-gray-100 text-gray-600',

                                        'cancelled' =>
                                            'bg-red-100 text-red-700',

                                        'failed' =>
                                            'bg-red-100 text-red-700',

                                        'refunded' =>
                                            'bg-purple-100 text-purple-700',

                                        default =>
                                            'bg-gray-100 text-gray-600',
                                    };

                                @endphp


                                <tr class="hover:bg-green-50/40 transition">


                                    {{-- ORDER --}}
                                    <td class="px-5 py-5 align-top min-w-[190px]">

                                        <p class="font-bold
                                                  text-gray-900
                                                  break-all">

                                            {{ $order->order_number }}

                                        </p>

                                        <p class="text-xs
                                                  text-gray-400
                                                  mt-2">

                                            Dibuat:

                                            {{
                                                $order->created_at
                                                    ? $order->created_at->format(
                                                        'd-m-Y H:i'
                                                    )
                                                    : '-'
                                            }}

                                        </p>

                                    </td>



                                    {{-- PEMBELI --}}
                                    <td class="px-5 py-5 align-top min-w-[210px]">

                                        <p class="font-bold text-gray-800">
                                            {{ $order->buyer_name }}
                                        </p>

                                        <p class="text-xs
                                                  text-gray-500
                                                  mt-2
                                                  break-all">

                                            {{ $order->buyer_email }}

                                        </p>

                                        <p class="text-xs
                                                  text-gray-500
                                                  mt-1">

                                            📱 {{ $order->buyer_phone }}

                                        </p>

                                    </td>



                                    {{-- BUKU --}}
                                    <td class="px-5 py-5 align-top min-w-[260px]">

                                        <p class="font-semibold
                                                  text-gray-800
                                                  leading-relaxed">

                                            {{
                                                $order->publishedBook?->title
                                                    ?? 'Buku tidak ditemukan'
                                            }}

                                        </p>

                                    </td>



                                    {{-- HARGA --}}
                                    <td class="px-5
                                               py-5
                                               align-top
                                               whitespace-nowrap">

                                        <p class="font-extrabold
                                                  text-green-800">

                                            Rp {{
                                                number_format(
                                                    (float) $order->amount,
                                                    0,
                                                    ',',
                                                    '.'
                                                )
                                            }}

                                        </p>

                                    </td>



                                    {{-- STATUS --}}
                                    <td class="px-5 py-5 align-top">

                                        <span class="inline-flex
                                                     items-center
                                                     px-3
                                                     py-1.5
                                                     rounded-full
                                                     text-xs
                                                     font-bold
                                                     {{ $statusClass }}">

                                            {{ ucfirst($order->payment_status) }}

                                        </span>

                                    </td>



                                    {{-- PEMBAYARAN --}}
                                    <td class="px-5 py-5 align-top min-w-[180px]">

                                        @if($order->payment_type)

                                            <span class="inline-flex
                                                         bg-blue-50
                                                         text-blue-700
                                                         px-3
                                                         py-1
                                                         rounded-lg
                                                         text-xs
                                                         font-bold">

                                                {{
                                                    strtoupper(
                                                        $order->payment_type
                                                    )
                                                }}

                                            </span>

                                        @else

                                            <span class="text-gray-400">
                                                -
                                            </span>

                                        @endif


                                        @if($order->paid_at)

                                            <p class="text-xs
                                                      text-gray-500
                                                      mt-3">

                                                Paid:
                                                {{
                                                    $order
                                                        ->paid_at
                                                        ->format(
                                                            'd-m-Y H:i'
                                                        )
                                                }}

                                            </p>

                                        @else

                                            <p class="text-xs
                                                      text-gray-400
                                                      mt-3">

                                                Belum dibayar

                                            </p>

                                        @endif

                                    </td>



                                    {{-- DOWNLOAD --}}
                                    <td class="px-5 py-5 align-top min-w-[170px]">

                                        <div class="flex
                                                    items-center
                                                    gap-2">

                                            <div class="w-9 h-9
                                                        rounded-xl
                                                        bg-blue-50
                                                        text-blue-700
                                                        flex
                                                        items-center
                                                        justify-center">

                                                ↓

                                            </div>

                                            <div>

                                                <p class="font-bold text-gray-800">

                                                    {{
                                                        number_format(
                                                            $order->download_count
                                                            ?? 0
                                                        )
                                                    }}

                                                    kali

                                                </p>

                                            </div>

                                        </div>


                                        @if($order->last_downloaded_at)

                                            <p class="text-xs
                                                      text-gray-500
                                                      mt-2">

                                                Terakhir:
                                                {{
                                                    $order
                                                        ->last_downloaded_at
                                                        ->format(
                                                            'd-m-Y H:i'
                                                        )
                                                }}

                                            </p>

                                        @else

                                            <p class="text-xs
                                                      text-gray-400
                                                      mt-2">

                                                Belum pernah download

                                            </p>

                                        @endif

                                    </td>



                                    {{-- ACTION --}}
                                    <td class="px-5 py-5 align-top text-center">

                                        @if($order->public_token)

                                            <a
                                                href="{{ route(
                                                    'ebook.order.show',
                                                    [
                                                        'token' =>
                                                            $order->public_token
                                                    ]
                                                ) }}"
                                                target="_blank"
                                                class="inline-flex
                                                       items-center
                                                       justify-center
                                                       w-9
                                                       h-9
                                                       rounded-xl
                                                       bg-green-100
                                                       text-green-800
                                                       hover:bg-green-800
                                                       hover:text-white
                                                       transition"
                                                title="Lihat Order">

                                                ↗

                                            </a>

                                        @else

                                            <span class="text-gray-300">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="px-6
                                               py-16
                                               text-center">

                                        <div class="w-16
                                                    h-16
                                                    rounded-full
                                                    bg-gray-100
                                                    flex
                                                    items-center
                                                    justify-center
                                                    text-2xl
                                                    mx-auto">

                                            🧾

                                        </div>

                                        <h3 class="font-bold
                                                   text-gray-800
                                                   mt-4">

                                            Belum ada transaksi

                                        </h3>

                                        <p class="text-gray-500
                                                  text-sm
                                                  mt-1">

                                            Transaksi e-book akan muncul
                                            di halaman ini.

                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}
                <div class="p-6
                            border-t
                            border-gray-100">

                    {{ $orders->links() }}

                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- FOOTER INFO --}}
            {{-- ====================================================== --}}
            <div class="mt-8
                        bg-white
                        border
                        border-green-100
                        rounded-[2rem]
                        p-6
                        shadow-sm">

                <div class="flex
                            flex-col
                            md:flex-row
                            md:items-center
                            md:justify-between
                            gap-4">

                    <div>

                        <p class="font-bold text-green-950">
                            Sistem Penjualan E-Book
                        </p>

                        <p class="text-sm
                                  text-gray-500
                                  mt-1">

                            Pembayaran diverifikasi melalui Midtrans.
                            File e-book hanya dapat diunduh oleh
                            transaksi dengan status Paid.

                        </p>

                    </div>

                    <a
                        href="{{ route('dashboard') }}"
                        class="inline-flex
                               items-center
                               justify-center
                               px-5
                               py-3
                               bg-green-950
                               hover:bg-green-900
                               text-white
                               rounded-2xl
                               font-semibold
                               transition">

                        ← Dashboard Admin

                    </a>

                </div>

            </div>


        </div>

    </div>

</x-app-layout>