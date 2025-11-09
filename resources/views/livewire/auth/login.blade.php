@section('title', 'Sign in to your account')

<div>

    {{-- Bagian Header dari Kode Asli Anda --}}
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <a href="{{ route('home') }}">
            <x-logo class="w-auto h-12 mx-auto text-blue-600" />
        </a>

        <h2 class="mt-4 text-2xl font-bold text-center text-gray-900 leading-9">
            Sign in to your account
        </h2>
        @if (Route::has('register'))
            <p class="mt-1 text-sm text-center text-gray-700 leading-5 max-w">
                Or
                <a href="{{ route('register') }}"
                    class="font-medium text-blue-700 hover:text-blue-900 underline focus:outline-none transition ease-in-out duration-150">
                    create a new account
                </a>
            </p>
        @endif
    </div>

    {{-- Bagian Form dari Kode Asli Anda --}}
    <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-0 py-0">
            <form wire:submit.prevent="authenticate">
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 leading-5">
                        Email address
                    </label>

                    {{-- Input (Diubah ke style 3D inset) --}}
                    <div class="mt-1">
                        <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus class="block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100
                                              @error('email') border-red-500 border-2 @enderror" />
                    </div>

                    @error('email')
                        <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4" x-data="{ showPassword: false }">
                    <label for="password" class="block text-sm font-bold text-gray-700 leading-5">
                        Password
                    </label>

                    <div class="mt-1">
                        <input wire:model.lazy="password" id="password" :type="showPassword ? 'text' : 'password'" required class="block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100
                                              @error('password') border-red-500 border-2 @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                    @enderror

                    <div class="mt-2 flex items-center">
                        <input id="show_password_login" type="checkbox" x-model="showPassword"
                            class="form-checkbox w-4 h-4 text-blue-700 bg-white border-gray-700 transition duration-150 ease-in-out">
                        <label for="show_password_login" class="ml-2 block text-sm text-gray-900 leading-5">
                            Tampilkan Password
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center">
                        {{-- Checkbox (Diberi border agar sedikit retro) --}}
                        <input wire:model.lazy="remember" id="remember" type="checkbox"
                            class="form-checkbox w-4 h-4 text-blue-700 bg-white border-gray-700 transition duration-150 ease-in-out" />
                        <label for="remember" class="block ml-2 text-sm text-gray-900 leading-5">
                            Remember
                        </label>
                    </div>

                    <div class="text-sm leading-5">
                        <a href="{{ route('password.request') }}"
                            class="font-medium text-blue-700 hover:text-blue-900 underline focus:outline-none transition ease-in-out duration-150">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    {{-- Tombol (Diubah ke style 3D button) --}}
                    <span class="block w-full">
                        <button type="submit"
                            class="flex justify-center w-full px-4 py-2 text-sm font-bold text-gray-900 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200 transition duration-150 ease-in-out">
                            Sign in
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div> 
</div>