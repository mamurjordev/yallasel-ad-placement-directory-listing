<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    {{-- Owl carousel --}}
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')

    <!-- Scripts -->
    {{-- @routes --}}
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
</head>


<body class="font-roboto antialiased overflow-x-hidden bg-gray-100 min-h-full flex flex-col items-stretch"
    dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}">

    {{-- Top Nav --}}
    <section class="bg-gray-700">
        <div class="container mx-auto py-1 text-white px-10">
            @if (app()->getLocale() == 'ar')
                <a href="{{ url('/en') }}" class=""><i class="fas fa-language"></i> ENGLISH</a>
            @else
                <a href="{{ url('/ar') }}" class=""><i class="fas fa-language"></i> ARABIC</a>
            @endif
        </div>
    </section>

    <!-- Nav Bar -->
    <nav class="bg-white border-b border-solid border-gray-300">
        <div class="container mx-auto">
            <div class="flex items-center justify-between h-16 px-2">

                {{-- Start Menu --}}
                <div class=" flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="block lg:hidden h-8 w-auto"
                            src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                        <img class="hidden lg:block h-8 w-auto"
                            src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                            alt="Workflow">
                    </div>
                    {{-- Dropdown --}}
                    <div class="hidden md:block">
                        <button class="dropdown text-gray-600 ps-6 focus:outline-none">{{ __('Categories') }} <i
                                class="fas fa-chevron-down ps-1"></i>
                        </button>
                        {{-- Mega Menu Start --}}
                        <div class="overlay hidden fixed bg-white h-full w-screen start-0 top-24 z-50 bg-opacity-40">
                        </div>
                        <div
                            class="mega-menu shadow-md hidden absolute bg-white w-screen start-0 top-24 z-50 border-t border-solid border-gray-200">
                            <div
                                class="container mx-auto column-auto-4 gap-5 text-gray-700 leading-relaxed pb-3 px-3 pt-4">
                                <div class="grid">
                                    <a href="/{{ app()->getLocale() . '/category' }}"
                                        class="text-lg font-semibold hover:underline">{{ __('All ads on Yellasell') }}
                                        <i class="fas fa-angle-right text-xs text-gray-500"></i></a>
                                </div>
                                <div class="grid">
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="text-lg font-semibold hover:underline">{{ __('Vehicle') }} <i
                                            class="fas fa-angle-right text-xs text-gray-500"></i></a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Car parts & car accessories') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Boats') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Boat parts & accessories') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Caravans & mobile homes') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Mopeds & A-tractor') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Motorcycles') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}"
                                        class="hover:underline">{{ __('Motorcycles parts & accessories') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Truck, truck & construction') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}"
                                        class="hover:underline">{{ __('Forestry & agriculture machinery') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Snowmobiles') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}"
                                        class="hover:underline">{{ __('Snowmobile parts & accessories') }}</a>
                                </div>
                                <div class="grid">
                                    <a href="/{{ app()->getLocale() . '/category' }}"
                                        class="text-lg font-semibold hover:underline">{{ __('For the home') }} <i
                                            class="fas fa-angle-right text-xs text-gray-500"></i></a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Construction & garden') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Furniture & home decor') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Housewares & appliances') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Tool') }}</a>
                                </div>
                                <div class="grid">
                                    <a href="/{{ app()->getLocale() . '/category' }}"
                                        class="text-lg font-semibold hover:underline mt-3">{{ __('Personally') }}
                                        <i class="fas fa-angle-right text-xs text-gray-500"></i></a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Clothes shoes') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Accessories & wathces') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Children\'s clothes & shoes') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Children\'s items & toys') }}</a>
                                </div>
                                <div class="grid">
                                    <a href="/{{ app()->getLocale() . '/category' }}"
                                        class="text-lg font-semibold hover:underline">{{ __('Electronics') }} <i
                                            class="fas fa-angle-right text-xs text-gray-500"></i></a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Computer & Video games') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Sound & video') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Phones & accessories') }}</a>
                                </div>
                                <div class="grid">
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="text-lg font-semibold hover:underline  mt-3">
                                        {{ __('Sparetime Hobby') }}
                                        <i class="fas fa-angle-right text-xs text-gray-500"></i>
                                    </a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Experiences & fun') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Books & student literature') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Bicycles') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Animal') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Hobbies & collectibles') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Horses & equestrian') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Hunting & fishing') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Music equipment') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Sports & leisure equipment') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Business') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Business transfer') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Equipment & machines') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Premises & properties') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Services') }}</a>
                                </div>
                                <div class="grid">
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="text-lg font-semibold hover:underline">{{ __('Other') }}
                                        <i class="fas fa-angle-right text-xs text-gray-500"></i></a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Wanted') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="hover:underline">{{ __('Other') }}</a>
                                    <a href="/{{ app()->getLocale() . '/category' }}"
                                        class="text-lg font-semibold hover:underline mt-3">{{ __('Residence') }}
                                        <i class="fas fa-angle-right text-xs text-gray-500"></i></a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="text-lg font-semibold hover:underline">{{ __('Job') }}
                                        <i class="fas fa-angle-right text-xs text-gray-500"></i></a>
                                    <a href="/{{ app()->getLocale() . '/category' }}" class="text-lg font-semibold hover:underline">{{ __('Training') }}
                                        <i class="fas fa-angle-right text-xs text-gray-500"></i></a>
                                </div>
                            </div>
                        </div>
                        {{-- Mega Menu End --}}
                    </div>

                    {{-- Dropdown END --}}
                </div>

                {{-- End Menu --}}
                <div class="flex-1  right-0 flex justify-end pr-2 sm:static sm:inset-auto sm:pr-0">
                    <div class="pt-2 mr-8 hidden md:inline-block mb-3 me-5">
                        <a class="bg-bg2 text-white text-sm font-bold py-2 px-7 align-middle w-max rounded capitalize"
                            href="#!">
                            <i class="fas fa-plus-circle pe-2 text-base"></i> {{ __('place ad') }}
                        </a>
                    </div>
                    <div class="flex justify-evenly px-2">
                        <a href="#!" class="ps-5 md:inline-block text-center hover:underline">
                            <i class="fas fa-search"></i>
                            <p class="text-xs text-gray-600">{{ __('Adverts') }}</p>
                        </a>
                        <a href="#!" class="ps-5 md:inline-block text-center hover:underline">
                            <i class="far fa-comment-dots"></i>
                            <p class="text-xs text-gray-600">{{ __('Messages') }}</p>
                        </a>
                        <a href="#!" class="ps-5 md:inline-block text-center hover:underline">
                            <i class="far fa-heart"></i>
                            <p class="text-xs text-gray-600">{{ __('Saved') }}</p>
                        </a>
                        <a href="/{{ app()->getLocale() . '/log_in' }}"
                            class="ps-5 md:inline-block text-center hover:underline">
                            <i class="far fa-user-circle"></i>
                            <p class="text-xs text-gray-600">{{ __('Log in') }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="hidden sm:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#"
                    class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Team</a>
                <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Projects</a>
                <a href="#"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Calendar</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>
    {{-- @inertia --}}


    <div class="bg-footer-border w-screen h-3 flex-shrink-0"></div>
    {{-- Main footer --}}
    <footer class="container mx-auto mt-6 px-5 pb-14">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-2 text-gray-600 text-sm">
            <div class="">
                <h5 class="text-lg font-semibold">{{ __('Security') }}</h5>
                <a href="#!" class="block pt-1">{{ __('Customer safety') }}</a>
                <a href="#!" class="block pt-2">{{ __('The Yallasell Package') }}</a>
                <a href="#!" class="block pt-2">{{ __('Yallasell payment') }}</a>
                <a href="#!" class="block pt-2">{{ __('Fake mail') }}</a>
                <a href="#!" class="block pt-2">{{ __('Report annoying advertising') }}</a>
            </div>
            <div class="">
                <h5 class="text-lg font-semibold">{{ __('Terms') }}</h5>
                <a href="#!" class="block pt-1">{{ __('Terms of use') }}</a>
                <a href="#!" class="block pt-2">{{ __('Personal data management') }}</a>
                <a href="#!" class="block pt-2">{{ __('Cookies') }}</a>
            </div>
            <div class="">
                <h5 class="text-lg font-semibold">{{ __('For companies') }}</h5>
                <a href="#!" class="block pt-1">{{ __('For companies') }}</a>
                <a href="#!" class="block pt-2">{{ __('Open a shop') }}</a>
                <a href="#!" class="block pt-2">{{ __('Show all stores') }}</a>
                <a href="#!" class="block pt-2">{{ __('Marketing') }}</a>
                <a href="#!" class="block pt-2">{{ __('Login for store') }}</a>
                <a href="#!" class="block pt-2">{{ __('Manage store ads') }}</a>
            </div>
            <div class="">
                <h5 class="text-lg font-semibold">{{ __('The Yallasell') }}</h5>
                <a href="#!" class="block pt-1">{{ __('About Yallasell') }}</a>
                <a href="#!" class="block pt-2">{{ __('Press') }}</a>
                <a href="#!" class="block pt-2">{{ __('Work at Yallasell') }}</a>
                <a href="/{{ app()->getLocale() . '/contact' }}" class="block pt-2">{{ __('Contact Us') }}</a>
                <a href="#!" class="block pt-2">{{ __('Inspiration') }}</a>
            </div>
        </div>
        <div class="flex justify-items-center justify-center space-s-4 mt-5">
            <img src="{{ asset('media/site/apple.png') }}" alt="" class="">
            <img src="{{ asset('media/site/google-play.png') }}" alt="" class="">
        </div>
    </footer>

    {{-- Footer bottom --}}
    <section class="bg-red-50">
        <div class="container mx-auto flex justify-between text-xs font-thin mt-2 mb-2 px-3">
            <p class="text-lg font-medium w-20 me-6">Yallasell</p>
            <p class="pt-2">{{ __('copyright © Yallasell 2021. All right reserved.') }}</p>
        </div>
    </section>

    {{-- Mobile Footer --}}
    <section class="md:hidden py-2 fixed bottom-0 w-screen flex content-center z-50">
        <a href="#!"
            class="text-lg font-semibold mx-auto uppercase bg-green-500 text-white w-max px-5 rounded-md py-1 shadow-lg">{{ __('place ad') }}</a>
    </section>

    {{-- <div class="h-screen"></div> --}}




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"
        integrity="sha512-CwHUCK55pONjDxvPZQeuwKpxos8mPyEv9gGuWC8Vr0357J2uXg1PycGDPND9EgdokSFTG6kgSApoDj9OM22ksw=="
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    @yield('js')
</body>

</html>
