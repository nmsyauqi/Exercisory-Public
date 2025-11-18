<div class="w-full sm:max-w-md mx-auto">
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-900">
            {{ $greeting }}
        </h2>
        @if($step == 2)
            <p class="text-sm text-gray-700 mt-1">
                {{ $email }} 
                <button wire:click="resetStep" type="button" class="font-medium text-blue-700 hover:text-blue-900 underline text-xs ml-1">
                    (Bukan Anda?)
                </button>
            </p>
        @endif
    </div>

    <form wire:submit="submit">
        
        @if ($step == 1)
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 leading-5">Email</label>
                <input id="email" class="mt-1 block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100" type="email" wire:model="email" required autofocus placeholder="masukkan@email.anda" wire:keydown.enter.prevent="checkEmail"/>
                @error('email') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <button wire:click.prevent="checkEmail" type="button" wire:loading.attr="disabled"
                        class="font-semibold text-gray-900 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200">
                    Lanjut
                </button>
            </div>
        @endif

        @if ($step == 2)

            @if ($isRegistering)
                <div class="mb-4">
                    <label for="name" class="block text-sm font-bold text-gray-700 leading-5">Nama</label>
                    <input id="name" class="mt-1 block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100" type="text" wire:model="name" required autofocus autocomplete="name" />
                    @error('name') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            @endif

            <div class="mt-4" x-data="{ showPassword: false }">
                <label for="password" class="block text-sm font-bold text-gray-700 leading-5">Password</label>
                <input id="password" class="mt-1 block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100" :type="showPassword ? 'text' : 'password'" wire:model="password" required autocomplete="current-password" />
                @error('password') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
                @if ($showForgotPasswordLink)
                    <div class="mt-4 text-sm">
                        <a href="{{ route('password.request') }}" wire:navigate
                            class="font-medium text-blue-700 hover:text-blue-900 underline">
                            Lupa password Anda?
                        </a>
                    </div>
                @endif
                <div class="mt-2 flex items-center">
                    <input id="show_password_login" type="checkbox" x-model="showPassword" class="form-checkbox w-4 h-4 text-blue-700 bg-white border-gray-700 transition duration-150 ease-in-out">
                    <label for="show_password_login" class="ml-2 block text-sm text-gray-900 leading-5">
                        Tampilkan Password
                    </label>
                </div>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" wire:model="remember" class="form-checkbox w-4 h-4 text-blue-700 bg-white border-gray-700" />
                    <span class="ml-2 text-sm text-gray-900">{{ __('Ingat saya') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="ml-4 font-semibold text-gray-900 px-4 py-2 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:shadow-inner active:bg-gray-200" wire:loading.attr="disabled">
                    {{ $isRegistering ? __('Daftar Sekarang') : __('Masuk') }}
                </button>
            </div>
        @endif
    </form>
</div>