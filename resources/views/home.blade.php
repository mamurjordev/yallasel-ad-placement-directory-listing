@extends('bapp')

@section('content')
    {{-- Hero Main --}}
    <section class="bg-hero-bg bg-center w-screen scale-100"
        style="transform: scaleX({{ !App::isLocale('ar') ?: '-1' }})">
        <div class="container mx-auto py-10 px-2" style="transform: scaleX({{ !App::isLocale('ar') ?: '-1' }})">
            <form action="" class="bg-white p-5 w-full md:w-max text-gray-700">
                <h2 class="text-3xl font-black">{{ __('Welcome to Yallasell') }}</h2>
                <label for="search" class="font-bold">{{ __('Search') }}</label>
                <div class="block rounded-sm border border-solid w-full border-gray-400 mb-2 mt-1">
                    <i class="fas fa-search absolute pt-3 px-3 min-w-max"></i>
                    <input id="search" type="text" class="px-10 w-full border-none focus:ring-transparent"
                        placeholder="{{ __('What are you looking for?') }}">
                </div>
                <label for="location" class="font-bold">{{ __('choose location') }}</label>
                <div class="block rounded-sm border border-solid w-full border-gray-400 mb-2 mt-1">
                    <i class="fas fa-map-marker-alt absolute pt-3 px-3 min-w-max"></i>
                    <select name="" id="location" class="px-10 w-full border-none focus:ring-transparent">
                        <option value="" class="">{{ __('whole arab') }}</option>
                        <option value="" class="">{{ __('mecca') }}</option>
                        <option value="" class="">{{ __('medina') }}</option>
                    </select>
                </div>
                <button type="submit"
                    class="bg-btn text-white font-semibold text-lg w-full py-2 mt-5 rounded-md">{{ __('find ads') }}</button>
            </form>
        </div>
    </section>

    {{-- Categories --}}
    <section class="container mx-auto text-gray-700 px-2">
        <div class="grid grid-cols-2">
            <h4 class="text-2xl font-bold mt-5 mb-3">{{ __('Discover our categories') }}</h4>
            <a href="#!" class="text-end pt-8 text-sm">{{ __('All categories') }} <i class="fas fa-chevron-right text-xs"
                    style="{{ !App::isLocale('ar') ?: 'transform: scaleX(-1)' }}"></i></a>
        </div>
        <div class="md:flex md:justify-between uppercase">
            <a href="/{{ app()->getLocale() . '/category' }}" class="place-self-center text-center inline-block">
                <div class="overflow-x-auto">
                    <div class="uppercase space-s-4 inline-flex justify-between h-max py-6">
                        <a href="/{{ app()->getLocale() . '/category' }}" class=" text-center w-20">
                            <div
                                class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto w-14 h-14 pt-3">
                                <img src="{{ asset('media/site/job.svg') }}" alt="" class="h-8 w-8 mx-auto">
                            </div>
                            <p class="text-sm font-thin mt-1">{{ __('job') }}</p>
                        </a>
                        <a href="/{{ app()->getLocale() . '/category' }}" class="text-center w-20">
                            <div
                                class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto w-14 h-14 pt-3">
                                <img src="{{ asset('media/site/car.svg') }}" alt="" class="h-8 w-8 mx-auto">
                            </div>
                            <p class="text-sm font-thin mt-1">{{ __('car') }}</p>
                        </a>
                        <a href="/{{ app()->getLocale() . '/category' }}" class="text-center w-20">
                            <div
                                class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto w-14 h-14 pt-3">
                                <img src="{{ asset('media/site/furniture.svg') }}" alt="" class="h-8 w-8 mx-auto">
                            </div>
                            <p class="text-sm font-thin mt-1">{{ __('furniture') }}</p>
                        </a>
                        <a href="/{{ app()->getLocale() . '/category' }}" class="text-center w-20">
                            <div class="relative">
                                <div class="absolute rounded-full bg-btn py-1 px-2 text-xs text-white -top-3 -right-3 z-30">
                                    {{ __('new') }}</div>
                                <div
                                    class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto w-14 h-14 pt-3">
                                    <img src="{{ asset('media/site/book.svg') }}" alt="" class="h-14 w-14 mx-auto">
                                </div>
                            </div>
                            <p class="text-sm font-thin mt-1">{{ __('book') }}</p>
                        </a>
                        <a href="/{{ app()->getLocale() . '/category' }}" class="text-center w-20">
                            <img src="{{ asset('media/site/cloth.svg') }}" alt=""
                                class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto">
                            <p class="text-sm font-thin mt-1">{{ __('cloth') }}</p>
                        </a>
                        <a href="/{{ app()->getLocale() . '/category' }}" class="text-center w-20">
                            <div
                                class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto w-14 h-14 pt-3">
                                <img src="{{ asset('media/site/house.svg') }}" alt="" class="h-8 w-8 mx-auto">
                            </div>
                            <p class="text-sm font-thin mt-1">{{ __('house') }}</p>
                        </a>
                        <a href="/{{ app()->getLocale() . '/category' }}" class="text-center w-20">
                            <img src="{{ asset('media/site/electronic.svg') }}" alt=""
                                class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto">
                            <p class="text-sm font-thin mt-1">{{ __('electronic') }}</p>
                        </a>
                        <a href="/{{ app()->getLocale() . '/category' }}" class="text-center w-20">
                            <img src="{{ asset('media/site/hobby.svg') }}" alt=""
                                class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto">
                            <p class="text-sm font-thin mt-1">{{ __('hobby') }}</p>
                        </a>
                        <a href="/{{ app()->getLocale() . '/category' }}" class="text-center w-20">
                            <img src="{{ asset('media/site/business.svg') }}" alt=""
                                class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto">
                            <p class="text-sm font-thin mt-1">{{ __('business') }}</p>
                        </a>
                        <a href="/{{ app()->getLocale() . '/category' }}" class="text-center w-20">
                            <img src="{{ asset('media/site/others.svg') }}" alt=""
                                class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto">
                            <p class="text-sm font-thin mt-1">{{ __('others') }}</p>
                        </a>
                    </div>
                </div>
    </section>

    {{-- current on the Yallasell --}}
    <section class="container mx-auto text-gray-600 mt-10 px-2">
        <div class="grid grid-cols-2 mb-2">
            <h2 class="text-2xl font-medium">{{ __('Currently on the Yallasell') }}</h2>
            <a href="#!" class="text-end text-sm font-light">{{ __('More inspiration') }} <i
                    class="fas fa-chevron-right text-xs"
                    style="{{ !App::isLocale('ar') ?: 'transform: scaleX(-1)' }}"></i></a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="#!" class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden">
                <img src="{{ asset('media/blog/Pulka.jpg') }}" alt="" class="w-full">
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">{{ __('Slut på pulkor nära dig') }}</h3>
                <p class="px-2 pb-4">
                    {{ __('Nu finns hundratals pulkor, snowracers och vinterleksaker på Blocket. In och finn!') }}</p>
            </a>
            <a href="#!" class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden">
                <img src="{{ asset('media/blog/Salj_nytt_och_begagnat.jpg') }}" alt="" class="w-full">
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">{{ __('Bli proffs på') }}</h3>
                <p class="px-2 pb-4">
                    {{ __('Det finns en del tips och tricks för att skapa den bästa annonsen och öka chansen till') }}
                </p>
            </a>
            <a href="#!" class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden">
                <img src="{{ asset('media/blog/Pulka.jpg') }}" alt="" class="w-full">
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">{{ __('pulkor nära dig') }}</h3>
                <p class="px-2 pb-4">{{ __('Nu finns hundratals pulkor, snowracers och vinterleksaker på Blocket.') }}
                </p>
            </a>
        </div>
    </section>

    {{-- Advert 1 --}}
    <section class="container mx-auto my-6 px-2">
        <img src="{{ asset('media/advert/advert1.jpg') }}" alt="" class="w-full">
    </section>

    {{-- Find easier --}}
    <section class="container mx-auto text-gray-600 mt-8 px-2">
        <div class="grid grid-cols-2 mb-2">
            <h2 class="text-2xl font-medium">{{ __('Find easier') }}</h2>
            <a href="#!" class="text-end text-sm">{{ __('More') }} <i class="fas fa-chevron-right text-xs"
                    style="{{ !App::isLocale('ar') ?: 'transform: scaleX(-1)' }}"></i></a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="#!" class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden">
                <img src="{{ asset('media/blog/img2.jpg') }}" alt="" class="h-56 md:h-28 w-full">
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">{{ __('Utvalt mode') }}</h3>
                <p class="px-2 pb-4">{{ __('Hitta modeplagg från kända designers.') }}</p>
            </a>
            <a href="#!" class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden">
                <img src="{{ asset('media/blog/img3.jpg') }}" alt="" class="h-56 md:h-28 w-full">
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">{{ __('Utvalda designers') }}</h3>
                <p class="px-2 pb-4">{{ __('Här hittar du designmöbler med superbra priser.') }}</p>
            </a>
            <a href="#!" class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden">
                <img src="{{ asset('media/blog/img4.jpg') }}" alt="" class="h-56 md:h-28 w-full">
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">{{ __('Utvalt mode') }}</h3>
                <p class="px-2 pb-4">{{ __('Hitta modeplagg från kända designers.') }}</p>
            </a>
            <a href="#!" class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden">
                <img src="{{ asset('media/blog/img5.png') }}" alt="" class="h-56 md:h-28 w-full">
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">{{ __('Utvalda design') }}</h3>
                <p class="px-2 pb-4">{{ __('Här hittar du designmöbler med superbra priser.') }}</p>
            </a>
        </div>
    </section>

    {{-- More block --}}
    <section class="container mx-auto text-gray-600 mt-8 px-2">
        <h2 class="text-2xl font-medium mb-2">{{ __('More Yallasell') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="#!" class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden">
                <img src="{{ asset('media/blog/Pulka.jpg') }}" alt="" class="w-full">
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">{{ __('Slut på pulkor nära dig') }}</h3>
                <p class="px-2 pb-4">
                    {{ __('Nu finns hundratals pulkor, snowracers och vinterleksaker på Blocket. In och finn!') }}</p>
            </a>
            <a href="#!" class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden">
                <img src="{{ asset('media/blog/Salj_nytt_och_begagnat.jpg') }}" alt="" class="w-full">
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">{{ __('Bli proffs på') }}</h3>
                <p class="px-2 pb-4">
                    {{ __('Det finns en del tips och tricks för att skapa den bästa annonsen och öka chansen till') }}
                </p>
            </a>
            <a href="#!" class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden">
                <img src="{{ asset('media/blog/Pulka.jpg') }}" alt="" class="w-full">
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">{{ __('pulkor nära dig') }}</h3>
                <p class="px-2 pb-4">{{ __('Nu finns hundratals pulkor, snowracers och vinterleksaker på Blocket.') }}
                </p>
            </a>
        </div>
    </section>

    {{-- Footer top --}}
    <section class="container mx-auto mt-8 mb-10 text-gray-600 px-5">
        <h3 class="text-2xl font-medium mb-1">{{ __('Quick links') }}</h3>
        <div class="text-sm quick-link">
            <a href="#!" class="pr-2">{{ __('Smart TV') }}</a>
            <a href="#!" class="pr-2">{{ __('Hund') }}</a>
            <a href="#!" class="pr-2">{{ __('Skor') }}</a>
            <a href="#!" class="pr-2">{{ __('Klockor') }}</a>
            <a href="#!" class="pr-2">{{ __('Klanningar') }}</a>
            <a href="#!" class="pr-2">{{ __('Leksaker') }}</a>
            <a href="#!" class="pr-2">{{ __('TV bank') }}</a>
            <a href="#!" class="pr-2">{{ __('Barnvagn') }}</a>
            <a href="#!" class="pr-2">{{ __('Vaskor') }}</a>
            <a href="#!" class="pr-2">{{ __('Barnklader') }}</a>
            <a href="#!" class="pr-2">{{ __('Speciallistunderskoterska') }}</a>
            <a href="#!" class="pr-2">{{ __('Begagbade jkabder') }}</a>
            <a href="#!" class="pr-2">{{ __('Steeriliknker') }}</a>
        </div>
    </section>


    {{-- <div class="h-screen"></div> --}}
@endsection
