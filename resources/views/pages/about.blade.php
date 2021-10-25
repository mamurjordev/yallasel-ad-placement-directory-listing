@extends('app')

@section('content')

    {{-- Page Nav --}}
    <section class="hidden md:block bg-white border-b border-solid border-gray-300 mb-4">
        <div class="container mx-auto flex justify-between py-7">
            <div class="page-nav relative">
                <h4 class="text-xl text-gray-800 font-medium">{{ __('Our Services') }}</h4>
                {{-- Dropdown --}}
                <ul class="hidden absolute bg-white border border-solid border-gray-400 rounded w-64 text-gray-600">
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('All our services') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Post an ad on Yallasell') }}</a>
                    </li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Evaluate the car') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('The Yallasell Package') }}</a>
                    </li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Contract of sal') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Yallasell Payment') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Send with Premo') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Temporary number') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('The gallery') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!"
                            class="">{{ __('Sell the car to a car dealer') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Roadside assistance') }}</a>
                    </li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Used car insurance') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('The rental pakcage') }}</a></li>
                </ul>
            </div>
            <div class="page-nav relative">
                <h4 class="text-xl text-gray-800 font-medium">{{ __('Tips & Guides') }}</h4>
                {{-- Dropdown --}}
                <ul class="hidden absolute bg-white border border-solid border-gray-400 rounded w-64 text-gray-600">
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('Create the best ad') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('Child sizes') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('Gift Cards & Tickets') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('Sell and buy a car') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('Sell & Buy a boat') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('The bicycle guide') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('House & Apartment') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('Buy & Sell animals') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('The Electronics Guide') }}</a>
                    </li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('Sell Appliances') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('Search smart') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="" class="">{{ __('Tax rules') }}</a></li>
                </ul>
            </div>
            <div class="page-nav relative">
                <h4 class="text-xl text-gray-800 font-medium">{{ __('Inspiration') }}</h4>
                {{-- Dropdown --}}
                <ul class="hidden absolute bg-white border border-solid border-gray-400 rounded w-64 text-gray-600">
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Inspiration') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Shop used') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Private finances') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Children & Family') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Clear and sell') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('For the home') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Promotions') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Selected by Yallasell') }}</a>
                    </li>
                </ul>
            </div>
            <div class="page-nav relative">
                <h4 class="text-xl text-gray-800 font-medium">{{ __('For companies') }}</h4>
                {{-- Dropdown --}}
                <ul class="hidden absolute bg-white border border-solid border-gray-400 rounded w-64 text-gray-600">
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('For companies') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Open a shop') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Show all stores') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Marketing') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Login for stores') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Manage store ads') }}</a></li>
                </ul>
            </div>
            <div class="page-nav relative">
                <h4 class="text-xl text-gray-800 font-medium">{{ __('About Yallasell') }}</h4>
                {{-- Dropdown --}}
                <ul class="hidden absolute bg-white border border-solid border-gray-400 rounded w-64 text-gray-600">
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('About Yallasell') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Security safety') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Yallasell mobile app') }}</a>
                    </li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Work at Yallasell') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Press') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Contact us') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('What is Yallasell') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Social responsibility') }}</a>
                    </li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Cookies') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!"
                            class="">{{ __('Personal data management') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Terms of use') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!" class="">{{ __('Booking policy') }}</a></li>
                    <li class="hover:bg-gray-200 px-6 py-3"><a href="#!"
                            class="">{{ __('The Yallasell on social media') }}</a></li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Mobile Nav --}}
    <section class="container mx-auto md:hidden px-4 py-4">
        <i class="fas fa-bars text-3xl"></i>
    </section>


    {{-- Hero Image --}}
    <section class="md:h-120 overflow-hidden flex items-stretch">
        <img src="{{ asset('media/site/sofa_carry.jpg') }}" alt="" class="w-screen self-center">
    </section>

    {{-- About --}}
    <section class="container mx-auto text-center mt-10">
        <h1 class="text-3xl md:text-5xl font-bold">{{ __('About Yallasell') }}</h1>
        <p class="mt-4 px-5 md:px-0">
            {{ __('Welcome to Iraq\'s largest shopp+iung center! On these pages you can read more about our history, organization and how we work for increased used trade for people and the environment.') }}
        </p>
    </section>

    {{-- About Grid --}}
    <section class="container mx-auto mt-8 mb-14 grid grid-flow-row grid-cols-1 md:grid-cols-2 gap-4 px-4 md:px-0">
        <div class="">
            <img src="{{ asset('media/site/about1.jpg') }}" alt="" class="mb-4 h-72 w-full">
            <div class="">
                <a href="#!" class="hover:underline text-xl font-medium">{{ __('Security safety') }}</a>
                <p class="font-light mt-1">{{ __('At Blocket, it should be safe and secure to do business!') }}</p>
            </div>
        </div>
        <div class="">
            <img src="{{ asset('media/site/about2.jpg') }}" alt="" class="mb-4 h-72 w-full">
            <div class="">
                <a href="#!" class="hover:underline text-xl font-medium">{{ __('Contact Us') }}</a>
                <p class="font-light mt-1">{{ __('Contact us at Yallasell!') }}</p>
            </div>
        </div>
        <div class="">
            <img src="{{ asset('media/site/about3.jpg') }}" alt="" class="mb-4 h-72 w-full">
            <div class="">
                <a href="#!" class="hover:underline text-xl font-medium">{{ __('Social responsibility') }}</a>
                <p class="font-light mt-1">{{ __('Our contribution to a sustainable society.') }}</p>
            </div>
        </div>
        <div class="">
            <img src="{{ asset('media/site/about4.jpg') }}" alt="" class="mb-4 h-72 w-full">
            <div class="">
                <a href="#!" class="hover:underline text-xl font-medium">{{ __('Work at Yallasell') }}</a>
                <p class="font-light mt-1">{{ __('Take a look at our vacancies.') }}</p>
            </div>
        </div>
        <div class="">
            <img src="{{ asset('media/site/about5.jpg') }}" alt="" class="mb-4 h-72 w-full">
            <div class="">
                <a href="#!" class="hover:underline text-xl font-medium">{{ __('Press') }}</a>
                <p class="font-light mt-1">{{ __('Press contact for Iraq\'s largest buying and selling market') }}</p>
            </div>
        </div>
        <div class="">
            <img src="{{ asset('media/site/about6.jpg') }}" alt="" class="mb-4 h-72 w-full">
            <div class="">
                <a href="#!" class="hover:underline text-xl font-medium">{{ __('Yallasell mobile app') }}</a>
                <p class="font-light mt-1">{{ __('Buy and sell faster with Yellasell') }}</p>
            </div>
        </div>
        <div class="">
            <img src="{{ asset('media/site/about7.jpg') }}" alt="" class="mb-4 h-72 w-full">
            <div class="">
                <a href="#!" class="hover:underline text-xl font-medium">{{ __('What is Yallasell') }}</a>
                <p class="font-light mt-1">{{ __('Welcome to Iraq\'s largest shopping center!') }}</p>
            </div>
        </div>
    </section>

@endsection
