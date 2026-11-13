<?php

namespace App\Http\Controllers;

use App\Models\PublishedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PublishedBookController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN BUKU TERBIT USER
    |--------------------------------------------------------------------------
    |
    | Hanya menampilkan buku terbit milik user yang sedang login.
    |
    */
    public function index(Request $request)
    {
        $search = $request->search;
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;

        $publishedBooks = PublishedBook::with('user')
            ->where('user_id', auth()->id())

            ->when(
                $search,
                fn ($query) =>
                    $this->applySearch(
                        $query,
                        $search
                    )
            )

            ->when(
                $dateFrom && $dateTo,
                function ($query) use ($dateFrom, $dateTo) {
                    $query->whereBetween(
                        'published_date',
                        [$dateFrom, $dateTo]
                    );
                }
            )

            ->when(
                $dateFrom && ! $dateTo,
                function ($query) use ($dateFrom) {
                    $query->whereDate(
                        'published_date',
                        '>=',
                        $dateFrom
                    );
                }
            )

            ->when(
                ! $dateFrom && $dateTo,
                function ($query) use ($dateTo) {
                    $query->whereDate(
                        'published_date',
                        '<=',
                        $dateTo
                    );
                }
            )

            ->latest('published_date')

            ->paginate(10)

            ->withQueryString();


        return view(
            'published-books.index',
            compact(
                'publishedBooks',
                'search',
                'dateFrom',
                'dateTo'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN ADMIN BUKU TERBIT
    |--------------------------------------------------------------------------
    |
    | Admin dapat melihat buku dari semua user.
    |
    */
    public function adminIndex(Request $request)
    {
        $search = $request->search;
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;

        $publishedBooks = PublishedBook::with('user')

            ->when(
                $search,
                fn ($query) =>
                    $this->applySearch(
                        $query,
                        $search,
                        true
                    )
            )

            ->when(
                $dateFrom && $dateTo,
                function ($query) use ($dateFrom, $dateTo) {
                    $query->whereBetween(
                        'published_date',
                        [$dateFrom, $dateTo]
                    );
                }
            )

            ->when(
                $dateFrom && ! $dateTo,
                function ($query) use ($dateFrom) {
                    $query->whereDate(
                        'published_date',
                        '>=',
                        $dateFrom
                    );
                }
            )

            ->when(
                ! $dateFrom && $dateTo,
                function ($query) use ($dateTo) {
                    $query->whereDate(
                        'published_date',
                        '<=',
                        $dateTo
                    );
                }
            )

            ->latest('published_date')

            ->paginate(10)

            ->withQueryString();


        return view(
            'admin.published-books.index',
            compact(
                'publishedBooks',
                'search',
                'dateFrom',
                'dateTo'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH BUKU TERBIT
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        |
        | PDF buku sekarang OPSIONAL.
        |
        */
        $data = $this->validatedData(
            request: $request,
            existingBook: null
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN COVER
        |--------------------------------------------------------------------------
        */
        $coverPath = $this->storePublicFile(
            $request,
            'cover',
            'published-books/covers'
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PDF BUKU
        |--------------------------------------------------------------------------
        |
        | OPSIONAL.
        | Jika tidak diupload maka nilainya NULL.
        |
        */
        $bookPdfPath = $this->storePublicFile(
            $request,
            'book_pdf',
            'published-books/pdfs'
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN SERTIFIKAT
        |--------------------------------------------------------------------------
        */
        $certificatePath = $this->storePublicFile(
            $request,
            'certificate_archive',
            'published-books/certificates'
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN E-BOOK PRIVATE
        |--------------------------------------------------------------------------
        |
        | File e-book berbayar disimpan di storage private.
        |
        */
        $ebookPath = $this->storePrivateFile(
            $request,
            'ebook_file',
            'ebooks'
        );


        /*
        |--------------------------------------------------------------------------
        | CREATE DATABASE
        |--------------------------------------------------------------------------
        */
        PublishedBook::create([

            ...$data,

            'user_id' =>
                auth()->id(),

            'cover_path' =>
                $coverPath,

            'book_pdf_path' =>
                $bookPdfPath,

            'certificate_archive_path' =>
                $certificatePath,

            'ebook_path' =>
                $ebookPath,

        ]);


        return back()->with(
            'success',
            'Data buku terbit berhasil ditambahkan.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE BUKU TERBIT
    |--------------------------------------------------------------------------
    */
    public function update(
        Request $request,
        PublishedBook $publishedBook
    ) {
        /*
        |--------------------------------------------------------------------------
        | CEK OWNER
        |--------------------------------------------------------------------------
        */
        $this->authorizeOwner(
            $publishedBook
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */
        $data = $this->validatedData(
            request: $request,
            existingBook: $publishedBook
        );


        /*
        |--------------------------------------------------------------------------
        | UPDATE FILE PUBLIC
        |--------------------------------------------------------------------------
        |
        | File lama tidak dihapus jika user tidak upload file baru.
        |
        */
        foreach ([

            'cover' => [
                'cover_path',
                'published-books/covers',
            ],

            'book_pdf' => [
                'book_pdf_path',
                'published-books/pdfs',
            ],

            'certificate_archive' => [
                'certificate_archive_path',
                'published-books/certificates',
            ],

        ] as $input => [$column, $directory]) {

            /*
            |--------------------------------------------------------------------------
            | JIKA ADA FILE BARU
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile($input)) {

                /*
                |--------------------------------------------------------------------------
                | HAPUS FILE LAMA
                |--------------------------------------------------------------------------
                */
                if ($publishedBook->{$column}) {

                    Storage::disk('public')
                        ->delete(
                            $publishedBook->{$column}
                        );
                }


                /*
                |--------------------------------------------------------------------------
                | SIMPAN FILE BARU
                |--------------------------------------------------------------------------
                */
                $data[$column] =
                    $this->storePublicFile(
                        $request,
                        $input,
                        $directory
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE FILE E-BOOK PRIVATE
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('ebook_file')) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS E-BOOK LAMA
            |--------------------------------------------------------------------------
            */
            if ($publishedBook->ebook_path) {

                Storage::disk('local')
                    ->delete(
                        $publishedBook->ebook_path
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | SIMPAN E-BOOK BARU
            |--------------------------------------------------------------------------
            */
            $data['ebook_path'] =
                $this->storePrivateFile(
                    $request,
                    'ebook_file',
                    'ebooks'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------------------
        */
        $publishedBook->update(
            $data
        );


        return back()->with(
            'success',
            'Data buku terbit berhasil diperbarui.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS BUKU TERBIT
    |--------------------------------------------------------------------------
    */
    public function destroy(
        PublishedBook $publishedBook
    ) {
        /*
        |--------------------------------------------------------------------------
        | CEK OWNER
        |--------------------------------------------------------------------------
        */
        $this->authorizeOwner(
            $publishedBook
        );


        /*
        |--------------------------------------------------------------------------
        | HAPUS FILE PUBLIC
        |--------------------------------------------------------------------------
        */
        foreach ([
            'cover_path',
            'book_pdf_path',
            'certificate_archive_path',
        ] as $column) {

            if ($publishedBook->{$column}) {

                Storage::disk('public')
                    ->delete(
                        $publishedBook->{$column}
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS FILE E-BOOK PRIVATE
        |--------------------------------------------------------------------------
        */
        if ($publishedBook->ebook_path) {

            Storage::disk('local')
                ->delete(
                    $publishedBook->ebook_path
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS DATABASE
        |--------------------------------------------------------------------------
        */
        $publishedBook->delete();


        return back()->with(
            'success',
            'Data buku terbit berhasil dihapus.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDASI DATA
    |--------------------------------------------------------------------------
    */
    private function validatedData(
        Request $request,
        ?PublishedBook $existingBook = null
    ): array {

        /*
        |--------------------------------------------------------------------------
        | APAKAH E-BOOK WAJIB?
        |--------------------------------------------------------------------------
        |
        | E-book hanya wajib jika:
        |
        | - buku dipilih "dijual sebagai e-book"
        | - dan belum ada file e-book sebelumnya
        |
        | PDF BUKU biasa tetap OPSIONAL.
        |
        */
        $ebookRequired =
            $request->boolean('is_for_sale')
            &&
            (
                $existingBook === null
                ||
                empty(
                    $existingBook->ebook_path
                )
            );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */
        $data = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | DATA BUKU
            |--------------------------------------------------------------------------
            */

            'published_date' => [
                'required',
                'date',
            ],


            'author_name' => [
                'required',
                'string',
            ],


            'title' => [
                'required',
                'string',
            ],


            'isbn' => [
                'nullable',
                'string',
                'max:255',
            ],


            'publisher' => [
                'nullable',
                'string',
                'max:255',
            ],


            /*
            |--------------------------------------------------------------------------
            | PENJUALAN E-BOOK
            |--------------------------------------------------------------------------
            */

            'is_for_sale' => [
                'required',
                'boolean',
            ],


            'price' => [

                Rule::requiredIf(
                    fn () =>
                        $request->boolean(
                            'is_for_sale'
                        )
                ),

                'nullable',
                'numeric',
                'min:0',

            ],


            /*
            |--------------------------------------------------------------------------
            | FILE E-BOOK PRIVATE
            |--------------------------------------------------------------------------
            |
            | Berbeda dengan "PDF Buku".
            |
            | File ini digunakan untuk pembeli setelah pembayaran.
            |
            */

            'ebook_file' => [

                Rule::requiredIf(
                    fn () =>
                        $ebookRequired
                ),

                'nullable',
                'file',
                'mimes:pdf',
                'max:51200',

            ],


            /*
            |--------------------------------------------------------------------------
            | COVER
            |--------------------------------------------------------------------------
            */

            'cover' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],


            /*
            |--------------------------------------------------------------------------
            | PDF BUKU / PDF ARSIP
            |--------------------------------------------------------------------------
            |
            | SEKARANG TIDAK WAJIB.
            |
            */

            'book_pdf' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:102400',
            ],


            /*
            |--------------------------------------------------------------------------
            | SERTIFIKAT
            |--------------------------------------------------------------------------
            */

            'certificate_archive' => [
                'nullable',
                'file',
                'mimes:rar,zip,pdf',
                'max:102400',
            ],


            /*
            |--------------------------------------------------------------------------
            | CATATAN
            |--------------------------------------------------------------------------
            */

            'note' => [
                'nullable',
                'string',
            ],

        ], [


            /*
            |--------------------------------------------------------------------------
            | PESAN VALIDASI PENJUALAN
            |--------------------------------------------------------------------------
            */

            'price.required' =>
                'Harga e-book wajib diisi jika buku dijual sebagai e-book.',

            'price.numeric' =>
                'Harga e-book harus berupa angka.',

            'price.min' =>
                'Harga e-book tidak boleh kurang dari 0.',


            /*
            |--------------------------------------------------------------------------
            | PESAN VALIDASI E-BOOK
            |--------------------------------------------------------------------------
            */

            'ebook_file.required' =>
                'File e-book wajib diunggah jika buku dijual sebagai e-book.',

            'ebook_file.mimes' =>
                'File e-book harus berupa PDF.',

            'ebook_file.max' =>
                'Ukuran file e-book maksimal 50 MB.',


            /*
            |--------------------------------------------------------------------------
            | COVER
            |--------------------------------------------------------------------------
            */

            'cover.max' =>
                'Ukuran cover maksimal 10 MB.',


            /*
            |--------------------------------------------------------------------------
            | PDF BUKU
            |--------------------------------------------------------------------------
            */

            'book_pdf.mimes' =>
                'File buku harus berupa PDF.',

            'book_pdf.max' =>
                'Ukuran PDF buku maksimal 100 MB.',


            /*
            |--------------------------------------------------------------------------
            | SERTIFIKAT
            |--------------------------------------------------------------------------
            */

            'certificate_archive.mimes' =>
                'File sertifikat harus berupa RAR, ZIP, atau PDF.',

            'certificate_archive.max' =>
                'Ukuran file sertifikat maksimal 100 MB.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI BOOLEAN
        |--------------------------------------------------------------------------
        */
        $data['is_for_sale'] =
            $request->boolean(
                'is_for_sale'
            );


        /*
        |--------------------------------------------------------------------------
        | JIKA TIDAK DIJUAL
        |--------------------------------------------------------------------------
        |
        | Harga dibuat NULL.
        |
        */
        if (! $data['is_for_sale']) {

            $data['price'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS INPUT FILE DARI DATA DATABASE
        |--------------------------------------------------------------------------
        |
        | Path file ditangani terpisah.
        |
        */
        unset(
            $data['cover'],
            $data['book_pdf'],
            $data['certificate_archive'],
            $data['ebook_file']
        );


        return $data;
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN FILE PUBLIC
    |--------------------------------------------------------------------------
    |
    | Untuk:
    |
    | - cover
    | - PDF arsip buku
    | - sertifikat
    |
    */
    private function storePublicFile(
        Request $request,
        string $input,
        string $directory
    ): ?string {

        /*
        |--------------------------------------------------------------------------
        | TIDAK ADA FILE
        |--------------------------------------------------------------------------
        */
        if (! $request->hasFile($input)) {

            return null;
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN FILE
        |--------------------------------------------------------------------------
        */
        return $request
            ->file($input)
            ->store(
                $directory,
                'public'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN FILE PRIVATE
    |--------------------------------------------------------------------------
    |
    | Khusus file e-book berbayar.
    |
    */
    private function storePrivateFile(
        Request $request,
        string $input,
        string $directory
    ): ?string {

        /*
        |--------------------------------------------------------------------------
        | TIDAK ADA FILE
        |--------------------------------------------------------------------------
        */
        if (! $request->hasFile($input)) {

            return null;
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN FILE PRIVATE
        |--------------------------------------------------------------------------
        */
        return $request
            ->file($input)
            ->store(
                $directory,
                'local'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */
    private function applySearch(
        $query,
        string $search,
        bool $includeUser = false
    ) {
        return $query->where(
            function ($q) use (
                $search,
                $includeUser
            ) {

                $q->where(
                    'author_name',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'title',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'isbn',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'publisher',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'note',
                    'like',
                    '%' . $search . '%'
                );


                /*
                |--------------------------------------------------------------------------
                | ADMIN BISA SEARCH USER
                |--------------------------------------------------------------------------
                */
                if ($includeUser) {

                    $q->orWhereHas(
                        'user',
                        function (
                            $userQuery
                        ) use ($search) {

                            $userQuery
                                ->where(
                                    'name',
                                    'like',
                                    '%' . $search . '%'
                                )

                                ->orWhere(
                                    'email',
                                    'like',
                                    '%' . $search . '%'
                                );
                        }
                    );
                }
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | AUTHORIZE OWNER
    |--------------------------------------------------------------------------
    |
    | Admin bebas mengelola semua.
    | User hanya boleh mengelola buku miliknya.
    |
    */
    private function authorizeOwner(
        PublishedBook $publishedBook
    ): void {

        if (
            auth()->user()->role === 'admin'
            ||
            $publishedBook->user_id
                === auth()->id()
        ) {

            return;
        }


        abort(403);
    }
}