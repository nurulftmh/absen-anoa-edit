<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\PublishedBook;
use Illuminate\Http\Request;


class PublicBookController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Buku
    |--------------------------------------------------------------------------
    */
    public function books(Request $request)
    {
        $search = trim((string) $request->search);

        $books = Book::query()
            ->select([
                'id',
                'entry_date',
                'author_name',
                'title',
                'status',
            ])
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('author_name', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');

                });

            })
            ->orderByDesc('entry_date')
            ->paginate(12)
            ->withQueryString();

        return view('public.books', compact(
            'books',
            'search'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Buku Terbit
    |--------------------------------------------------------------------------
    */
    public function publishedBooks(Request $request)
    {
        $search = trim((string) $request->search);

        $publishedBooks = PublishedBook::query()
            ->select([
                'id',
                'published_date',
                'author_name',
                'title',
                'isbn',
                'publisher',
                'cover_path',
            ])
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('author_name', 'like', '%' . $search . '%')
                        ->orWhere('isbn', 'like', '%' . $search . '%')
                        ->orWhere('publisher', 'like', '%' . $search . '%');

                });

            })
            ->orderByDesc('published_date')
            ->paginate(12)
            ->withQueryString();

        return view('public.published-books', compact(
            'publishedBooks',
            'search'
        ));
    }
}