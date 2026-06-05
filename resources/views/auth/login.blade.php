<x-guest-layout>
    

            <div class="text-center mb-6">
                <img src="{{ asset('images/logo.png') }}" class="w-24 mx-auto mb-4" alt="Logo">
                <h1 class="text-2xl font-bold text-green-950">Login</h1>
                <p class="text-sm text-gray-500 mt-1">PT Anoa Sejahtera Mandiri</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email"
                                  class="block mt-1 w-full"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required
                                  autofocus
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
                                  autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me"
                               type="checkbox"
                               class="rounded border-gray-300 text-green-800 shadow-sm focus:ring-green-700"
                               name="remember">
                        <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                <div class="mt-6">
                    <button type="submit"
                            class="w-full bg-green-900 hover:bg-green-800 text-white font-semibold py-3 rounded-xl shadow transition">
                        Masuk
                    </button>
                </div>

                <div class="flex items-center justify-between mt-5 text-sm">
                    @if (Route::has('password.request'))
                        <a class="text-gray-500 hover:text-green-800" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif

                    <a class="text-green-800 font-semibold hover:text-green-700" href="{{ route('register') }}">
                        Buat akun
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>