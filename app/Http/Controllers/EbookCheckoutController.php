<?php

namespace App\Http\Controllers;

use App\Models\EbookOrder;
use App\Models\PublishedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Throwable;

class EbookCheckoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | KONFIGURASI MIDTRANS SNAP
    |--------------------------------------------------------------------------
    */
    private function configureMidtrans(): void
    {
        Config::$serverKey = (string) config(
            'services.midtrans.server_key'
        );

        Config::$isProduction = (bool) config(
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
    public function show(PublishedBook $publishedBook)
    {
        abort_unless(
            $publishedBook->is_for_sale
            && $publishedBook->price !== null
            && !empty($publishedBook->ebook_path),
            404
        );

        return view(
            'public.ebook-checkout',
            compact('publishedBook')
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
            && !empty($publishedBook->ebook_path),
            404
        );

        $validated = $request->validate([
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
        | BUAT ORDER LOKAL
        |--------------------------------------------------------------------------
        */
        $order = EbookOrder::create([
            'order_number' =>
                'EBOOK-' .
                now()->format('YmdHis') .
                '-' .
                strtoupper(Str::random(5)),

            /*
            | Token public untuk membuka halaman order.
            | Jangan gunakan ID database pada URL publik.
            */
            'public_token' =>
                Str::random(64),

            'published_book_id' =>
                $publishedBook->id,

            'buyer_name' =>
                $validated['buyer_name'],

            'buyer_email' =>
                $validated['buyer_email'],

            'buyer_phone' =>
                $validated['buyer_phone'],

            /*
            | Harga wajib berasal dari database.
            */
            'amount' =>
                $publishedBook->price,

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
                $this->createSnapToken($order);

            $order->update([
                'snap_token' => $snapToken,
            ]);
        } catch (Throwable $e) {
            /*
            | Jangan tinggalkan order gagal sebagai pending.
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
        | REDIRECT KE URL ORDER YANG AMAN
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route(
                'ebook.order.show',
                [
                    'token' =>
                        $order->public_token,
                ]
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
    public function order(string $token)
    {
        $order = EbookOrder::where(
            'public_token',
            $token
        )
            ->with('publishedBook')
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | ORDER LAMA YANG BELUM PUNYA SNAP TOKEN
        |--------------------------------------------------------------------------
        */
        if (
            $order->payment_status === 'pending'
            && empty($order->snap_token)
        ) {
            try {
                $snapToken =
                    $this->createSnapToken($order);

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
            compact('order')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD E-BOOK
    |--------------------------------------------------------------------------
    |
    | File hanya boleh diberikan jika order sudah PAID.
    | File tetap berada di storage private.
    |
    */
    public function download(string $token)
    {
        $order = EbookOrder::where(
            'public_token',
            $token
        )
            ->with('publishedBook')
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | WAJIB SUDAH DIBAYAR
        |--------------------------------------------------------------------------
        */
        abort_unless(
            $order->payment_status === 'paid',
            403,
            'Pembayaran belum terverifikasi.'
        );

        $book = $order->publishedBook;

        /*
        |--------------------------------------------------------------------------
        | PASTIKAN BUKU ADA
        |--------------------------------------------------------------------------
        */
        abort_unless(
            $book,
            404,
            'Data buku tidak ditemukan.'
        );

        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PATH E-BOOK ADA
        |--------------------------------------------------------------------------
        */
        abort_if(
            empty($book->ebook_path),
            404,
            'File e-book tidak tersedia.'
        );

        /*
        |--------------------------------------------------------------------------
        | STORAGE PRIVATE
        |--------------------------------------------------------------------------
        */
        $disk = Storage::disk('local');

        /*
        |--------------------------------------------------------------------------
        | PASTIKAN FILE BENAR-BENAR ADA
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
        | NAMA FILE DOWNLOAD
        |--------------------------------------------------------------------------
        */
        $fileName =
            (
                Str::slug($book->title)
                ?: 'ebook-' . $book->id
            )
            . '.pdf';

        /*
        |--------------------------------------------------------------------------
        | DOWNLOAD
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
        $this->configureMidtrans();

        $order->loadMissing(
            'publishedBook'
        );

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
            | PRODUK
            |--------------------------------------------------------------------------
            */
            'item_details' => [
                [
                    'id' =>
                        (string) $order->published_book_id,

                    'price' =>
                        (int) $order->amount,

                    'quantity' =>
                        1,

                    'name' =>
                        Str::limit(
                            $order->publishedBook->title,
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

        return Snap::getSnapToken(
            $params
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI SIGNATURE WEBHOOK
    |--------------------------------------------------------------------------
    |
    | Mencoba:
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
        $signatureSecret =
            (string) config(
                'services.midtrans.signature_secret'
            );

        $serverKey =
            (string) config(
                'services.midtrans.server_key'
            );

        /*
        |--------------------------------------------------------------------------
        | DAFTAR KEY YANG BOLEH DIPAKAI
        |--------------------------------------------------------------------------
        */
        $keys = array_unique(
            array_filter([
                $signatureSecret,
                $serverKey,
            ])
        );

        foreach ($keys as $key) {
            $expectedSignature = hash(
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
            !$this->isValidWebhookSignature(
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
        $order = EbookOrder::where(
            'order_number',
            $orderId
        )->first();

        if (!$order) {
            return response()->json([
                'message' =>
                    'Order not found.',
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | VERIFIKASI NOMINAL
        |--------------------------------------------------------------------------
        */
        $localAmount = number_format(
            (float) $order->amount,
            2,
            '.',
            ''
        );

        $midtransAmount = number_format(
            (float) $grossAmount,
            2,
            '.',
            ''
        );

        if (
            $localAmount
            !== $midtransAmount
        ) {
            return response()->json([
                'message' =>
                    'Invalid transaction amount.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | DATA STATUS MIDTRANS
        |--------------------------------------------------------------------------
        */
        $transactionStatus =
            strtolower(
                (string) $request->input(
                    'transaction_status'
                )
            );

        $fraudStatus =
            strtolower(
                (string) $request->input(
                    'fraud_status',
                    ''
                )
            );

        $transactionId =
            $request->input(
                'transaction_id'
            );

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
            $transactionStatus
                === 'settlement'
            && $statusCode === '200'
            && (
                empty($fraudStatus)
                || $fraudStatus === 'accept'
            )
        ) {
            $updates['payment_status'] =
                'paid';

            /*
            | Jangan ubah paid_at apabila
            | webhook dikirim ulang.
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
            $transactionStatus
                === 'capture'
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
            $transactionStatus
                === 'pending'
        ) {
            /*
            | Order PAID tidak boleh turun
            | lagi menjadi PENDING.
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
            $transactionStatus
                === 'expire'
        ) {
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
            $transactionStatus
                === 'cancel'
        ) {
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
            || $transactionStatus
                === 'failure'
        ) {
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
            $transactionStatus
                === 'refund'
            || $transactionStatus
                === 'partial_refund'
        ) {
            $updates['payment_status'] =
                'refunded';
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------------------
        */
        $order->update(
            $updates
        );

        /*
        |--------------------------------------------------------------------------
        | RESPONSE 200
        |--------------------------------------------------------------------------
        */
        return response()->json([
            'message' =>
                'Notification processed.',
        ], 200);
    }
}