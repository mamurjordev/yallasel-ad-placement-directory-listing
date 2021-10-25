<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
</head>

<body class="h-screen flex items-center bg-gray-100 font-roboto">

    <section class="container mx-auto flex justify-items-center">
        <section class="hidden md:flex items-center">
            <div class="bg-login-bg text-white px-10 pt-10 pb-5">
                <img src="{{ asset('media/site/logo.svg') }}" alt="" class="w-44 mb-5">
                <h1 class="text-5xl font-semibold font-sans leading-tight">{{ __('Log in for a better experience') }}</h1>
                <p class="mt-5 text-xl">{{ __('The block uses Schibsted account for easy and more secure login.') }}</p>
                <div class="mt-10 text-lg">
                    <p class="font-bold">{{ __('Problems logging in?') }} <a href="#!" class="underline ">{{ __('Here you get help!') }}</a>
                    </p>
                    <div class="font-bold">{{ __('Do you have a store on Blocket?') }} <a href="#!" class="underline ">{{__('Login for stores')}}</a></div>
                </div>
            </div>
        </section>
        {{-- <section class="shadow-lg bg-white p-5 w-7/12">
            <div class="flex justify-between mb-5">
                <img src="{{ asset('media/site/logo.svg') }}" alt="" class="w-14">
                <p class="text-2xl font-bold">Dev Logo</p>
            </div>
            <h4 class="text-2xl font-bold mb-3">Logga in eller skapa ett nytt konto</h4>
            <form action="" class="grid grid-flow-row">
                <div class="border-b border-solid border-gray-400 rounded-t bg-gray-200 relative py-2">
                    <label for="email" class="text-gray-600 font-semibold px-3 absolute bg-gray-200 py-2">Ange din e-postadress *</label>
                    <input type="text" id="email" class="border-none focus:ring-0">
                </div>
                <p class="text-xs mb-5 text-gray-500 mt-1">*Obligatoriskt fält</p>
                <p class="text-sm">Blocket är en del av Schibsted. Du behöver ett Schibsted-konto för att fortsätta. Du
                    kan
                    använda samma konto på alla Schibsteds webbplatser.</p>
                <a href="" class="text-sm text-blue-500 underline mt-1">Vad är ett Schibsted-konto? <i
                        class="far fa-edit ps-2 text-xs"></i></a>
                <button type="submit" class="bg-blue-500 rounded-md py-3 text-white font-bold mt-36">Fortsatt</button>
            </form>
        </section> --}}

        {{-- After Registration --}}

        <section class="shadow-lg bg-white p-5 w-full mx-2 md:mx-0 md:w-7/12">
            <div class="flex justify-between mb-5">
                <img src="{{ asset('media/site/logo.svg') }}" alt="" class="w-16">
                <p class="text-2xl font-bold">Dev Logo</p>
            </div>
            <h4 class="text-2xl font-bold mb-3">{{ __('Check your inbox') }}</h4>
            <img src="{{ asset('media/site/mail.svg') }}" alt="" class="w-60 mx-auto my-10">
            <div class="grid grid-flow-row text-center text-gray-500 text-sm">
                <p class="">{{ __('We have sent a verification link to:') }}</p>
                <p class="mt-1">example@gmail.com</p>
                <a href="#!" class="text-primary underline tracking-wide mt-1">{{ __('Use another email') }}</a>
                <a href="#!" class="text-primary underline tracking-wide my-10">{{ __('Send the email again') }}</a>
            </div>
        </section>
    </section>


</body>

</html>
