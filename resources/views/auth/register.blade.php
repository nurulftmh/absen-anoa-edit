<x-guest-layout>
    

            <div class="text-center mb-6">
                <img src="{{ asset('images/logo.png') }}" class="w-24 mx-auto mb-4" alt="Logo">
                <h1 class="text-2xl font-bold text-green-950">Registrasi Akun</h1>
                <p class="text-sm text-gray-500 mt-1">PT Anoa Sejahtera Mandiri</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" value="Nama Lengkap" />
                    <x-text-input id="name"
                                  class="block mt-1 w-full"
                                  type="text"
                                  name="name"
                                  :value="old('name')"
                                  required
                                  autofocus
                                  autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email"
                                  class="block mt-1 w-full"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required
                                  autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password"
                                  class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required
                                  autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                    <x-text-input id="password_confirmation"
                                  class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation"
                                  required
                                  autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <button type="submit"
                            class="w-full bg-green-900 hover:bg-green-800 text-white font-semibold py-3 rounded-xl shadow transition">
                        Daftar
                    </button>
                </div>

                <div class="text-center mt-5 text-sm">
                    <span class="text-gray-500">Sudah punya akun?</span>
                    <a class="text-green-800 font-semibold hover:text-green-700" href="{{ route('login') }}">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>