<?php

namespace App\Http\Controllers;

use App\Models\EbookOrder;
use App\Models\PublishedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Throwable;

class EbookCheckoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AUTORISASI BROWSER PEMBELI
    |--------------------------------------------------------------------------
    |
    | Setiap order memiliki access token rahasia.
    | Token asli hanya disimpan pada cookie browser pembeli.
    | Database hanya menyimpan SHA-256 hash.
    |
    | Jika link dibuka menggunakan browser/perangkat lain,
    | cookie tidak tersedia sehingga akses ditolak.
    |
    */
    private function authorizeOrderBrowser(EbookOrder $order): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN TETAP BOLEH MEMBUKA ORDER
        |--------------------------------------------------------------------------
        */
        if (
            auth()->check()
            && auth()->user()->role === 'admin'
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | NAMA COOKIE KHUSUS ORDER
        |--------------------------------------------------------------------------
        */
        $cookieName =
            'ebook_access_' . $order->id;


        /*
        |--------------------------------------------------------------------------
        | AMBIL TOKEN DARI COOKIE BROWSER
        |--------------------------------------------------------------------------
        */
        $browserToken =
            request()->cookie(
                $cookieName
            );


        /*
        |--------------------------------------------------------------------------
        | COOKIE / HASH TIDAK ADA
        |--------------------------------------------------------------------------
        */
        if (
            empty($browserToken)
            || empty($order->access_token_hash)
        ) {
            abort(
                403,
                'Tautan pembelian ini hanya dapat diakses dari browser yang melakukan pembelian.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | HASH TOKEN DARI BROWSER
        |--------------------------------------------------------------------------
        */
        $browserTokenHash =
            hash(
                'sha256',
                $browserToken
            );


        /*
        |--------------------------------------------------------------------------
        | COCOKKAN DENGAN HASH DI DATABASE
        |--------------------------------------------------------------------------
        */
        if (
            ! hash_equals(
                $order->access_token_hash,
                $browserTokenHash
            )
        ) {
            abort(
                403,
                'Tautan pembelian ini tidak dapat digunakan pada browser atau perangkat lain.'
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | KONFIGURASI MIDTRANS SNAP
    |--------------------------------------------------------------------------
    */
    private function configureMidtrans(): void
    {
        Config::$serverKey =
            (string) config(
                'services.midtrans.server_key'
            );

        Config::$isProduction =
            (bool) config(
                'services.midtrans.is_production',
                false
            );

        Config::$isSanitized = true;

        Config::$is3ds = true;
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN CHECKOUT
    |--------------------------------------------------------------------------
    */
    public function show(
        PublishedBook $publishedBook
    ) {
        abort_unless(
            $publishedBook->is_for_sale
            && $publishedBook->price !== null
            && ! empty($publishedBook->ebook_path),
            404
        );

        return view(
            'public.ebook-checkout',
            compact(
                'publishedBook'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | BUAT ORDER
    |--------------------------------------------------------------------------
    */
    public function store(
        Request $request,
        PublishedBook $publishedBook
    ) {
        abort_unless(
            $publishedBook->is_for_sale
            && $publishedBook->price !== null
            && ! empty($publishedBook->ebook_path),
            404
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI PEMBELI
        |--------------------------------------------------------------------------
        */
        $validated =
            $request->validate([
                'buyer_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'buyer_email' => [
                    'required',
                    'email',
                    'max:255',
                ],

                'buyer_phone' => [
                    'required',
                    'string',
                    'max:30',
                ],
            ]);


        /*
        |--------------------------------------------------------------------------
        | TOKEN AKSES KHUSUS BROWSER
        |--------------------------------------------------------------------------
        |
        | Token asli tidak disimpan di database.
        | Database hanya menyimpan SHA-256 hash.
        |
        */
        $browserAccessToken =
            Str::random(64);


        /*
        |--------------------------------------------------------------------------
        | BUAT ORDER LOKAL
        |--------------------------------------------------------------------------
        */
        $order =
            EbookOrder::create([

                /*
                |--------------------------------------------------------------------------
                | NOMOR ORDER
                |--------------------------------------------------------------------------
                */
                'order_number' =>
                    'EBOOK-' .
                    now()->format('YmdHis') .
                    '-' .
                    strtoupper(
                        Str::random(5)
                    ),


                /*
                |--------------------------------------------------------------------------
                | TOKEN PUBLIC UNTUK URL
                |--------------------------------------------------------------------------
                */
                'public_token' =>
                    Str::random(64),


                /*
                |--------------------------------------------------------------------------
                | TOKEN AKSES BROWSER
                |--------------------------------------------------------------------------
                */
                'access_token_hash' =>
                    hash(
                        'sha256',
                        $browserAccessToken
                    ),


                /*
                |--------------------------------------------------------------------------
                | BUKU
                |--------------------------------------------------------------------------
                */
                'published_book_id' =>
                    $publishedBook->id,


                /*
                |--------------------------------------------------------------------------
                | PEMBELI
                |--------------------------------------------------------------------------
                */
                'buyer_name' =>
                    $validated['buyer_name'],

                'buyer_email' =>
                    $validated['buyer_email'],

                'buyer_phone' =>
                    $validated['buyer_phone'],


                /*
                |--------------------------------------------------------------------------
                | HARGA DARI DATABASE
                |--------------------------------------------------------------------------
                |
                | Tidak menggunakan harga dari request pembeli.
                |
                */
                'amount' =>
                    $publishedBook->price,


                /*
                |--------------------------------------------------------------------------
                | STATUS AWAL
                |--------------------------------------------------------------------------
                */
                'payment_status' =>
                    'pending',
            ]);


        /*
        |--------------------------------------------------------------------------
        | BUAT SNAP TOKEN MIDTRANS
        |--------------------------------------------------------------------------
        */
        try {
            $snapToken =
                $this->createSnapToken(
                    $order
                );

            $order->update([
                'snap_token' =>
                    $snapToken,
            ]);
        } catch (Throwable $e) {
            /*
            |--------------------------------------------------------------------------
            | HAPUS ORDER JIKA MIDTRANS GAGAL
            |--------------------------------------------------------------------------
            */
            $order->delete();

            report($e);

            return back()
                ->withInput()
                ->withErrors([
                    'payment' =>
                        'Gagal membuat transaksi pembayaran. Silakan coba kembali.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | COOKIE AKSES
        |--------------------------------------------------------------------------
        |
        | Production:
        | - Secure = true
        |
        | Local:
        | - Secure = false supaya dapat dites dengan HTTP.
        |
        */
        $secureCookie =
            app()->environment(
                'production'
            );


        $cookieName =
            'ebook_access_' . $order->id;


        /*
        |--------------------------------------------------------------------------
        | REDIRECT KE ORDER + SIMPAN COOKIE
        |--------------------------------------------------------------------------
        |
        | Cookie disimpan selama 1 tahun.
        |
        | HttpOnly:
        | JavaScript tidak dapat membaca token.
        |
        | SameSite Lax:
        | Mengurangi risiko cross-site request.
        |
        */
        return redirect()
            ->route(
                'ebook.order.show',
                [
                    'token' =>
                        $order->public_token,
                ]
            )
            ->withCookie(
                cookie(
                    $cookieName,
                    $browserAccessToken,

                    /*
                     * 60 menit × 24 jam × 365 hari
                     */
                    60 * 24 * 365,

                    '/',
                    null,

                    /*
                     * Secure
                     */
                    $secureCookie,

                    /*
                     * HttpOnly
                     */
                    true,

                    /*
                     * Raw
                     */
                    false,

                    /*
                     * SameSite
                     */
                    'Lax'
                )
            )
            ->with(
                'success',
                'Order berhasil dibuat. Silakan lanjutkan pembayaran.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL ORDER
    |--------------------------------------------------------------------------
    */
    public function order(
        string $token
    ) {
        $order =
            EbookOrder::where(
                'public_token',
                $token
            )
            ->with(
                'publishedBook'
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | CEK BROWSER PEMBELI
        |--------------------------------------------------------------------------
        */
        $this->authorizeOrderBrowser(
            $order
        );


        /*
        |--------------------------------------------------------------------------
        | ORDER PENDING YANG BELUM PUNYA SNAP TOKEN
        |--------------------------------------------------------------------------
        */
        if (
            $order->payment_status === 'pending'
            && empty($order->snap_token)
        ) {
            try {
                $snapToken =
                    $this->createSnapToken(
                        $order
                    );

                $order->update([
                    'snap_token' =>
                        $snapToken,
                ]);
            } catch (Throwable $e) {
                report($e);
            }
        }


        return view(
            'public.ebook-order',
            compact(
                'order'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD E-BOOK
    |--------------------------------------------------------------------------
    |
    | Syarat:
    |
    | - token URL valid
    | - browser mempunyai cookie akses
    | - transaksi sudah PAID
    | - data buku tersedia
    | - ebook_path tersedia
    | - file benar-benar ada
    |
    */
    public function download(
        string $token
    ) {
        $order =
            EbookOrder::where(
                'public_token',
                $token
            )
            ->with(
                'publishedBook'
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | CEK BROWSER PEMBELI
        |--------------------------------------------------------------------------
        |
        | Dijalankan sebelum memberikan file.
        |
        */
        $this->authorizeOrderBrowser(
            $order
        );


        /*
        |--------------------------------------------------------------------------
        | HANYA ORDER PAID
        |--------------------------------------------------------------------------
        */
        abort_unless(
            $order->payment_status === 'paid',
            403,
            'Pembayaran belum terverifikasi.'
        );


        $book =
            $order->publishedBook;


        /*
        |--------------------------------------------------------------------------
        | CEK DATA BUKU
        |--------------------------------------------------------------------------
        */
        abort_unless(
            $book,
            404,
            'Data buku tidak ditemukan.'
        );


        /*
        |--------------------------------------------------------------------------
        | CEK PATH E-BOOK
        |--------------------------------------------------------------------------
        */
        abort_if(
            empty($book->ebook_path),
            404,
            'File e-book tidak tersedia.'
        );


        $disk =
            Storage::disk(
                'local'
            );


        /*
        |--------------------------------------------------------------------------
        | CEK FILE FISIK
        |--------------------------------------------------------------------------
        */
        abort_unless(
            $disk->exists(
                $book->ebook_path
            ),
            404,
            'File e-book tidak ditemukan.'
        );


        /*
        |--------------------------------------------------------------------------
        | TRACK DOWNLOAD
        |--------------------------------------------------------------------------
        |
        | Browser dapat membuat beberapa request untuk satu download.
        |
        | Request dalam rentang 30 detik hanya dihitung satu kali.
        |
        */
        $now =
            now();


        $cutoff =
            $now
                ->copy()
                ->subSeconds(30);


        EbookOrder::whereKey(
            $order->id
        )
            ->where(
                function ($query) use ($cutoff) {
                    $query
                        ->whereNull(
                            'last_downloaded_at'
                        )
                        ->orWhere(
                            'last_downloaded_at',
                            '<=',
                            $cutoff
                        );
                }
            )
            ->update([
                'download_count' =>
                    DB::raw(
                        'download_count + 1'
                    ),

                'last_downloaded_at' =>
                    $now,
            ]);


        /*
        |--------------------------------------------------------------------------
        | NAMA FILE DOWNLOAD
        |--------------------------------------------------------------------------
        */
        $fileName =
            (
                Str::slug(
                    $book->title
                )
                ?: 'ebook-' . $book->id
            )
            . '.pdf';


        /*
        |--------------------------------------------------------------------------
        | DOWNLOAD PRIVATE
        |--------------------------------------------------------------------------
        */
        return $disk->download(
            $book->ebook_path,
            $fileName,
            [
                'Content-Type' =>
                    'application/pdf',

                'Cache-Control' =>
                    'private, no-store, max-age=0',

                'Pragma' =>
                    'no-cache',

                'Expires' =>
                    '0',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE SNAP TOKEN
    |--------------------------------------------------------------------------
    */
    private function createSnapToken(
        EbookOrder $order
    ): string {
        /*
        |--------------------------------------------------------------------------
        | KONFIGURASI MIDTRANS
        |--------------------------------------------------------------------------
        */
        $this->configureMidtrans();


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN RELASI BUKU TERLOAD
        |--------------------------------------------------------------------------
        */
        $order->loadMissing(
            'publishedBook'
        );


        /*
        |--------------------------------------------------------------------------
        | PARAMETER MIDTRANS
        |--------------------------------------------------------------------------
        */
        $params = [

            /*
            |--------------------------------------------------------------------------
            | TRANSAKSI
            |--------------------------------------------------------------------------
            */
            'transaction_details' => [

                'order_id' =>
                    $order->order_number,

                'gross_amount' =>
                    (int) $order->amount,
            ],


            /*
            |--------------------------------------------------------------------------
            | DETAIL PRODUK
            |--------------------------------------------------------------------------
            */
            'item_details' => [
                [
                    'id' =>
                        (string)
                        $order->published_book_id,

                    'price' =>
                        (int)
                        $order->amount,

                    'quantity' =>
                        1,

                    'name' =>
                        Str::limit(
                            $order
                                ->publishedBook
                                ->title,
                            45,
                            ''
                        ),
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | PEMBELI
            |--------------------------------------------------------------------------
            */
            'customer_details' => [

                'first_name' =>
                    $order->buyer_name,

                'email' =>
                    $order->buyer_email,

                'phone' =>
                    $order->buyer_phone,
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | SNAP TOKEN
        |--------------------------------------------------------------------------
        */
        return Snap::getSnapToken(
            $params
        );
    }


    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI SIGNATURE WEBHOOK
    |--------------------------------------------------------------------------
    |
    | Sistem mencoba:
    |
    | 1. Signature Secret Key
    | 2. Server Key sebagai fallback
    |
    */
    private function isValidWebhookSignature(
        string $orderId,
        string $statusCode,
        string $grossAmount,
        string $receivedSignature
    ): bool {
        /*
        |--------------------------------------------------------------------------
        | SIGNATURE SECRET
        |--------------------------------------------------------------------------
        */
        $signatureSecret =
            (string) config(
                'services.midtrans.signature_secret'
            );


        /*
        |--------------------------------------------------------------------------
        | SERVER KEY
        |--------------------------------------------------------------------------
        */
        $serverKey =
            (string) config(
                'services.midtrans.server_key'
            );


        /*
        |--------------------------------------------------------------------------
        | DAFTAR KEY
        |--------------------------------------------------------------------------
        */
        $keys =
            array_unique(
                array_filter([
                    $signatureSecret,
                    $serverKey,
                ])
            );


        /*
        |--------------------------------------------------------------------------
        | COBA VERIFIKASI
        |--------------------------------------------------------------------------
        */
        foreach ($keys as $key) {
            $expectedSignature =
                hash(
                    'sha512',
                    $orderId .
                    $statusCode .
                    $grossAmount .
                    $key
                );

            if (
                hash_equals(
                    $expectedSignature,
                    $receivedSignature
                )
            ) {
                return true;
            }
        }


        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | WEBHOOK MIDTRANS
    |--------------------------------------------------------------------------
    */
    public function webhook(
        Request $request
    ) {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA NOTIFIKASI
        |--------------------------------------------------------------------------
        */
        $orderId =
            (string) $request->input(
                'order_id'
            );


        $statusCode =
            (string) $request->input(
                'status_code'
            );


        $grossAmount =
            (string) $request->input(
                'gross_amount'
            );


        $signatureKey =
            (string) $request->input(
                'signature_key'
            );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI PAYLOAD
        |--------------------------------------------------------------------------
        */
        if (
            empty($orderId)
            || empty($statusCode)
            || empty($grossAmount)
            || empty($signatureKey)
        ) {
            return response()->json([
                'message' =>
                    'Invalid notification payload.',
            ], 400);
        }


        /*
        |--------------------------------------------------------------------------
        | VERIFIKASI SIGNATURE
        |--------------------------------------------------------------------------
        */
        if (
            ! $this->isValidWebhookSignature(
                $orderId,
                $statusCode,
                $grossAmount,
                $signatureKey
            )
        ) {
            return response()->json([
                'message' =>
                    'Invalid signature.',
            ], 403);
        }


        /*
        |--------------------------------------------------------------------------
        | CARI ORDER
        |--------------------------------------------------------------------------
        */
        $order =
            EbookOrder::where(
                'order_number',
                $orderId
            )
            ->first();


        if (! $order) {
            return response()->json([
                'message' =>
                    'Order not found.',
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | VERIFIKASI NOMINAL TRANSAKSI
        |--------------------------------------------------------------------------
        */
        $localAmount =
            number_format(
                (float) $order->amount,
                2,
                '.',
                ''
            );


        $midtransAmount =
            number_format(
                (float) $grossAmount,
                2,
                '.',
                ''
            );


        if (
            $localAmount
            !==
            $midtransAmount
        ) {
            return response()->json([
                'message' =>
                    'Invalid transaction amount.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS MIDTRANS
        |--------------------------------------------------------------------------
        */
        $transactionStatus =
            strtolower(
                (string) $request->input(
                    'transaction_status'
                )
            );


        /*
        |--------------------------------------------------------------------------
        | FRAUD STATUS
        |--------------------------------------------------------------------------
        */
        $fraudStatus =
            strtolower(
                (string) $request->input(
                    'fraud_status',
                    ''
                )
            );


        /*
        |--------------------------------------------------------------------------
        | TRANSACTION ID
        |--------------------------------------------------------------------------
        */
        $transactionId =
            $request->input(
                'transaction_id'
            );


        /*
        |--------------------------------------------------------------------------
        | PAYMENT TYPE
        |--------------------------------------------------------------------------
        */
        $paymentType =
            $request->input(
                'payment_type'
            );


        /*
        |--------------------------------------------------------------------------
        | DATA UPDATE DASAR
        |--------------------------------------------------------------------------
        */
        $updates = [

            'midtrans_transaction_id' =>
                $transactionId,

            'payment_type' =>
                $paymentType,
        ];


        /*
        |--------------------------------------------------------------------------
        | SETTLEMENT = PAID
        |--------------------------------------------------------------------------
        */
        if (
            $transactionStatus === 'settlement'
            && $statusCode === '200'
            && (
                empty($fraudStatus)
                || $fraudStatus === 'accept'
            )
        ) {
            $updates['payment_status'] =
                'paid';

            /*
            |--------------------------------------------------------------------------
            | JANGAN TIMPA paid_at SAAT WEBHOOK DIKIRIM ULANG
            |--------------------------------------------------------------------------
            */
            $updates['paid_at'] =
                $order->paid_at
                ?? now();
        }


        /*
        |--------------------------------------------------------------------------
        | CAPTURE = PAID
        |--------------------------------------------------------------------------
        */
        elseif (
            $transactionStatus === 'capture'
            && $statusCode === '200'
            && (
                empty($fraudStatus)
                || $fraudStatus === 'accept'
            )
        ) {
            $updates['payment_status'] =
                'paid';

            $updates['paid_at'] =
                $order->paid_at
                ?? now();
        }


        /*
        |--------------------------------------------------------------------------
        | PENDING
        |--------------------------------------------------------------------------
        */
        elseif (
            $transactionStatus === 'pending'
        ) {
            /*
            |--------------------------------------------------------------------------
            | PAID TIDAK BOLEH TURUN JADI PENDING
            |--------------------------------------------------------------------------
            */
            if (
                $order->payment_status
                !== 'paid'
            ) {
                $updates['payment_status'] =
                    'pending';
            }
        }


        /*
        |--------------------------------------------------------------------------
        | EXPIRED
        |--------------------------------------------------------------------------
        */
        elseif (
            $transactionStatus === 'expire'
        ) {
            /*
            |--------------------------------------------------------------------------
            | PAID TIDAK BOLEH TURUN JADI EXPIRED
            |--------------------------------------------------------------------------
            */
            if (
                $order->payment_status
                !== 'paid'
            ) {
                $updates['payment_status'] =
                    'expired';
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CANCELLED
        |--------------------------------------------------------------------------
        */
        elseif (
            $transactionStatus === 'cancel'
        ) {
            /*
            |--------------------------------------------------------------------------
            | PAID TIDAK BOLEH TURUN JADI CANCELLED
            |--------------------------------------------------------------------------
            */
            if (
                $order->payment_status
                !== 'paid'
            ) {
                $updates['payment_status'] =
                    'cancelled';
            }
        }


        /*
        |--------------------------------------------------------------------------
        | FAILED
        |--------------------------------------------------------------------------
        */
        elseif (
            $transactionStatus === 'deny'
            ||
            $transactionStatus === 'failure'
        ) {
            /*
            |--------------------------------------------------------------------------
            | PAID TIDAK BOLEH TURUN JADI FAILED
            |--------------------------------------------------------------------------
            */
            if (
                $order->payment_status
                !== 'paid'
            ) {
                $updates['payment_status'] =
                    'failed';
            }
        }


        /*
        |--------------------------------------------------------------------------
        | REFUND
        |--------------------------------------------------------------------------
        */
        elseif (
            $transactionStatus === 'refund'
            ||
            $transactionStatus === 'partial_refund'
        ) {
            $updates['payment_status'] =
                'refunded';
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE ORDER
        |--------------------------------------------------------------------------
        */
        $order->update(
            $updates
        );


        /*
        |--------------------------------------------------------------------------
        | RESPONSE 200
        |--------------------------------------------------------------------------
        |
        | Midtrans membutuhkan HTTP 2xx supaya webhook dianggap diterima.
        |
        */
        return response()->json([
            'message' =>
                'Notification processed.',
        ], 200);
    }
}