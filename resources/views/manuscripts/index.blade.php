@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 py-8">
        <div class="px-6 max-w-7xl mx-auto">

            {{-- HEADER --}}
            <div class="mb-8 bg-white/80 backdrop-blur rounded-3xl shadow-sm border border-green-100 p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-4 py-1.5 rounded-full text-sm font-semibold mb-3">
                            📄 Manajemen Manuscript
                        </div>

                        <h1 class="text-3xl md:text-4xl font-extrabold text-green-950 tracking-tight">
                            Manajemen Manuscript
                        </h1>

                        <p class="text-gray-500 mt-2 max-w-2xl">
                            Input, pantau, dan kelola data manuscript karyawan secara lebih rapi.
                        </p>
                    </div>

                    <div class="bg-green-950 text-white rounded-2xl px-6 py-4 shadow-md">
                        <p class="text-sm text-green-100">Total Data</p>
                        <p class="text-3xl font-bold">{{ $manuscripts->total() }}</p>
                    </div>
                </div>
            </div>

            {{-- ALERT --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-2xl mb-5 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- FORM TAMBAH COMPACT --}}
            <div class="bg-white rounded-3xl shadow-sm border border-green-100 p-5 mb-8">

                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">
                            Tambah Manuscript
                        </h2>
                        <p class="text-xs text-gray-500 mt-1">
                            Isi data manuscript secara ringkas.
                        </p>
                    </div>

                    <div class="hidden md:flex w-11 h-11 rounded-2xl bg-green-100 text-green-800 items-center justify-center text-xl">
                        📄
                    </div>
                </div>

                <form action="{{ route('manuscripts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">

                        <div>
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Nama Penulis
                            </label>
                            <input type="text"
                                   name="author_name"
                                   placeholder="Nama penulis"
                                   class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-green-700 focus:ring-green-700"
                                   required>
                        </div>

                        <div>
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Jurnal
                            </label>
                            <input type="text"
                                   name="journal"
                                   placeholder="Nama/link jurnal"
                                   class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-green-700 focus:ring-green-700"
                                   required>
                        </div>

                        <div>
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Link Docs
                            </label>

                            <input type="url"
                                   name="docs_link"
                                   placeholder="https://docs.google.com/..."
                                   class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-green-700 focus:ring-green-700">
                        </div>

                        <div>
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Status
                            </label>
                            <select name="status"
                                    class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-green-700 focus:ring-green-700">
                                <option value="On Progress">On Progress</option>
                                <option value="Draft">Draft</option>
                                <option value="Submitted">Submitted</option>
                                <option value="Pending">Pending</option>
                                <option value="Under Review">Under Review</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Published">Published</option>
                            </select>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mt-3">

                        <div class="md:col-span-2">
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Judul Manuscript
                            </label>
                            <textarea name="title"
                                      rows="2"
                                      placeholder="Masukkan judul manuscript"
                                      class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-green-700 focus:ring-green-700"
                                      required></textarea>
                        </div>

                        <div>
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Keterangan
                            </label>
                            <input type="text"
                                   name="description"
                                   placeholder="Keterangan singkat"
                                   class="w-full rounded-xl border-gray-200 text-sm py-2.5 focus:border-green-700 focus:ring-green-700">
                        </div>

                    </div>

                    <div class="mt-3 flex flex-col md:flex-row md:items-end gap-3">

                        <div class="flex-1">
                            <label class="block mb-1.5 font-semibold text-xs text-gray-600">
                                Upload Foto
                            </label>
                            <input type="file"
                                   name="photo"
                                   class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm bg-gray-50">
                        </div>

                        <button class="bg-green-800 hover:bg-green-900 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-sm transition">
                            Simpan Manuscript
                        </button>

                    </div>
                </form>
            </div>

            {{-- TABLE CARD --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-green-950/5 border border-green-100 overflow-hidden">

                {{-- SEARCH --}}
                <div class="p-6 border-b border-gray-100">
                    <div class="mb-4">
                        <h2 class="text-lg font-bold text-gray-800">Daftar Manuscript</h2>
                        <p class="text-sm text-gray-500">Data manuscript yang sudah diinputkan.</p>
                    </div>

                    <form action="{{ route('manuscripts.index') }}" method="GET">
                        <div class="flex flex-col md:flex-row gap-3">
                            <div class="relative w-full">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    🔍
                                </span>

                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari penulis, judul, jurnal, status, atau keterangan..."
                                       class="w-full pl-11 rounded-2xl border-gray-200 bg-gray-50 shadow-sm focus:bg-white focus:border-green-700 focus:ring-green-700">
                            </div>

                            <button type="submit"
                                    class="bg-green-800 hover:bg-green-900 text-white px-7 py-3 rounded-2xl font-semibold shadow-sm transition">
                                Cari
                            </button>

                            @if(request('search'))
                                <a href="{{ route('manuscripts.index') }}"
                                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-7 py-3 rounded-2xl font-semibold transition text-center">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-green-950 text-white">
                                <th class="px-5 py-4 text-left font-semibold">Foto</th>
                                <th class="px-5 py-4 text-left font-semibold">Penulis</th>
                                <th class="px-5 py-4 text-left font-semibold">Judul</th>
                                <th class="px-5 py-4 text-left font-semibold">Jurnal</th>
                                <th class="px-5 py-4 text-left font-semibold">Docs</th>
                                <th class="px-5 py-4 text-left font-semibold">Status</th>
                                <th class="px-5 py-4 text-left font-semibold">Keterangan</th>
                                <th class="px-5 py-4 text-left font-semibold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($manuscripts as $item)
                                <tr class="hover:bg-green-50/70 transition">

                                    {{-- FOTO --}}
                                    <td class="px-5 py-4">
                                        @if($item->photo)
                                            <div class="flex items-center gap-3">
                                                <img src="{{ asset('storage/' . $item->photo) }}"
                                                     class="w-16 h-16 object-cover rounded-2xl border border-gray-200 shadow-sm cursor-pointer hover:scale-105 transition"
                                                     onclick="openImage('{{ asset('storage/' . $item->photo) }}')">

                                                <button type="button"
                                                        onclick="openImage('{{ asset('storage/' . $item->photo) }}')"
                                                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1.5 rounded-xl shadow-sm transition">
                                                    Lihat
                                                </button>
                                            </div>
                                        @else
                                            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400 text-xs border">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    {{-- PENULIS --}}
                                    <td class="px-5 py-4">
                                        <div class="font-semibold text-gray-800">
                                            {{ $item->author_name }}
                                        </div>
                                    </td>

                                    {{-- JUDUL --}}
                                    <td class="px-5 py-4 max-w-md">
                                        <div class="font-semibold text-gray-800 leading-snug">
                                            {{ $item->title }}
                                        </div>
                                    </td>

                                    {{-- JURNAL --}}
                                    <td class="px-5 py-4">
                                        @if(Str::startsWith($item->journal, ['http://', 'https://']))
                                            <a href="{{ $item->journal }}"
                                               target="_blank"
                                               class="inline-flex items-center gap-1 text-blue-700 hover:text-blue-900 font-semibold bg-blue-50 px-3 py-1.5 rounded-xl">
                                                🔗 Buka Jurnal
                                            </a>
                                        @else
                                            <span class="text-gray-700">
                                                {{ $item->journal }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- DOCS --}}
                                    <td class="px-5 py-4">
                                        @if($item->docs_link)
                                            <a href="{{ $item->docs_link }}"
                                               target="_blank"
                                               class="inline-flex items-center gap-1 text-indigo-700 hover:text-indigo-900 font-semibold bg-indigo-50 px-3 py-1.5 rounded-xl">
                                                📄 Buka Docs
                                            </a>
                                        @else
                                            <span class="text-gray-400">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-5 py-4">
                                        @if($item->status == 'On Progress')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-orange-100 text-indigo-700 border border-orange-200">
                                                🚧 On Progress
                                            </span>
                                        @elseif($item->status == 'Draft')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                                📝 Draft
                                            </span>
                                        @elseif($item->status == 'Submitted')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">
                                                📤 Submitted
                                            </span>
                                        @elseif($item->status == 'Pending')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                🔍 Pending
                                            </span>
                                        @elseif($item->status == 'Under Review')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-yellow-700 border border-blue-200">
                                                🔍 Under Review
                                            </span>
                                        @elseif($item->status == 'Accepted')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                                ✅ Accepted
                                            </span>
                                        @elseif($item->status == 'Rejected')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                                ❌ Rejected
                                            </span>
                                        @elseif($item->status == 'Published')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-purple-100 text-purple-700 border border-purple-200">
                                                🚀 Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                                {{ $item->status }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- KETERANGAN --}}
                                    <td class="px-5 py-4 max-w-xs">
                                        <p class="text-gray-600 leading-relaxed">
                                            {{ $item->description ?? '-' }}
                                        </p>
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-5 py-4">
                                        <div class="flex gap-2 flex-wrap">
                                            <button type="button"
                                                    onclick="document.getElementById('edit-{{ $item->id }}').classList.toggle('hidden')"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-xl text-sm shadow-sm transition">
                                                Edit
                                            </button>

                                            <form action="{{ route('manuscripts.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-xl text-sm shadow-sm transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- FORM EDIT --}}
                                <tr id="edit-{{ $item->id }}" class="hidden bg-gray-50">
                                    <td colspan="8" class="p-5">
                                        <form action="{{ route('manuscripts.update', $item->id) }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')

                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <input type="text"
                                                       name="author_name"
                                                       value="{{ $item->author_name }}"
                                                       placeholder="Nama Penulis"
                                                       class="rounded-2xl border-gray-200">

                                                <input type="text"
                                                       name="journal"
                                                       value="{{ $item->journal }}"
                                                       placeholder="Jurnal"
                                                       class="rounded-2xl border-gray-200">

                                                <input type="url"
                                                       name="docs_link"
                                                       value="{{ $item->docs_link }}"
                                                       placeholder="Link Google Docs"
                                                       class="rounded-2xl border-gray-200">
                                            </div>

                                            <textarea name="title"
                                                      rows="3"
                                                      class="w-full rounded-2xl border-gray-200 mt-4">{{ $item->title }}</textarea>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                                <select name="status"
                                                        class="rounded-2xl border-gray-200">
                                                    <option value="On Progress" {{ $item->status == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                                                    <option value="Draft" {{ $item->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="Submitted" {{ $item->status == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                                                    <option value="Pending" {{ $item->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Under Review" {{ $item->status == 'Under Review' ? 'selected' : '' }}>Under Review</option>
                                                    <option value="Accepted" {{ $item->status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                                    <option value="Rejected" {{ $item->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                    <option value="Published" {{ $item->status == 'Published' ? 'selected' : '' }}>Published</option>
                                                </select>

                                                <input type="text"
                                                       name="description"
                                                       value="{{ $item->description }}"
                                                       class="rounded-2xl border-gray-200">
                                            </div>

                                            <div class="mt-4">
                                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                                    Ganti Foto
                                                </label>

                                                <input type="file"
                                                       name="photo"
                                                       class="w-full border border-gray-200 rounded-2xl p-3 text-sm bg-white">
                                            </div>

                                            <button class="mt-4 bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-2xl shadow-sm transition">
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-20 h-20 rounded-full bg-green-50 flex items-center justify-center text-4xl mb-4">
                                                📭
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-800">
                                                Belum ada data manuscript
                                            </h3>
                                            <p class="text-gray-500 mt-1">
                                                Data manuscript yang diinputkan akan tampil di sini.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="p-6 border-t border-gray-100 bg-gray-50">
                        {{ $manuscripts->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL PREVIEW FOTO --}}
    <div id="imageModal"
         class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 p-6">

        <div class="relative max-w-5xl w-full flex justify-center">
            <button type="button"
                    onclick="closeImage()"
                    class="absolute top-0 right-0 -mt-12 text-white text-4xl font-bold hover:text-red-400 transition">
                &times;
            </button>

            <img id="previewImage"
                 src=""
                 class="max-h-[90vh] rounded-3xl shadow-2xl border-4 border-white">
        </div>
    </div>

    <script>
        function openImage(src) {
            document.getElementById('previewImage').src = src;

            const modal = document.getElementById('imageModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeImage() {
            const modal = document.getElementById('imageModal');

            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.getElementById('previewImage').src = '';
        }
    </script>
</x-app-layout>