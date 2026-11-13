<?php

namespace App\Http\Controllers;

use App\Models\EbookOrder;
use Illuminate\Http\Request;

class AdminEbookOrderController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN ONLY
        |--------------------------------------------------------------------------
        */
        abort_unless(
            auth()->check()
            && auth()->user()->role === 'admin',
            403
        );


        /*
        |--------------------------------------------------------------------------
        | FILTER
        |--------------------------------------------------------------------------
        */
        $search = trim(
            (string) $request->search
        );

        $status = trim(
            (string) $request->status
        );

        $paymentType = trim(
            (string) $request->payment_type
        );


        /*
        |--------------------------------------------------------------------------
        | DATA ORDER
        |--------------------------------------------------------------------------
        */
        $orders = EbookOrder::query()

            ->with('publishedBook')

            /*
            |--------------------------------------------------------------------------
            | SEARCH
            |--------------------------------------------------------------------------
            */
            ->when(
                $search,
                function ($query) use ($search) {

                    $query->where(
                        function ($q) use ($search) {

                            $q->where(
                                'order_number',
                                'like',
                                '%' . $search . '%'
                            )

                            ->orWhere(
                                'buyer_name',
                                'like',
                                '%' . $search . '%'
                            )

                            ->orWhere(
                                'buyer_email',
                                'like',
                                '%' . $search . '%'
                            )

                            ->orWhere(
                                'buyer_phone',
                                'like',
                                '%' . $search . '%'
                            )

                            ->orWhereHas(
                                'publishedBook',
                                function ($bookQuery) use ($search) {

                                    $bookQuery->where(
                                        'title',
                                        'like',
                                        '%' . $search . '%'
                                    );
                                }
                            );
                        }
                    );
                }
            )


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */
            ->when(
                $status,
                function ($query) use ($status) {

                    $query->where(
                        'payment_status',
                        $status
                    );
                }
            )


            /*
            |--------------------------------------------------------------------------
            | PAYMENT TYPE
            |--------------------------------------------------------------------------
            */
            ->when(
                $paymentType,
                function ($query) use ($paymentType) {

                    $query->where(
                        'payment_type',
                        $paymentType
                    );
                }
            )


            /*
            |--------------------------------------------------------------------------
            | TERBARU
            |--------------------------------------------------------------------------
            */
            ->latest('id')

            ->paginate(20)

            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | RINGKASAN
        |--------------------------------------------------------------------------
        */
        $summary = [

            'total' =>
                EbookOrder::count(),

            'paid' =>
                EbookOrder::where(
                    'payment_status',
                    'paid'
                )->count(),

            'pending' =>
                EbookOrder::where(
                    'payment_status',
                    'pending'
                )->count(),

            'expired' =>
                EbookOrder::where(
                    'payment_status',
                    'expired'
                )->count(),

            'revenue' =>
                EbookOrder::where(
                    'payment_status',
                    'paid'
                )->sum('amount'),

            'downloads' =>
                EbookOrder::sum(
                    'download_count'
                ),
        ];


        return view(
            'admin.ebook-orders.index',
            compact(
                'orders',
                'summary',
                'search',
                'status',
                'paymentType'
            )
        );
    }
}