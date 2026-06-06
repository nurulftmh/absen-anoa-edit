<nav class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">
            {{-- Kiri: Logo dan Menu --}}
            <div class="flex items-center">

                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-11 w-auto" alt="Logo">

                    <div class="hidden sm:block">
                        <p class="font-bold text-green-900 leading-tight">
                            PT ANOA
                        </p>
                        <p class="text-xs text-gray-500">
                            Sejahtera Mandiri
                        </p>
                    </div>
                </a>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.attendance.index')" :active="request()->routeIs('admin.attendance.index')">
                            Absensi
                        </x-nav-link>

                        <x-nav-link :href="route('admin.leave.index')" :active="request()->routeIs('admin.leave.index')">
                            Izin
                        </x-nav-link>

                        <x-nav-link :href="route('admin.progress.index')" :active="request()->routeIs('admin.progress.index')">
                            Progres
                        </x-nav-link>

                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                            User
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- Kanan: Notifikasi dan Nama User --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">

                {{-- Dropdown Notifikasi --}}
                <div class="relative" x-data="{ openNotification: false }">
                    <button
                        type="button"
                        @click="openNotification = !openNotification"
                        class="relative inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-50 text-gray-600 hover:bg-gray-100 hover:text-gray-900 focus:outline-none transition"
                    >
                        <span class="text-lg">🔔</span>

                        @if(auth()->user()->role === 'admin')
                            @if(isset($adminLeaveRequestCount) && $adminLeaveRequestCount > 0)
                                <span class="absolute -top-1 -right-1 inline-flex items-center justify-center min-w-[20px] h-5 px-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                    {{ $adminLeaveRequestCount }}
                                </span>
                            @endif
                        @else
                            @if(isset($leaveNotificationCount) && $leaveNotificationCount > 0)
                                <span class="absolute -top-1 -right-1 inline-flex items-center justify-center min-w-[20px] h-5 px-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                    {{ $leaveNotificationCount }}
                                </span>
                            @endif
                        @endif
                    </button>

                    <div
                        x-show="openNotification"
                        @click.away="openNotification = false"
                        x-transition
                        class="absolute right-0 z-50 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden"
                        style="display: none;"
                    >
                        <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                            <p class="text-sm font-semibold text-gray-800">
                                Pemberitahuan
                            </p>
                        </div>

                        {{-- Isi Notifikasi Admin --}}
                        @if(auth()->user()->role === 'admin')
                            @if(isset($adminLeaveRequests) && $adminLeaveRequests->count() > 0)
                                <div class="max-h-72 overflow-y-auto">
                                    @foreach($adminLeaveRequests as $request)
                                        <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50">
                                            <div class="flex items-start gap-2">
                                                <div class="text-lg">
                                                    📝
                                                </div>

                                                <div class="flex-1">
                                                    <p class="text-sm font-semibold text-orange-600">
                                                        Pengajuan izin baru
                                                    </p>

                                                    <p class="text-sm text-gray-700 mt-1">
                                                        Karyawan:
                                                        {{ $request->user->name ?? 'User tidak ditemukan' }}
                                                    </p>

                                                    <p class="text-sm text-gray-700 mt-1">
                                                        Tanggal:
                                                        {{ \Carbon\Carbon::parse($request->date)->format('d-m-Y') }}
                                                    </p>

                                                    <p class="text-xs text-gray-500 mt-1">
                                                        Alasan izin: {{ $request->reason }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <a
                                    href="{{ route('admin.leave.index') }}"
                                    class="block w-full px-4 py-2 text-sm text-center text-blue-600 hover:bg-gray-50"
                                >
                                    Lihat semua pengajuan izin
                                </a>
                            @else
                                <div class="px-4 py-4 text-sm text-gray-500">
                                    Tidak ada pengajuan izin baru.
                                </div>
                            @endif

                        {{-- Isi Notifikasi Karyawan --}}
                        @else
                            @if(isset($leaveNotifications) && $leaveNotifications->count() > 0)
                                <div class="max-h-72 overflow-y-auto">
                                    @foreach($leaveNotifications as $notification)
                                        <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50">
                                            <div class="flex items-start gap-2">

                                                <div class="text-lg">
                                                    @if($notification->status === 'approved')
                                                        ✅
                                                    @elseif($notification->status === 'rejected')
                                                        ❌
                                                    @else
                                                        🔔
                                                    @endif
                                                </div>

                                                <div class="flex-1">
                                                    @if($notification->status === 'approved')
                                                        <p class="text-sm font-semibold text-green-600">
                                                            Izin Anda disetujui
                                                        </p>
                                                    @elseif($notification->status === 'rejected')
                                                        <p class="text-sm font-semibold text-red-600">
                                                            Izin Anda ditolak
                                                        </p>
                                                    @else
                                                        <p class="text-sm font-semibold text-gray-700">
                                                            Status izin diperbarui
                                                        </p>
                                                    @endif

                                                    <p class="text-sm text-gray-700 mt-1">
                                                        Tanggal:
                                                        {{ \Carbon\Carbon::parse($notification->date)->format('d-m-Y') }}
                                                    </p>

                                                    <p class="text-xs text-gray-500 mt-1">
                                                        Alasan izin: {{ $notification->reason }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <form method="POST" action="{{ route('notifications.leave.read') }}">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full px-4 py-2 text-sm text-center text-blue-600 hover:bg-gray-50"
                                    >
                                        Tandai semua sudah dibaca
                                    </button>
                                </form>
                            @else
                                <div class="px-4 py-4 text-sm text-gray-500">
                                    Tidak ada pemberitahuan baru.
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                {{-- Dropdown Nama User --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-gray-600 bg-gray-50 hover:bg-gray-100 transition">
                            <div>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>