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
                            📄 Admin Manuscript
                        </div>

                        <h1 class="text-3xl md:text-4xl font-extrabold text-green-950 tracking-tight">
                            Data Manuscript Karyawan
                        </h1>

                        <p class="text-gray-500 mt-2 max-w-2xl">
                            Lihat, pantau, dan kelola seluruh manuscript yang telah diunggah oleh karyawan.
                        </p>
                    </div>

                    <div class="bg-green-950 text-white rounded-2xl px-6 py-4 shadow-md">
                        <p class="text-sm text-green-100">Total Data</p>
                        <p class="text-3xl font-bold">{{ $manuscripts->total() }}</p>
                    </div>
                </div>

                {{-- SEARCH --}}
                <form action="{{ route('admin.manuscripts.index') }}" method="GET" class="mt-6">
                    <div class="flex flex-col md:flex-row gap-3">

                        <div class="relative w-full">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                🔍
                            </span>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari karyawan, penulis, judul, jurnal, status, atau keterangan..."
                                   class="w-full pl-11 rounded-2xl border-gray-200 bg-gray-50 shadow-sm focus:bg-white focus:border-green-700 focus:ring-green-700">
                        </div>

                        <button type="submit"
                                class="bg-green-800 hover:bg-green-900 text-white px-7 py-3 rounded-2xl font-semibold shadow-sm transition">
                            Cari
                        </button>

                        @if(request('search'))
                            <a href="{{ route('admin.manuscripts.index') }}"
                               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-7 py-3 rounded-2xl font-semibold transition text-center">
                                Reset
                            </a>
                        @endif

                    </div>
                </form>
            </div>

            {{-- TABLE CARD --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-green-950/5 border border-green-100 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">
                            Daftar Manuscript
                        </h2>

                        <p class="text-sm text-gray-500">
                            Data manuscript berdasarkan unggahan karyawan.
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead>
                            <tr class="bg-green-950 text-white">
                                <th class="px-5 py-4 text-left font-semibold">Foto</th>
                                <th class="px-5 py-4 text-left font-semibold">Karyawan</th>
                                <th class="px-5 py-4 text-left font-semibold">Penulis</th>
                                <th class="px-5 py-4 text-left font-semibold">Judul</th>
                                <th class="px-5 py-4 text-left font-semibold">Jurnal</th>
                                <th class="px-5 py-4 text-left font-semibold">Docs</th>
                                <th class="px-5 py-4 text-left font-semibold">Status</th>
                                <th class="px-5 py-4 text-left font-semibold">Keterangan</th>
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

                                    {{-- KARYAWAN --}}
                                    <td class="px-5 py-4">
                                        <div class="font-semibold text-gray-800">
                                            {{ $item->user->name ?? '-' }}
                                        </div>
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

                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700 border border-indigo-200">
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

                                        @elseif($item->status == 'Under Review')

                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
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
                                                Manuscript yang diunggah karyawan akan tampil di sini.
                                            </p>

                                        </div>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                <div class="p-6 border-t border-gray-100 bg-gray-50">
                    {{ $manuscripts->links() }}
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