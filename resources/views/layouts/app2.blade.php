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
    @yield('css')

    <!-- Scripts -->
    {{-- @routes --}}
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
</head>


<body class="font-roboto antialiased overflow-x-hidden bg-gray-100" dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}">

    {{-- Header --}}
    <section class="border-b boder-solid border-gray-300 container md:mx-auto pt-3 pb-1 px-4">
        <img src="{{ asset('media/site/logo.svg') }}" alt="" class="">
    </section>

    <main class="">
        @yield('content')
    </main>
    {{-- Footer --}}
    <footer class="container mx-auto mt-6 px-5 mb-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-x-6 gap-y-2 text-gray-500 font-medium">
            <div class="">
                <h5 class="text-lg font-semibold text-gray-700">{{ __('Contact Us') }}</h5>
                <a href="#!" class="block pt-1">{{ __('Contact Us') }}</a>
                <a href="#!" class="block pt-2">{{ __('Store support') }}</a>
                <a href="#!" class="block pt-2">{{ __('Customer safety') }}</a>
                <a href="#!" class="block pt-2">{{ __('Sales tips') }}</a>
                <a href="#!" class="block pt-2">{{ __('Personal data management') }}</a>
                <a href="#!" class="block pt-2">{{ __('Cookie Policy') }}</a>
                <a href="#!" class="block pt-2">{{ __('Terms of use') }}</a>
                <a href="#!" class="block pt-2">{{ __('Report annoying advertising') }}</a>
            </div>
            <div class="">
                <h5 class="text-lg font-semibold text-gray-700 mt-1">{{ __('Business help') }}</h5>
                <a href="#!" class="block pt-2">{{ __('The Yallasell package') }}</a>
                <a href="#!" class="block pt-2">{{ __('Contract of sale') }}</a>
                <a href="#!" class="block pt-2">{{ __('Used insurance') }}</a>
                <a href="#!" class="block pt-2">{{ __('Pay for the Yallasell package') }}</a>
            </div>
            <div class="">
                <h5 class="text-lg font-semibold text-gray-700 mt-1">{{ __('Information') }}</h5>
                <a href="#!" class="block pt-2">{{ __('Inspiration') }}</a>
                <a href="#!" class="block pt-2">{{ __('About Yallasell') }}</a>
                <a href="#!" class="block pt-2">{{ __('Our sustainability work') }}</a>
                <a href="#!" class="block pt-2">{{ __('Press') }}</a>
                <a href="#!" class="block pt-2">{{ __('Join the user panel') }}</a>
                <a href="#!" class="block pt-2">{{ __('Work at Yallasell') }}</a>
                <a href="#!" class="block pt-2">{{ __('The Yallasell on Facebook') }}</a>
                <a href="#!" class="block pt-2">{{ __('Log in with SPiD') }}</a>
            </div>
            <div class="">
                <h5 class="text-lg font-semibold text-gray-700 mt-1">{{ __('Marketing') }}</h5>
                <a href="#!" class="block pt-2">{{ __('Advertising Web') }}</a>
                <a href="#!" class="block pt-2">{{ __('Open a store on Yallasell') }}</a>
                <a href="#!" class="block pt-2">{{ __('Show all store on Yallasell') }}</a>
                <a href="#!" class="block pt-2">{{ __('Login for stores') }}</a>
                <div class="flex space-s-5 text-lg">
                    <a href="" target="_blank" class=""><i class="fab fa-facebook-f"></i></a>
                    <a href="" target="_blank" class=""><i class="fab fa-twitter"></i></a>
                    <a href="" target="_blank" class=""><i class="fab fa-instagram"></i></a>
                    <a href="" target="_blank" class=""><i class="fab fa-youtube"></i></a>
                </div>
                <div class="flex justify-items-center space-s-4 mt-5 w-24">
                    <img src="{{ asset('media/site/apple.png') }}" alt="" class="">
                    <img src="{{ asset('media/site/google-play.png') }}" alt="" class="">
                </div>
            </div>
        </div>
    </footer>

    {{-- Fixed --}}
    <section class="py-2 fixed bottom-0 w-screen flex content-center z-50 end-0 mx-5 mb-2">
        <a href="#!"
            class="text-sm font-semibold ms-auto bg-bg2 text-text2 w-max px-5 rounded-full py-2 shadow-lg tracking-wide"><i class="far fa-question-circle text-lg pe-1"></i> {{ __('Support') }}</a>
    </section>

    {{-- @inertia --}}
    @yield('js')
</body>

</html>
