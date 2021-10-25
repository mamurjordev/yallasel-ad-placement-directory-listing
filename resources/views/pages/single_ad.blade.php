@extends('bapp')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
@endsection

@section('content')

    {{-- Breadcrumbs --}}
    <div class="breadcrumbs container mx-auto text-sm text-gray-600 font-light my-8">
        <a href="#!" class="hover:text-red-400 transition duration-200 ease-in-out">{{ __('Home') }} <i
                class="fas fa-chevron-right text-xs px-2"></i></a>
        <a href="#!" class="hover:text-red-400 transition duration-200 ease-in-out">{{ __('Vehicles') }} <i
                class="fas fa-chevron-right text-xs px-2"></i></a>
        <a href="#!" class="hover:text-red-400 transition duration-200 ease-in-out">{{ __('Cars') }} <i
                class="fas fa-chevron-right text-xs px-2"></i></a>
        <a href="#!" class="">Mercedes-Benz</a>
    </div>

    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 px-2">
            <div class="md:col-span-2">
                {{-- Item images --}}
                <div class="relative">
                    <div class="customPrevBtn absolute top-48 start-0 z-20 text-4xl opicity-10"><i
                            class="fas fa-chevron-circle-left"
                            style="{{ !App::isLocale('ar') ?: 'transform: scaleX(-1)' }}"></i></div>
                    {{-- Owl Carousel Start --}}
                    <div class="owl-carousel">
                        <div> <img src="{{ asset('media/product/car1.jpg') }}" alt="" class="w-full h-96"> </div>
                        <div> <img src="{{ asset('media/product/car2.jpg') }}" alt="" class="w-full h-96"> </div>
                    </div>
                    {{-- Owl Carousel End --}}
                    <div class="customNextBtn absolute top-48 end-0 z-20 text-4xl opicity-10"><i
                            class="fas fa-chevron-circle-right opicity-10"
                            style="{{ !App::isLocale('ar') ?: 'transform: scaleX(-1)' }}"></i></div>
                </div>
                {{-- Item info --}}
                <div class="grid grid-cols-2 text-sm text-gray-600 font-light">
                    <div class="">
                        <p class=""><i class="far fa-clock pe-2"></i> {{ __('Date') }}: 18 jan. 22:45</p>
                        <p class=""><i class="fas fa-map-marker-alt pe-2"></i> <a href="#!"
                                class="">{{ __('Iraq') }}</a>
                        </p>
                    </div>
                    <div class="">
                        <button
                            class="float-end border border-solid border-gray-500 rounded-sm px-5 text-lg font-medium text-gray-700"><i
                                class="far fa-heart"></i> {{ __('Save') }}</button>
                    </div>
                </div>
                <h2 class="text-4xl text-gray-800 font-black mt-5">Mercedes-Benz C 250 T CDI 4MATIC 7G-Tronic</h2>
                <div class="text-3xl text-green-500 font-bold mt-5">
                    150000 {{ __('IQD') }}
                    <span class="block md:inline-block text-sm text-gray-700 font-normal ps-6"><i
                            class="fas fa-check text-blue-500 text-base"></i> {{ __('Secure payment') }} <i
                            class="far fa-question-circle text-blue-500 text-bse"></i></span>
                </div>
                <div class="line-through text-gray-500 mt-5">15800 {{ __('IQD') }}</div>
                <a href="#!" class="text-gray-500 underline">{{ __('Calculate the cost at Lendo') }}</a>
                {{-- Car information --}}
                <section class="border-b border-t border-solid border-gray-400 mt-8">
                    <div class="text-2xl text-gray-700 font-semibold my-5">{{ __('Fact') }}</div>
                    <div class="grid grid-flow-row grid-cols-3 md:grid-cols-4 grid-rows-2 gap-4 text-gray-800">
                        <div class="flex justify-start">
                            <i class="fas fa-gas-pump text-4xl pt-2 me-4"></i>
                            <div class="">
                                <p class="text-gray-700 font-light">{{ __('Fuel') }}</p>
                                <p class="font-medium">{{ __('Diesel') }}</p>
                            </div>
                        </div>
                        <div class="flex justify-start">
                            <i class="fas fa-cogs text-2xl pt-2 me-4"></i>
                            <div class="">
                                <p class="text-gray-700 font-light">{{ __('Gearbox') }}</p>
                                <p class="font-medium">{{ __('Automatic') }}</p>
                            </div>
                        </div>
                        <div class="flex justify-start">
                            <i class="fas fa-digital-tachograph text-2xl pt-2 me-4"></i>
                            <div class="">
                                <p class="text-gray-700 font-light">{{ __('Mileage') }}</p>
                                <p class="font-medium">20 000 - 20 499</p>
                            </div>
                        </div>
                        <div class="flex justify-start">
                            <i class="far fa-calendar-alt text-2xl pt-2 me-4"></i>
                            <div class="">
                                <p class="text-gray-700 font-light">{{ __('Model year') }}</p>
                                <p class="font-medium">2013</p>
                            </div>
                        </div>
                        <div class="flex justify-start">
                            <i class="fas fa-car text-2xl pt-2 me-4"></i>
                            <div class="">
                                <p class="text-gray-700 font-light">{{ __('Car type') }}</p>
                                <p class="font-medium">Sedan</p>
                            </div>
                        </div>
                        <div class="flex justify-start">
                            <i class="fas fa-dharmachakra text-2xl pt-2 me-4"></i>
                            <div class="">
                                <p class="text-gray-700 font-light">{{ __('Driving') }}</p>
                                <p class="font-medium">{{ __('Two-wheel drive') }}</p>
                            </div>
                        </div>
                        <div class="hidden md:flex justify-start">
                            <i class="fas fa-tachometer-alt text-2xl pt-2 me-4"></i>
                            <div class="">
                                <p class="text-gray-700 font-light">{{ __('Horsepower') }}</p>
                                <p class="font-medium">{{ __('170 Hp') }}</p>
                            </div>
                        </div>
                        <div class="hidden md:flex justify-start">
                            <i class="fas fa-paint-brush text-2xl pt-2 me-4"></i>
                            <div class="">
                                <p class="text-gray-700 font-light">{{ __('Color') }}</p>
                                <p class="font-medium">{{ __('Black') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-primary mt-2"><i class="fas fa-plus text-sm"></i> {{ __('Show more') }}</div>
                </section>
                <div class="bg-blue-100 p-6 mt-8">
                    <div class="flex justify-start">
                        <div class="">
                            <div class="text-xl font-medium text-gray-700 mb-2">{{ __('Safe business') }}</div>
                            <p class="text-lg font-light mb-2">
                                {{ __('Are you going to sell or buy a car? We help you with preparations, advice and tips for the best possible car deal.') }}
                            </p>
                            <a href="#!"
                                class="text-primary hover:text-blue-400">{{ __('Read Yellasell\'s tips for a safe deal') }}</a>
                        </div>
                        <img src="{{ asset('media/site/secure.svg') }}" alt="history" class="w-16 h-16 pe-2">
                    </div>
                    <div class="flex justify-start mt-4 text-gray-800">
                        <img src="{{ asset('media/site/history.svg') }}" alt="history" class="pb-10 pe-2">
                        <div class="">
                            <div class="font-medium">{{ __('Reliable vehicle history from CARFAX®') }}</div>
                            <p class="mb-1">
                                {{ __('Reveal imports, mileage, number of owners, inspections, etc. (11 events)') }}</p>
                            <a href="#!" class="text-primary hover:text-blue-400">{{ __('Download the report') }}</a>
                        </div>
                    </div>
                    <div class="flex justify-start mt-2 text-gray-800">
                        <img src="{{ asset('media/site/insurance.svg') }}" alt="insurance" class="h-8 pe-2">
                        <div class="">
                            <div class="font-medium">{{ __('7 days free insurance with Trygg-Hansa & 15% discount') }}
                            </div>
                            <p class="mb-1">{{ __('For you who sign a digital purchase contract.') }}</p>
                            <a href="#!" class="text-primary hover:text-blue-400">{{ __('Read more') }}</a>
                        </div>
                    </div>
                </div>

                {{-- Equipment --}}
                <section class="mt-8">
                    <div class="text-lg text-gray-800">{{ __('Equipment') }}</div>
                    <ul class="text-gray-700 font-light list-disc ps-5 pt-3" style="column-count: 2">
                        <li class="">Backstart help</li>
                        <li class="">Multifunction steering wheel</li>
                        <li class="">Bluetooth</li>
                        <li class="">ISOFIX mounts at the rear</li>
                        <li class="">Folding rear seats</li>
                        <li class="">Immobilizer</li>
                        <li class="">Makeup mirror</li>
                        <li class="">External temperature gauge</li>
                        <li class="">USB socket</li>
                        <li class="">Speed limiter</li>
                        <li class="">Fatigue warning</li>
                        <li class="">Front fog lights</li>
                        <li class="">CD-Stereo</li>
                        <li class="">Start / stop function</li>
                        <li class="">Electrically heated side mirrors</li>
                        <li class="">ABS brakes</li>
                        <li class="">Sold in Sweden</li>
                        <li class="">Rain sensor</li>
                        <li class="">Auto brake</li>
                        <li class="">Anti-slip</li>
                        <li class="">Side airbags</li>
                        <li class="">Dead angle warning</li>
                        <li class="">Gear paddles</li>
                        <li class="">Bluetooth (handsfree)</li>
                    </ul>
                    <div class="text-primary font-medium ps-2"><i class="fas fa-plus text-sm"></i> {{ __('Show more') }}
                    </div>
                </section>
                {{-- Description --}}
                <section class="mt-5 pt-5 border-t-2 border-solid border-gray-400">
                    <div class="font-medium">{{ __('Description') }}</div>
                    <div class="space-y-5 mt-2 text-gray-800 font-light">
                        <p class="">
                            {{ __('Selling my Mercedes cla 220 cdi. Goes just fine and has never bothered. Sold due to need
                            larger car and towbar.') }}
                        </p>
                        <p class="">{{ __('It is chipped by the previous owner so it has 225hp and pulls less.') }}</p>
                        <p class="">{{ __('Fresh summer and winter wheels.') }}</p>
                        <p class="">{{ __('Reached on mobile.') }}</p>
                    </div>
                </section>
                {{-- Contac seller --}}
                <section class="mt-5 pt-5 border-t-2 border-solid border-gray-400">
                    <div class="grid grid-cols-2">
                        <div class="">
                            <div class="font-medium mb-4">{{ __('Sold by') }}</div>
                            <p class="text-gray-700">Oskar Söder</p>
                        </div>
                        <div class="">
                            <a href="#!" class="w-full block bg-green-400 text-center text-white py-3 rounded-md"><i
                                    class="fas fa-sms"></i> {{ __('Send message') }}</a>
                            <a href="#!"
                                class="w-full block text-gray-600 text-center border border-solid border-gray-500 rounded-md py-3 mt-3"><i
                                    class="fas fa-phone-alt me-1"></i>{{ __('Show phone number') }}</a>
                        </div>
                    </div>
                </section>
                {{-- Novelty! --}}
                <section class="border border-solid border-gray-400 p-5 mt-6 flex overflow-hidden">
                    <div class="">
                        <div class="text-lg font-medium mb-3"><span
                                class="text-white bg-btn rounded-full px-2 py-1 me-2">{{ __('Novelty!') }}</span>{{ __('Buy safely with Yallasell Payment') }}
                        </div>
                        <div class="text-light text-gray-700"><i class="fas fa-check text-green-400 pe-2"></i>
                            {{ __('Both buyers and sellers identify themselves with BankID') }}</div>
                        <div class="text-light text-gray-700"><i class="fas fa-check text-green-400 pe-2"></i>
                            {{ __('Choose how you want to pay - direct payment, free invoice or partial payment') }}
                        </div>
                        <div class="text-light text-gray-700"><i class="fas fa-check text-green-400 pe-2"></i>
                            {{ __('The seller receives money directly to his account') }}</div>
                        <div class="my-6">
                            <a href="#!"
                                class="border border-solid border-gray-400 rounded-md px-10 py-2">{{ __('Start Yallsell Payment') }}</a>
                            <a href="#!"
                                class="text-primary ps-3 block mt-3 md:inline">{{ __('Read more about the service') }}</a>
                        </div>
                        <div class="font-medium pb-1">{{ __('Check if you can use Yallasell Payment with invoice') }}
                        </div>
                        <p class="text-gray-800">
                            Here you can see how much you can buy for via invoice with Blocketbetalning. If you want, you
                            can
                            take out a loan and split the payment over time.
                            <a href="#!" class="text-primary">Check your credit space.</a>
                        </p>
                    </div>
                    <div class="flex items-end -me-16 -mb-24">
                        <img src="{{ asset('media/site/carbuyers.svg') }}" alt="" class="h-64 -mb-2">
                    </div>
                </section>
                {{-- Contract of sale --}}
                <section class="border border-solid border-gray-400 p-5 mt-6 flex justify-between overflow-hidden">
                    <div class="">
                        <div class="text-lg font-medium mb-3">{{ __('Contract of sale') }}</div>
                        <div class="text-light text-gray-700"><i class="fas fa-check text-green-400 pe-2"></i>
                            {{ __('7 days free insurance from Trygg-Hansa') }} - <a href="#!" class="">Read more</a>
                        </div>
                        <div class="text-light text-gray-700"><i class="fas fa-check text-green-400 pe-2"></i>
                            {{ __('Simple - Filled with vehicle details') }}</div>
                        <div class="text-light text-gray-700"><i class="fas fa-check text-green-400 pe-2"></i>
                            {{ __('Secure - Signed with BankID by both parties') }}</div>
                        <div class="mt-6"></div>
                        <a href="#!" class="border border-solid border-gray-400 rounded-md px-10 py-2">Digital purchase
                            contract</a>

                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('media/site/contract.svg') }}" alt="" class="">
                    </div>
                </section>
                {{-- Remove, modify, renew your ad --}}
                <section class="text-sm text-gray-700 font-light mt-3 pt-3 border-t-2 border-solid border-gray-400">
                    <a href="#!" class="hover:underline"><i class="fas fa-pencil-alt"></i>
                        {{ __('Remove, modify, renew your ad') }}</a>
                    <a href="#!" class="hover:underline float-end"><i class="fas fa-exclamation-triangle"></i>
                        {{ __('Report ad') }}</a>
                </section>
            </div>
            {{-- /Item info --}}

            <section class="">
                <div class="bg-white border border-solid border-gray-300 rounded p-4 w-48">
                    <h4 class="text-center mb-4">{{ __('Find your dream job throughout Iraq') }}</h4>
                    <div class="space-y-1">
                        <div class="flex items-center border border-solid border-gray-200 p-4">
                            <img src="{{ asset('media/site/lernia.jpg') }}" alt="" class="w-14 h-8">
                            <p class="truncate ms-2 text-sm">Lernia</p>
                        </div>
                        <div class="flex items-center border border-solid border-gray-200 p-4">
                            <img src="{{ asset('media/site/axis.jpg') }}" alt="" class="w-14 h-8">
                            <p class="truncate ms-2 text-sm">Axis Communications</p>
                        </div>
                        <div class="flex items-center border border-solid border-gray-200 p-4">
                            <img src="{{ asset('media/site/lernia.jpg') }}" alt="" class="w-14 h-8">
                            <p class="truncate ms-2 text-sm">Lernia</p>
                        </div>
                    </div>
                    <div class="w-full my-3">
                        <a href=""
                            class="bg-btn hover:bg-blue-500 text-center text-sm rounded-md block py-2 text-white">{{ __('Show more jobs') }}</a>
                    </div>
                    <div class="text-red-600">
                        <h1 class="text-2xl font-extrabold text-center">Yallasell <span class="font-light">jobb</span></h1>
                    </div>
                </div>
            </section>
        </div>
    </div>
    {{-- Others have also watched --}}
    <section class="bg-red-50 pt-5 pb-16 mt-8 px-2">
        <div class="container mx-auto">
            <div class="text-xl font-semibold text-gray-800">{{ __('Others have also watched') }}</div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <?php for ($i = 0; $i < 8; $i++): ?> <div class="bg-white p-3">
                    <a href="#!" class="">
                        <img src="{{ asset('media/product/img1.jpg') }}" alt="" class="w-full">
                        <div class="text-gray-600 mt-5"><span
                                class="bg-gray-400 text-white font-thin text-sm rounded-sm p-1 me-2">{{ __('Store') }}</span>Västmanland
                        </div>
                        <div class="font-medium pt-1">Audi A5 Sportback/S-li...</div>
                        <div class="font-medium text-green-500 pt-1">209800 {{ __('IQD') }}</div>
                    </a>
            </div>
            <?php endfor; ?>
        </div>
        </div>
        {{-- Find your dream job throughout Iraq --}}
        <div class="container mx-auto border border-solid border-gray-300 mt-20 bg-white p-6">
            <div class="text-center text-2xl font-medium border-b-2 border-solid border-gray-200 pb-3 mb-4">
                {{ __('Find your dream job throughout Iraq') }}</div>
            <div class="text-gray-800 font-light grid grid-flow-row grid-cols-2 md:grid-cols-4">
                <a href="#!">Säljare <span class="text-gray-500">, 1328</span></a>
                <a href="#!">Chaufför <span class="text-gray-500">, 80</span></a>
                <a href="#!">Chef <span class="text-gray-500">, 913</span></a>
                <a href="#!">Lager <span class="text-gray-500">, 569</span></a>
                <a href="#!">Butik <span class="text-gray-500">, 431</span></a>
                <a href="#!">Ekonomi <span class="text-gray-500">, 839</span></a>
                <a href="#!">HR <span class="text-gray-500">, 350</span></a>
                <a href="#!">Undersköterska <span class="text-gray-500">, 100</span></a>
                <a href="#!">Administration <span class="text-gray-500">, 591</span></a>
                <a href="#!">Transport <span class="text-gray-500">, 254</span></a>
                <a href="#!">Elektriker <span class="text-gray-500">, 142</span></a>
                <a href="#!">Logistik <span class="text-gray-500">, 352</span></a>
                <a href="#!">Ekonomiassistent <span class="text-gray-500">, 117</span></a>
                <a href="#!">IT <span class="text-gray-500">, 1112</span></a>
                <a href="#!">Projektledare <span class="text-gray-500">, 365</span></a>
                <a href="#!">Truckförare <span class="text-gray-500">, 94</span></a>
                <a href="#!">Snickare <span class="text-gray-500">, 49</span></a>
                <a href="#!">Ingenjör <span class="text-gray-500">, 276</span></a>
                <a href="#!">Administratör <span class="text-gray-500">, 114</span></a>
                <a href="#!">Key Account Manager <span class="text-gray-500">, 482</span></a>
                <a href="#!">Sjuksköterska <span class="text-gray-500">, 156</span></a>
                <a href="#!">Svetsare <span class="text-gray-500">, 48</span></a>
                <a href="#!">Städare <span class="text-gray-500">, 6</span></a>
                <a href="#!">Kock <span class="text-gray-500">, 28</span></a>
            </div>
        </div>
    </section>



@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                items: 1,
                autoplay: true,
                autoplayHoverPause: true,

                rtl: {{ !App::isLocale('ar') ? 'false' : 'true' }}
            });
            $('.customNextBtn').click(function() {
                owl.trigger('next.owl.carousel');
            })
            // Go to the previous item
            $('.customPrevBtn').click(function() {
                // With optional speed parameter
                // Parameters has to be in square bracket '[]'
                owl.trigger('prev.owl.carousel', [300]);
            })
        });

    </script>
@endsection
