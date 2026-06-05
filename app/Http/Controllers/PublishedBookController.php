<?php

namespace App\Http\Controllers;

use App\Models\PublishedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublishedBookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;

        $publishedBooks = PublishedBook::with('user')
            ->where('user_id', auth()->id())
            ->when($search, fn ($query) => $this->applySearch($query, $search))
            ->when($dateFrom && $dateTo, function ($query) use ($dateFrom, $dateTo) {
                $query->whereBetween('published_date', [$dateFrom, $dateTo]);
            })
            ->when($dateFrom && ! $dateTo, function ($query) use ($dateFrom) {
                $query->whereDate('published_date', '>=', $dateFrom);
            })
            ->when(! $dateFrom && $dateTo, function ($query) use ($dateTo) {
                $query->whereDate('published_date', '<=', $dateTo);
            })
            ->latest('published_date')
            ->paginate(10)
            ->withQueryString();

        return view('published-books.index', compact('publishedBooks', 'search', 'dateFrom', 'dateTo'));
    }

    public function adminIndex(Request $request)
    {
        $search = $request->search;
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;

        $publishedBooks = PublishedBook::with('user')
            ->when($search, fn ($query) => $this->applySearch($query, $search, true))
            ->when($dateFrom && $dateTo, function ($query) use ($dateFrom, $dateTo) {
                $query->whereBetween('published_date', [$dateFrom, $dateTo]);
            })
            ->when($dateFrom && ! $dateTo, function ($query) use ($dateFrom) {
                $query->whereDate('published_date', '>=', $dateFrom);
            })
            ->when(! $dateFrom && $dateTo, function ($query) use ($dateTo) {
                $query->whereDate('published_date', '<=', $dateTo);
            })
            ->latest('published_date')
            ->paginate(10)
            ->withQueryString();

        return view('admin.published-books.index', compact('publishedBooks', 'search', 'dateFrom', 'dateTo'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        PublishedBook::create([
            ...$data,
            'user_id' => auth()->id(),
            'cover_path' => $this->storeFile($request, 'cover', 'published-books/covers'),
            'book_pdf_path' => $this->storeFile($request, 'book_pdf', 'published-books/pdfs'),
            'certificate_archive_path' => $this->storeFile($request, 'certificate_archive', 'published-books/certificates'),
        ]);

        return back()->with('success', 'Data buku terbit berhasil ditambahkan.');
    }

    public function update(Request $request, PublishedBook $publishedBook)
    {
        $this->authorizeOwner($publishedBook);

        $data = $this->validatedData($request, false);

        foreach ([
            'cover' => ['cover_path', 'published-books/covers'],
            'book_pdf' => ['book_pdf_path', 'published-books/pdfs'],
            'certificate_archive' => ['certificate_archive_path', 'published-books/certificates'],
        ] as $input => [$column, $directory]) {
            if ($request->hasFile($input)) {
                if ($publishedBook->{$column}) {
                    Storage::disk('public')->delete($publishedBook->{$column});
                }

                $data[$column] = $this->storeFile($request, $input, $directory);
            }
        }

        $publishedBook->update($data);

        return back()->with('success', 'Data buku terbit berhasil diperbarui.');
    }

    public function destroy(PublishedBook $publishedBook)
    {
        $this->authorizeOwner($publishedBook);

        foreach (['cover_path', 'book_pdf_path', 'certificate_archive_path'] as $column) {
            if ($publishedBook->{$column}) {
                Storage::disk('public')->delete($publishedBook->{$column});
            }
        }

        $publishedBook->delete();

        return back()->with('success', 'Data buku terbit berhasil dihapus.');
    }

    private function validatedData(Request $request, bool $requirePdf = true): array
    {
        $data = $request->validate([
            'published_date' => 'required|date',
            'author_name' => 'required|string|max:255',
            'title' => 'required|string',
            'isbn' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'book_pdf' => ($requirePdf ? 'required' : 'nullable') . '|file|mimes:pdf|max:20480',
            'certificate_archive' => 'nullable|file|mimes:rar,zip|max:20480',
            'note' => 'nullable|string',
        ]);

        unset($data['cover'], $data['book_pdf'], $data['certificate_archive']);

        return $data;
    }

    private function storeFile(Request $request, string $input, string $directory): ?string
    {
        if (! $request->hasFile($input)) {
            return null;
        }

        return $request->file($input)->store($directory, 'public');
    }

    private function applySearch($query, string $search, bool $includeUser = false)
    {
        return $query->where(function ($q) use ($search, $includeUser) {
            $q->where('author_name', 'like', '%' . $search . '%')
                ->orWhere('title', 'like', '%' . $search . '%')
                ->orWhere('isbn', 'like', '%' . $search . '%')
                ->orWhere('publisher', 'like', '%' . $search . '%')
                ->orWhere('note', 'like', '%' . $search . '%');

            if ($includeUser) {
                $q->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            }
        });
    }

    private function authorizeOwner(PublishedBook $publishedBook): void
    {
        if (auth()->user()->role === 'admin' || $publishedBook->user_id === auth()->id()) {
            return;
        }

        abort(403);
    }
}