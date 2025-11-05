@section('title', 'Sign in to your account')

{{-- CONTAINER UTAMA (Gaya Komputer Retro) --}}
<div class="relative min-h-screen bg-gray-300 font-mono text-gray-900 selection:bg-blue-700 selection:text-white sm:flex sm:justify-center sm:items-center py-12 px-4">

    {{-- KONTEN UTAMA - SIMULASI JENDELA APLIKASI --}}
    <div class="relative p-6 mx-auto w-full sm:max-w-md lg:p-8">
            
        {{-- WINDOW FRAME (Batas 3D dan Shadow tebal) --}}
        <div class="bg-gray-300 border-t-4 border-l-4 border-white border-r-4 border-b-4 border-gray-700 shadow-[8px_8px_0_0_#000000] p-4 sm:p-6">

            {{-- TITLE BAR (Garis Biru) --}}
            <div class="bg-blue-700 text-white p-1.5 mb-6 border-t-2 border-l-2 border-blue-400 border-r-2 border-b-2 border-blue-900 shadow-inner">
                <span class="font-bold text-sm">C:\SYSTEM\LOGIN.EXE</span>
            </div>

            {{-- Bagian Header dari Kode Asli Anda --}}
            <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
                <a href="{{ route('home') }}">
                    <x-logo class="w-auto h-12 mx-auto text-red-600" />
                </a>

                <h2 class="mt-4 text-2xl font-bold text-center text-gray-900 leading-9">
                    Sign in to your account
                </h2>
                @if (Route::has('register'))
                    <p class="mt-1 text-sm text-center text-gray-700 leading-5 max-w">
                        Or
                        <a href="{{ route('register') }}" class="font-medium text-blue-700 hover:text-blue-900 underline focus:outline-none transition ease-in-out duration-150">
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
                                <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus 
                                       class="block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100
                                              @error('email') border-red-500 border-2 @enderror" />
                            </div>

                            @error('email')
                                <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="password" class="block text-sm font-bold text-gray-700 leading-5">
                                Password
                            </label>

                            <div class="mt-1">
                                <input wire:model.lazy="password" id="password" type="password" required 
                                       class="block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100
                                              @error('password') border-red-500 border-2 @enderror" />
                            </div>

                             @error('password')
                                <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center">
                                {{-- Checkbox (Diberi border agar sedikit retro) --}}
                                <input wire:model.lazy="remember" id="remember" type="checkbox" class="form-checkbox w-4 h-4 text-blue-700 bg-white border-gray-700 transition duration-150 ease-in-out" />
                                <label for="remember" class="block ml-2 text-sm text-gray-900 leading-5">
                                    Remember
                                </label>
                            </div>

                            <div class="text-sm leading-5">
                                <a href="{{ route('password.request') }}" class="font-medium text-blue-700 hover:text-blue-900 underline focus:outline-none transition ease-in-out duration-150">
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

        </div> {{-- End WINDOW FRAME --}}
    </div> {{-- End KONTEN UTAMA --}}
</div> {{-- End CONTAINER UTAMA --}}