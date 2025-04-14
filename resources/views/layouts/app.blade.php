<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web:wght@0,400;0,700&family=Poppins:wght@100;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://website-mashata-production.up.railway.app/css/home.css">
    <link rel="stylesheet" href="https://website-mashata-production.up.railway.app/css/global.css">
    <script src="{{ asset('js/navbar.js') }}"></script>
    <title>@yield('title', 'MasHata')</title>
</head>

<body> 
    <x-navbar></x-navbar>

    @yield('content')

    <x-footer></x-footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function () {
            document.querySelector('nav ul').classList.toggle('active');
        });
    </script>
</body>
</html>
