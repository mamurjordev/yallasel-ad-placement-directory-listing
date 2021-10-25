<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Yallasell') }}</title>

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
</head>

<body class="overflow-x-hidden antialiased">
      <!-- Scripts -->
      @routes
      <script src="{{ mix('js/app.js') }}" defer></script>
      @inertia

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"
          integrity="sha512-CwHUCK55pONjDxvPZQeuwKpxos8mPyEv9gGuWC8Vr0357J2uXg1PycGDPND9EgdokSFTG6kgSApoDj9OM22ksw=="
          crossorigin="anonymous"></script>
      <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('js/script.js') }}"></script>
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

</body>
