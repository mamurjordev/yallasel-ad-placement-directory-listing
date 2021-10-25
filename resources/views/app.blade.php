<!DOCTYPE html>
<html lang="ar" class="notranslate" translate="no">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="google" content="notranslate" />
    <link rel="apple-touch-icon" sizes="57x57" href="/media/site/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/media/site/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/media/site/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/media/site/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/media/site/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/media/site/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/media/site/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/media/site/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/media/site/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/media/site/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/media/site/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/media/site/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/media/site/favicon/favicon-16x16.png">
    <link rel="manifest" href="/media/site/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/media/site/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>{{ config('app.name', 'Yallasell') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
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
</head>

<body class="overflow-x-hidden antialiased">
    <!-- Scripts -->
    @routes
    <script>
        var lang = "{{ session()->has('lang') ? session()->get('lang') : 'ar' }}";
    </script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    @inertia

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"
        integrity="sha512-CwHUCK55pONjDxvPZQeuwKpxos8mPyEv9gGuWC8Vr0357J2uXg1PycGDPND9EgdokSFTG6kgSApoDj9OM22ksw=="
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
