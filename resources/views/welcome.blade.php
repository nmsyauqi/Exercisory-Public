@extends('layouts.app')


@section('content')






        {{-- Logo (Bisa diganti ikon proyek Anda, tapi kita pertahankan Laravel logo dari template) --}}
        <div class="flex justify-center">
            <svg class="w-auto h-16 text-blue-600" viewBox="0 0 62 65" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.8913C25.0426 63.9354 24.8666 63.9354 24.6991 63.8913C24.6716 63.8838 24.6467 63.8689 24.6205 63.8589C24.5657 63.8389 24.5084 63.8215 24.456 63.7916L0.501061 49.9987C0.348882 49.9113 0.222437 49.7853 0.134469 49.6334C0.0465019 49.4816 0.000120578 49.3092 0 49.1337L0 8.10652C0 8.01678 0.0124642 7.92953 0.0348998 7.84477C0.0423783 7.8161 0.0598282 7.78993 0.0697995 7.76126C0.0884958 7.70891 0.105946 7.65531 0.133367 7.6067C0.152063 7.5743 0.179485 7.54812 0.20192 7.51821C0.230588 7.47832 0.256763 7.43719 0.290416 7.40229C0.319084 7.37362 0.356476 7.35243 0.388883 7.32751C0.425029 7.29759 0.457436 7.26518 0.498568 7.2415L12.4779 0.345059C12.6296 0.257786 12.8015 0.211853 12.9765 0.211853C13.1515 0.211853 13.3234 0.257786 13.475 0.345059L25.4531 7.2415H25.4556C25.4955 7.26643 25.5292 7.29759 25.5653 7.32626C25.5977 7.35119 25.6339 7.37362 25.6625 7.40104C25.6974 7.43719 25.7224 7.47832 25.7523 7.51821C25.7735 7.54812 25.8021 7.5743 25.8196 7.6067C25.8483 7.65656 25.8645 7.70891 25.8844 7.76126C25.8944 7.78993 25.9118 7.8161 25.9193 7.84602C25.9423 7.93096 25.954 8.01853 25.9542 8.10652V33.7317L35.9355 27.9844V14.8846C35.9355 14.7973 35.948 14.7088 35.9704 14.6253C35.9792 14.5954 35.9954 14.5692 36.0053 14.5405C36.0253 14.4882 36.0427 14.4346 36.0702 14.386C36.0888 14.3536 36.1163 14.3274 36.1375 14.2975C36.1674 14.2576 36.1923 14.2165 36.2272 14.1816C36.2559 14.1529 36.292 14.1317 36.3244 14.1068C36.3618 14.0769 36.3942 14.0445 36.4341 14.0208L48.4147 7.12434C48.5663 7.03694 48.7383 6.99094 48.9133 6.99094C49.0883 6.99094 49.2602 7.03694 49.4118 7.12434L61.3899 14.0208C61.4323 14.0457 61.4647 14.0769 61.5021 14.1055C61.5333 14.1305 61.5694 14.1529 61.5981 14.1803C61.633 14.2165 61.6579 14.2576 61.6878 14.2975C61.7103 14.3274 61.7377 14.3536 61.7551 14.386C61.7838 14.4346 61.8 14.4882 61.8199 14.5405C61.8312 14.5692 61.8474 14.5954 61.8548 14.6253ZM59.893 27.9844V16.6121L55.7013 19.0252L49.9104 22.3593V33.7317L59.8942 27.9844H59.893ZM47.9149 48.5566V37.1768L42.2187 40.4299L25.953 49.7133V61.2003L47.9149 48.5566ZM1.99677 9.83281V48.5566L23.9562 61.199V49.7145L12.4841 43.2219L12.4804 43.2194L12.4754 43.2169C12.4368 43.1945 12.4044 43.1621 12.3682 43.1347C12.3371 43.1097 12.3009 43.0898 12.2735 43.0624L12.271 43.0586C12.2386 43.0275 12.2162 42.9888 12.1887 42.9539C12.1638 42.9203 12.1339 42.8916 12.114 42.8567L12.1127 42.853C12.0903 42.8156 12.0766 42.7707 12.0604 42.7283C12.0442 42.6909 12.023 42.656 12.013 42.6161C12.0005 42.5688 11.998 42.5177 11.9931 42.4691C11.9881 42.4317 11.9781 42.3943 11.9781 42.3569V15.5801L6.18848 12.2446L1.99677 9.83281ZM12.9777 2.36177L2.99764 8.10652L12.9752 13.8513L22.9541 8.10527L12.9752 2.36177H12.9777ZM18.1678 38.2138L23.9574 34.8809V9.83281L19.7657 12.2459L13.9749 15.5801V40.6281L18.1678 38.2138ZM48.9133 9.14105L38.9344 14.8858L48.9133 20.6305L58.8909 14.8846L48.9133 9.14105ZM47.9149 22.3593L42.124 19.0252L37.9323 16.6121V27.9844L43.7219 31.3174L47.9149 33.7317V22.3593ZM24.9533 47.987L39.59 39.631L46.9065 35.4555L36.9352 29.7145L25.4544 36.3242L14.9907 42.3482L24.9533 47.987Z"
                    fill="currentColor" />
            </svg>
        </div>


        {{-- KARTU KONTEN (Diubah untuk Proyek Gamifikasi) --}}
        <div class="mt-16">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">


                {{-- CARD 1: Tentang Proyek --}}
                <a href="https://www.portofolio.politeknikidn.id/detail/exercisory/undQZgjcOS" target="_blank"
                    class="scale-100 p-6 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-[2px_2px_0_0_#000000] flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-700 active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                    <div>
                        <div>
                            <div
                                class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-400 border-t border-l border-white border-r border-b border-gray-500">
                                {{-- Ganti Ikon --}}
                                <svg class="text-blue-700 fill-current w-7 h-7" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <h2 class="mt-6 text-xl font-bold text-gray-900">Tentang Proyek</h2>

                            <p class="mt-4 text-sm leading-relaxed text-gray-700">
                                Sistem Gamifikasi Kepatuhan Kesehatan untuk membantu Anda mencapai target kesehatan harian
                                dengan cara
                                yang seru.
                            </p>
                        </div>
                    </div>
                </a>

                {{-- CARD 4: Teknologi --}}
                <a href="https://laravel.com/docs" target="_blank"
                    class="scale-100 p-6 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-[2px_2px_0_0_#000000] flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-700 active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                    <div>
                        <div
                            class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-400 border-t border-l border-white border-r border-b border-gray-500">
                            {{-- Ikon Livewire dari template asli --}}
                            <svg class="text-blue-700 translate-x-px translate-y-px fill-current w-7 h-7"
                                viewBox="0 0 40 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M37.47 29.484c-.717 1.084-1.262 2.42-2.72 2.42-2.455 0-2.588-3.784-5.044-3.784-2.456 0-2.323 3.785-4.777 3.785-2.455 0-2.588-3.785-5.043-3.785-2.456 0-2.324 3.785-4.778 3.785-2.455 0-2.587-3.785-5.043-3.785s-2.323 3.785-4.778 3.785c-.771 0-1.313-.374-1.77-.887C1.76 27.962.75 24.38.75 20.55.75 9.34 9.41.25 20.095.25c10.683 0 19.344 9.089 19.344 20.3 0 3.206-.708 6.238-1.969 8.934Z"
                                    fill="currentColor" />
                                <mask id="a-livewire" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="6" y="23"
                                    width="27" height="22">
                                    <path
                                        d="M12.37 27.48v8.408a2.732 2.732 0 0 1-5.465 0v-10.15c.51-.937 1.093-1.747 2.143-1.747 1.71 0 2.307 2.148 3.321 3.489Zm10.32.438v13.296a3.036 3.036 0 0 1-6.07 0V26.165c.57-1.102 1.16-2.174 2.368-2.174 1.912 0 2.433 2.687 3.703 3.927Zm9.715-.244v9.653a2.732 2.732 0 1 1-5.465 0V25.462c.476-.814 1.043-1.471 1.988-1.471 1.795 0 2.364 2.367 3.477 3.683Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#a-livewire)">
                                    <path
                                        d="M12.37 27.48v8.408a2.732 2.732 0 0 1-5.465 0v-10.15c.51-.937 1.093-1.747 2.143-1.747 1.71 0 2.307 2.148 3.321 3.489Zm10.32.438v13.296a3.036 3.036 0 0 1-6.07 0V26.165c.57-1.102 1.16-2.174 2.368-2.174 1.912 0 2.433 2.687 3.703 3.927Zm9.715-.244v9.653a2.732 2.732 0 1 1-5.465 0V25.462c.476-.814 1.043-1.471 1.988-1.471 1.795 0 2.364 2.367 3.477 3.683Z"
                                        fill="currentColor" />
                                </g>
                                <mask id="b-livewire" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="6" y="19"
                                    width="27" height="14">
                                    <path
                                        d="M12.37 30.057c-.485-.594-1.059-1.034-1.889-1.034-1.97 0-2.332 2.483-3.576 3.602v-10.71a2.732 2.732 0 1 1 5.464 0v8.142Zm10.32.191c-.516-.687-1.12-1.225-2.037-1.225-2.192 0-2.393 3.073-4.034 3.923V28.21a3.036 3.036 0 0 1 6.072 0v2.038Zm9.715-.531c-.42-.414-.92-.694-1.58-.694-2.124 0-2.38 2.884-3.884 3.837v-9.613a2.732 2.732 0 1 1 5.464 0v6.47Z"
                                        fill="white" />
                                </mask>
                                <g mask="url(#b-livewire)">
                                    <path
                                        d="M12.37 30.057c-.485-.594-1.059-1.034-1.889-1.034-1.97 0-2.332 2.483-3.576 3.602v-10.71a2.732 2.732 0 1 1 5.464 0v8.142Zm10.32.191c-.516-.687-1.12-1.225-2.037-1.225-2.192 0-2.393 3.073-4.034 3.923V28.21a3.036 3.036 0 0 1 6.072 0v2.038Zm9.715-.531c-.42-.414-.92-.694-1.58-.694-2.124 0-2.38 2.884-3.884 3.837v-9.613a2.732 2.732 0 1 1 5.464 0v6.47Z"
                                        fill="black" fill-opacity="0.298514" />
                                </g>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M37.47 29.484c-.717 1.084-1.262 2.42-2.72 2.42-2.455 0-2.588-3.784-5.044-3.784-2.456 0-2.323 3.785-4.777 3.785-2.455 0-2.588-3.785-5.043-3.785-2.456 0-2.324 3.785-4.778 3.785-2.455 0-2.587-3.785-5.043-3.785s-2.323 3.785-4.778 3.785c-.771 0-1.313-.374-1.77-.887C1.76 27.962.75 24.38.75 20.55.75 9.34 9.41.25 20.095.25c10.683 0 19.344 9.089 19.344 20.3 0 3.206-.708 6.238-1.969 8.934Z"
                                    fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M33.284 31.5c5.07-7.541 5.2-15.906.393-25.095a20.248 20.248 0 0 1 5.762 14.188c0 3.194-.734 6.214-2.04 8.9-.744 1.08-1.31 2.412-2.821 2.412-.517 0-.935-.156-1.294-.405Z"
                                    fill="black" fill-opacity="0.15" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19.057 25.614c6.728 0 9.56-3.902 9.56-9.445 0-5.542-4.28-10.643-9.56-10.643s-9.56 5.101-9.56 10.643c0 5.543 2.833 9.445 9.56 9.445Z"
                                    fill="white" />
                                <path
                                    d="M16.487 16.483c1.98 0 3.585-1.771 3.585-3.957 0-2.185-1.605-3.956-3.585-3.956s-3.585 1.771-3.585 3.956c0 2.186 1.605 3.957 3.585 3.957Z"
                                    fill="currentColor" />
                                <path
                                    d="M15.89 13.44c.99 0 1.792-.818 1.792-1.827 0-1.008-.802-1.826-1.792-1.826s-1.793.818-1.793 1.827c0 1.009.803 1.827 1.793 1.827Z"
                                    fill="white" />
                            </svg>
                        </div>

                        <h2 class="mt-6 text-xl font-bold text-gray-900">Teknologi</h2>

                        <p class="mt-4 text-sm leading-relaxed text-gray-700">
                            Dibangun menggunakan Laravel, Livewire, dan Tailwind CSS untuk antarmuka yang reaktif dan
                            modern.
                        </p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        class="self-center w-6 h-6 mx-6 shrink-0 stroke-blue-700">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </a>

                @guest {{-- TAMPILKAN INI HANYA JIKA PENGGUNA BELUM LOGIN --}}

                    {{-- CARD 2: Daftar Akun Baru --}}
                    <a href="{{ route('register') }}"
                        class="scale-100 p-6 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-[2px_2px_0_0_#000000] flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-700 active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        <div>
                            <div
                                class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-400 border-t border-l border-white border-r border-b border-gray-500">
                                <svg class="text-blue-700 fill-current w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </div>
                            <h2 class="mt-6 text-xl font-bold text-gray-900">Daftar</h2>
                            <p class="mt-4 text-sm leading-relaxed text-gray-700">
                                Mulai perjalanan Anda! Daftar untuk melacak progres dan kumpulkan poin harian.
                            </p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            class="self-center w-6 h-6 mx-6 shrink-0 stroke-blue-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                        </svg>
                    </a>

                    {{-- CARD 3: Masuk / Login --}}
                    <a href="{{ route('login') }}"
                        class="scale-100 p-6 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-[2px_2px_0_0_#000000] flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-700 active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        <div>
                            <div
                                class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-400 border-t border-l border-white border-r border-b border-gray-500">
                                <svg class="text-blue-700 fill-current w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                </svg>
                            </div>
                            <h2 class="mt-6 text-xl font-bold text-gray-900">Masuk</h2>
                            <p class="mt-4 text-sm leading-relaxed text-gray-700">
                                Sudah punya akun? Masuk untuk melanjutkan misi harian Anda dan melihat papan peringkat.
                            </p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            class="self-center w-6 h-6 mx-6 shrink-0 stroke-blue-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                        </svg>
                    </a>

                @endguest

                @auth {{-- TAMPILKAN INI HANYA JIKA PENGGUNA SUDAH LOGIN --}}

                    {{-- KARTU PENGGANTI REGISTER -> LEADERBOARD --}}
                    <a href="{{ route('leaderboard') }}"
                        class="scale-100 p-6 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-[2px_2px_0_0_#000000] flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-700 active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                        <div>
                            <div
                                class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-400 border-t border-l border-white border-r border-b border-gray-500">
                                <svg class="text-blue-700 fill-current w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-4.5A3 3 0 0012 9.75h0A3 3 0 007.5 14.25v4.5m9 0v-4.5m0 4.5a3 3 0 01-3 3h-3a3 3 0 01-3-3m0 0v-4.5A3 3 0 0112 9.75h0A3 3 0 0116.5 14.25v4.5m-9-3.75h9" />
                                </svg>
                            </div>
                            <h2 class="mt-6 text-xl font-bold text-gray-900">Papan Peringkat</h2>
                            <p class="mt-4 text-sm leading-relaxed text-gray-700">
                                Lihat 10 peserta dengan skor tertinggi di server.
                            </p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            class="self-center w-6 h-6 mx-6 shrink-0 stroke-blue-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                        </svg>
                    </a>

                    {{-- KARTU PENGGANTI LOGIN -> ROLE-BASED DASHBOARD --}}
                    @if (strtolower(Auth::user()->role) === 'admin')
                        {{-- CARD UNTUK ADMIN --}}
                        <a href="{{ route('admin.tasks') }}"
                            class="scale-100 p-6 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-[2px_2px_0_0_#000000] flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-700 active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                            <div>
                                <div
                                    class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-400 border-t border-l border-white border-r border-b border-gray-500">
                                    <svg class="text-blue-700 fill-current w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                    </svg>
                                </div>
                                <h2 class="mt-6 text-xl font-bold text-gray-900">Dasbor Admin</h2>
                                <p class="mt-4 text-sm leading-relaxed text-gray-700">
                                    Buka halaman manajemen tugas dan lihat statistik kepatuhan.
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                class="self-center w-6 h-6 mx-6 shrink-0 stroke-blue-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </a>
                    @else
                        {{-- CARD UNTUK PARTICIPANT (DEFAULT) --}}
                        <a href="{{ route('checklist') }}"
                            class="scale-100 p-6 bg-gray-300 border-t-2 border-l-2 border-white border-r-2 border-b-2 border-gray-600 shadow-[2px_2px_0_0_#000000] flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-700 active:border-r-2 active:border-b-2 active:border-white active:border-t-2 active:border-l-2 active:shadow-inner active:bg-gray-200">
                            <div>
                                <div
                                    class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-400 border-t border-l border-white border-r border-b border-gray-500">
                                    <svg class="text-blue-700 fill-current w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h2 class="mt-6 text-xl font-bold text-gray-900">Ceklis Harian</h2>
                                <p class="mt-4 text-sm leading-relaxed text-gray-700">
                                    Lanjutkan misi harian Anda dan kumpulkan poin.
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                class="self-center w-6 h-6 mx-6 shrink-0 stroke-blue-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </a>

                    @endif
                @endauth


            </div>
        </div>

        {{-- FOOTER / STATUS BAR --}}
        <div class="flex justify-between px-0 mt-16 sm:items-center sm:justify-between">
            <div class="text-sm text-center text-gray-700 sm:text-left">
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center group text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            class="w-5 h-5 mr-1 -mt-px stroke-gray-700" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Proyek Gamifikasi
                    </span>
                </div>
            </div>
            <div class="ml-4 text-sm text-center text-gray-700 sm:text-right sm:ml-0">
                STATUS: READY. Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div> {{-- End WINDOW FRAME --}}
@endsection