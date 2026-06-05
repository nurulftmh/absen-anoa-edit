<?php

namespace App\Http\Controllers;

use App\Models\Manuscript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManuscriptController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $manuscripts = Manuscript::with('user')
            ->when($search, function ($query) use ($search) {
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

        return view('manuscripts.index', compact('manuscripts', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required',
            'title' => 'required',
            'journal' => 'required',
            'status' => 'required',
            'description' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('manuscripts', 'public');
        }

        Manuscript::create([
            'user_id' => auth()->id(),
            'author_name' => $request->author_name,
            'title' => $request->title,
            'journal' => $request->journal,
            'status' => $request->status,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return back()->with('success', 'Data manuscript berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'author_name' => 'required',
            'title' => 'required',
            'journal' => 'required',
            'status' => 'required',
            'description' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $manuscript = Manuscript::findOrFail($id);

        $photoPath = $manuscript->photo;

        if ($request->hasFile('photo')) {
            if ($manuscript->photo) {
                Storage::disk('public')->delete($manuscript->photo);
            }

            $photoPath = $request->file('photo')->store('manuscripts', 'public');
        }

        $manuscript->update([
            'author_name' => $request->author_name,
            'title' => $request->title,
            'journal' => $request->journal,
            'status' => $request->status,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return back()->with('success', 'Data manuscript berhasil diupdate.');
    }

    public function destroy($id)
    {
        $manuscript = Manuscript::findOrFail($id);

        if ($manuscript->photo) {
            Storage::disk('public')->delete($manuscript->photo);
        }

        $manuscript->delete();

        return back()->with('success', 'Data manuscript berhasil dihapus.');
    }

    public function adminIndex(Request $request)
    {
        $search = $request->search;

        $manuscripts = Manuscript::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('author_name', 'like', '%' . $search . '%')
                        ->orWhere('title', 'like', '%' . $search . '%')
                        ->orWhere('journal', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.manuscripts.index', compact('manuscripts', 'search'));
    }
}