<?php

namespace App\Http\Controllers;

use App\Models\Manuscript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ManuscriptController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN MANUSCRIPT KARYAWAN
    |--------------------------------------------------------------------------
    |
    | Hanya menampilkan manuscript milik user yang sedang login.
    | Semua status tetap ditampilkan.
    | Filter status hanya berlaku jika user memilih status tertentu.
    |
    */
    public function index(Request $request)
    {
        $search = trim((string) $request->search);
        $status = $request->status;

        $manuscripts = Manuscript::with('user')

            // HANYA MANUSCRIPT MILIK USER YANG LOGIN
            ->where('user_id', auth()->id())

            // FILTER STATUS JIKA DIPILIH
            ->when(!empty($status), function ($query) use ($status) {
                $query->where('status', $status);
            })

            // SEARCH
            ->when(!empty($search), function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('author_name', 'like', '%' . $search . '%')
                        ->orWhere('title', 'like', '%' . $search . '%')
                        ->orWhere('journal', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'manuscripts.index',
            compact(
                'manuscripts',
                'search',
                'status'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH MANUSCRIPT
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_name' => [
                'required',
                'string',
            ],

            'title' => [
                'required',
                'string',
            ],

            'journal' => [
                'required',
                'string',
                'max:255',
            ],

            'docs_link' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'status' => [
                'required',
                Rule::in([
                    'On Progress',
                    'Draft',
                    'Submitted',
                    'Pending',
                    'Under Review',
                    'Accepted',
                    'Rejected',
                    'Published',
                ]),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO
        |--------------------------------------------------------------------------
        */
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request
                ->file('photo')
                ->store('manuscripts', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN MANUSCRIPT
        |--------------------------------------------------------------------------
        |
        | user_id otomatis menggunakan ID user yang sedang login.
        |
        */
        Manuscript::create([
            'user_id' => auth()->id(),

            'author_name' => $validated['author_name'],

            'title' => $validated['title'],

            'journal' => $validated['journal'],

            'docs_link' => $validated['docs_link'] ?? null,

            'status' => $validated['status'],

            'description' => $validated['description'] ?? null,

            'photo' => $photoPath,
        ]);


        return back()->with(
            'success',
            'Data manuscript berhasil ditambahkan.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE MANUSCRIPT
    |--------------------------------------------------------------------------
    |
    | Karyawan hanya dapat mengedit manuscript miliknya sendiri.
    | Admin tetap dapat mengedit manuscript siapa pun.
    |
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'author_name' => [
                'required',
                'string',
            ],

            'title' => [
                'required',
                'string',
            ],

            'journal' => [
                'required',
                'string',
                'max:255',
            ],

            'docs_link' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'status' => [
                'required',
                Rule::in([
                    'On Progress',
                    'Draft',
                    'Submitted',
                    'Pending',
                    'Under Review',
                    'Accepted',
                    'Rejected',
                    'Published',
                ]),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL MANUSCRIPT
        |--------------------------------------------------------------------------
        |
        | Admin:
        | Bisa mengambil semua manuscript.
        |
        | User:
        | Hanya manuscript dengan user_id miliknya.
        |
        */
        if (auth()->user()->role === 'admin') {

            $manuscript = Manuscript::findOrFail($id);

        } else {

            $manuscript = Manuscript::where(
                'user_id',
                auth()->id()
            )->findOrFail($id);

        }


        /*
        |--------------------------------------------------------------------------
        | FOTO LAMA
        |--------------------------------------------------------------------------
        */
        $photoPath = $manuscript->photo;


        /*
        |--------------------------------------------------------------------------
        | JIKA FOTO DIGANTI
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('photo')) {

            // Hapus foto lama
            if ($manuscript->photo) {
                Storage::disk('public')
                    ->delete($manuscript->photo);
            }

            // Simpan foto baru
            $photoPath = $request
                ->file('photo')
                ->store('manuscripts', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */
        $manuscript->update([
            'author_name' => $validated['author_name'],

            'title' => $validated['title'],

            'journal' => $validated['journal'],

            'docs_link' => $validated['docs_link'] ?? null,

            'status' => $validated['status'],

            'description' => $validated['description'] ?? null,

            'photo' => $photoPath,
        ]);


        return back()->with(
            'success',
            'Data manuscript berhasil diupdate.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS MANUSCRIPT
    |--------------------------------------------------------------------------
    |
    | Karyawan hanya dapat menghapus manuscript miliknya.
    | Admin dapat menghapus manuscript semua karyawan.
    |
    */
    public function destroy($id)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA
        |--------------------------------------------------------------------------
        */
        if (auth()->user()->role === 'admin') {

            $manuscript = Manuscript::findOrFail($id);

        } else {

            $manuscript = Manuscript::where(
                'user_id',
                auth()->id()
            )->findOrFail($id);

        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS FOTO
        |--------------------------------------------------------------------------
        */
        if ($manuscript->photo) {

            Storage::disk('public')
                ->delete($manuscript->photo);

        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS MANUSCRIPT
        |--------------------------------------------------------------------------
        */
        $manuscript->delete();


        return back()->with(
            'success',
            'Data manuscript berhasil dihapus.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN ADMIN MANUSCRIPT
    |--------------------------------------------------------------------------
    |
    | Admin melihat manuscript seluruh karyawan.
    |
    */
    public function adminIndex(Request $request)
    {
        $search = trim((string) $request->search);
        $status = $request->status;


        $manuscripts = Manuscript::with('user')

            /*
            |--------------------------------------------------------------------------
            | FILTER STATUS
            |--------------------------------------------------------------------------
            */
            ->when(!empty($status), function ($query) use ($status) {

                $query->where(
                    'status',
                    $status
                );

            })


            /*
            |--------------------------------------------------------------------------
            | SEARCH
            |--------------------------------------------------------------------------
            */
            ->when(!empty($search), function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

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
                        'journal',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhere(
                        'status',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhere(
                        'description',
                        'like',
                        '%' . $search . '%'
                    )

                    /*
                    |--------------------------------------------------------------------------
                    | SEARCH BERDASARKAN USER
                    |--------------------------------------------------------------------------
                    */
                    ->orWhereHas(
                        'user',
                        function ($userQuery) use ($search) {

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

                });

            })

            ->latest()
            ->paginate(10)
            ->withQueryString();


        return view(
            'admin.manuscripts.index',
            compact(
                'manuscripts',
                'search',
                'status'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN PUBLIK MANUSCRIPT PUBLISHED
    |--------------------------------------------------------------------------
    |
    | Dapat dibuka tanpa login.
    |
    | Hanya manuscript yang memiliki:
    |
    | status = Published
    |
    | yang ditampilkan.
    |
    */
    public function publicPublished(Request $request)
    {
        $search = trim((string) $request->search);


        $manuscripts = Manuscript::query()

            /*
            |--------------------------------------------------------------------------
            | HANYA STATUS PUBLISHED
            |--------------------------------------------------------------------------
            */
            ->where(
                'status',
                'Published'
            )


            /*
            |--------------------------------------------------------------------------
            | SEARCH PUBLIK
            |--------------------------------------------------------------------------
            */
            ->when(!empty($search), function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

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
                        'journal',
                        'like',
                        '%' . $search . '%'
                    );

                });

            })

            ->orderByDesc('updated_at')
            ->paginate(12)
            ->withQueryString();


        return view(
            'public.manuscripts',
            compact(
                'manuscripts',
                'search'
            )
        );
    }
}