<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-green-950">Kelola User</h1>
            <p class="text-gray-500 mt-1">
                Admin dapat mengubah role dan menghapus akun user.
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

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-green-950 text-white">
                        <tr>
                            <th class="p-4 text-left">Nama</th>
                            <th class="p-4 text-left">Email</th>
                            <th class="p-4 text-left">Role</th>
                            <th class="p-4 text-left">Tanggal Daftar</th>
                            <th class="p-4 text-left">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-semibold text-gray-800">
                                    {{ $user->name }}

                                    @if($user->id === auth()->id())
                                        <span class="ml-2 text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                                            Kamu
                                        </span>
                                    @endif
                                </td>

                                <td class="p-4 text-gray-600">
                                    {{ $user->email }}
                                </td>

                                <td class="p-4">
                                    @if($user->role === 'admin')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ADMIN
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            USER
                                        </span>
                                    @endif
                                </td>

                                <td class="p-4 text-gray-600">
                                    {{ $user->created_at->format('d-m-Y H:i') }}
                                </td>

                                <td class="p-4">
                                    <div class="flex flex-wrap gap-2">

                                        <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <select name="role"
                                                    class="border-gray-200 rounded-xl text-sm">
                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                                    User
                                                </option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>
                                            </select>

                                            <button class="bg-blue-700 hover:bg-blue-800 text-white px-3 py-2 rounded-xl text-sm">
                                                Simpan
                                            </button>
                                        </form>

                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-xl text-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>