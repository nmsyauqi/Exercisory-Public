@section('title', 'Create a new account')

{{-- CONTAINER UTAMA (Gaya Komputer Retro) --}}
{{-- Kita bungkus semua dalam container ini agar temanya konsisten --}}
<div class="relative min-h-screen bg-gray-300 font-mono text-gray-900 selection:bg-blue-700 selection:text-white sm:flex sm:justify-center sm:items-center py-12 px-4">

    {{-- KONTEN UTAMA - SIMULASI JENDELA APLIKASI --}}
    {{-- Kita gunakan max-w-md dari kode asli Anda agar lebarnya pas --}}
    <div class="relative p-6 mx-auto w-full sm:max-w-md lg:p-8">
            
        {{-- WINDOW FRAME (Batas 3D dan Shadow tebal) --}}
        <div class="bg-gray-300 border-t-4 border-l-4 border-white border-r-4 border-b-4 border-gray-700 shadow-[8px_8px_0_0_#000000] p-4 sm:p-6">

            {{-- TITLE BAR (Garis Biru) --}}
            <div class="bg-blue-700 text-white p-1.5 mb-6 border-t-2 border-l-2 border-blue-400 border-r-2 border-b-2 border-blue-900 shadow-inner">
                <span class="font-bold text-sm">C:\SYSTEM\REGISTER.EXE</span>
            </div>

            {{-- Bagian Header dari Kode Asli Anda --}}
            <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
                <a href="{{ route('home') }}">
                    {{-- Kita ganti warnanya jadi merah agar konsisten dengan landing page --}}
                    <x-logo class="w-auto h-12 mx-auto text-red-600" />
                </a>

                <h2 class="mt-4 text-2xl font-bold text-center text-gray-900 leading-9">
                    Create a new account
                </h2>

                <p class="mt-1 text-sm text-center text-gray-700 leading-5 max-w">
                    Or
                    {{-- Kita ganti style link-nya --}}
                    <a href="{{ route('login') }}" class="font-medium text-blue-700 hover:text-blue-900 underline focus:outline-none transition ease-in-out duration-150">
                        sign in to your account
                    </a>
                </p>
            </div>

            {{-- Bagian Form dari Kode Asli Anda --}}
            <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md">
                {{-- Kita HILANGKAN style 'bg-white shadow rounded' dari form asli --}}
                <div class="px-0 py-0">
                    <form wire:submit.prevent="register">
                        <div>
                            {{-- Label (Dibuat bold) --}}
                            <label for="name" class="block text-sm font-bold text-gray-700 leading-5">
                                Name
                            </label>

                            {{-- Input (Diubah ke style 3D inset) --}}
                            <div class="mt-1">
                                <input wire:model.lazy="name" id="name" type="text" required autofocus 
                                       class="block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100
                                              @error('name') border-red-500 border-2 @enderror" />
                            </div>

                            @error('name')
                                <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block text-sm font-bold text-gray-700 leading-5">
                                Email address
                            </label>

                            <div class="mt-1">
                                <input wire:model.lazy="email" id="email" type="email" required 
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

                        <div class="mt-4">
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 leading-5">
                                Confirm Password
                            </label>

                            <div class="mt-1">
                                <input wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password" required 
                                       class="block w-full px-3 py-1.5 bg-white text-gray-900 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white focus:outline-none focus:bg-gray-100" />
                            </div>
                        </div>

                        <div class="mt-6">
                            {{-- Tombol (Diubah ke style 3D button) --}}
                            <span class="block w-full">
                                <button type="submit" 
                                        class="flex justify-center w-full px-4 py-2 text-sm font-bold text-gray-900 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-sm active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200 transition duration-150 ease-in-out">
                                    Register
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

        </div> {{-- End WINDOW FRAME --}}
    </div> {{-- End KONTEN UTAMA --}}
</div> {{-- End CONTAINER UTAMA --}}