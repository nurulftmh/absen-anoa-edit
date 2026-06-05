<x-app-layout>
    <div class="p-6 max-w-5xl mx-auto">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-green-950">Progres Kerja</h1>
            <p class="text-gray-500 mt-1">
                Upload dan lihat riwayat progres kerja harian kamu.
            </p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-2xl mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl mb-5">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl mb-5">
                <ul class="list-disc ms-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Upload Progres Kerja</h2>

            @if($attendance && $attendance->status === 'hadir')
                <form action="{{ route('work.progress.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Progres</label>
                    <textarea name="description" rows="5"
                              class="w-full border-gray-200 rounded-2xl shadow-sm focus:border-green-700 focus:ring-green-700 mb-4"
                              placeholder="Contoh: Menyelesaikan laporan harian, revisi dokumen, koordinasi tim..."></textarea>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">Upload File</label>
                    <input type="file" name="files[]" multiple
                           class="w-full border border-gray-200 rounded-2xl p-3 text-sm mb-4">

                    <button class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-xl shadow transition">
                        Simpan Progres
                    </button>
                </form>
            @else
                <div class="bg-gray-50 text-gray-500 p-5 rounded-2xl text-sm">
                    Form progres kerja aktif setelah kamu melakukan absen masuk.
                </div>
            @endif
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Riwayat Progres Kerja Saya</h2>

            @forelse($workProgresses as $progress)
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5 mb-4">

                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <p class="text-sm text-gray-700 mb-3">
                                {{ $progress->description }}
                            </p>

                            @if($progress->files && $progress->files->count() > 0)
                                <div class="space-y-1 mb-3">
                                    @foreach($progress->files as $file)
                                        <a href="{{ asset('storage/' . $file->file_path) }}"
                                           target="_blank"
                                           class="block text-blue-700 hover:underline text-sm">
                                            📎 {{ $file->file_name }}
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs text-gray-400 mb-3">
                                    Tidak ada file terlampir.
                                </p>
                            @endif

                            <div class="text-xs text-gray-400 space-y-1">
                                <p>
                                    Diunggah:
                                    {{ $progress->created_at->format('d-m-Y H:i') }}
                                </p>

                                <p>
                                    Terakhir diedit:
                                    {{ $progress->updated_at->format('d-m-Y H:i') }}
                                </p>
                            </div>
                        </div>

                        <button type="button"
                                onclick="document.getElementById('edit-{{ $progress->id }}').classList.toggle('hidden')"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl text-sm font-semibold">
                            Edit
                        </button>
                    </div>

                    <div id="edit-{{ $progress->id }}" class="hidden mt-5 border-t pt-5">
                        <form action="{{ route('work.progress.update', $progress->id) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Edit Deskripsi
                            </label>

                            <textarea name="description"
                                      rows="4"
                                      class="w-full border-gray-200 rounded-2xl shadow-sm focus:border-yellow-500 focus:ring-yellow-500 mb-4">{{ $progress->description }}</textarea>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Ganti File
                            </label>

                            <input type="file"
                                   name="files[]"
                                   multiple
                                   class="w-full border border-gray-200 rounded-2xl p-3 text-sm mb-4">

                            <button class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-3 rounded-xl font-semibold">
                                Update Progres
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="bg-gray-50 text-gray-500 p-5 rounded-2xl text-sm">
                    Belum ada progres kerja yang diupload.
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>