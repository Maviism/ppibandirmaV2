<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="PPI Bandirma (Perhimpunan Pelajar Indonesia) Bandirma adalah organisasi yang sedang menetap di wilayah kerja PPI Bandirma. Ruang lingkup kerja PPI bandirma mencakup seluruh kegiatan pelajar Indonesia yang berada di provinsi Balikesir dan Çanakkale, Turki. Namun hingga kini kota yang berisikan pelajar Indonesia di wilayah tersebut hanyalah kota Bandirma dan Kota Çanakkale.">
        <title>
            @yield('title'){{ config('app.name', 'Laravel') }}
        </title>

        <!-- icon -->
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="apple-touch-startup-image" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <meta name="apple-mobile-web-app-title" content="PPI Bandirma">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#2D3748">
        
        <!-- OG -->
        <meta property="og:title" content="Perhimpunan pelajar Indonesia Bandirma" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="{{ asset('assets/Logo.webp') }}" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css" async>


        
    </head>
    <body class="antialiased min-h-screen bg-white">
        <!-- Page Content -->
        <main>
            <a href="/home" class="absolute top-2 right-2 text-gray-200 bg-gray-400/25 px-2 py-1 rounded-md hover:bg-gray-500/50 hover:text-gray-100">
            <i class="fas fa-sm p-1 rounded-md fa-home"></i>Home
            </a>
            <div id="hero">
                <img class="w-full md:h-[65vh] object-cover" src="{{url('/assets/hero.webp')}}" alt="">
            </div>
            <div class="relative z-20">
                <div class="absolute bg-white rounded-full p-2 w-36  top-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <x-application-logo />
                </div>
            </div>
            <div class="relative z-10 bg-white -mt-3  mb-10 rounded-t-xl md:rounded-t-2xl w-full pt-32">
                <div class="text-center">
                    <div class="font-black text-3xl mb-1">PPI Bandirma</div>
                    <div class="font-semibold">Since 2020</div>
                    <div class="flex justify-center items-center space-x-4 py-4">
                        <a href="https://www.instagram.com/ppibandirma/"><i class="fab fa-sm p-1 rounded-md fa-instagram text-white bg-black"></i></a>
                        <a href="https://open.spotify.com/show/3rCNDmlRy9jABsiLYuQoVG?si=ded18abf13f44bfa"><i class="fab fa-lg fa-spotify" ></i></a>
                        <a href="https://www.youtube.com/@ppibandirma"><i class="fab fa-lg fa-youtube"></i></a>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-3 text-center links-container p-3 md:px-9 mt-2 space-y-4 md:space-y-0 md:gap-6">
                    @foreach($links as $link)
                    <a class="flex w-full hover:shadow-xl hover:bg-gray-100 border font-semibold text-lg border-black rounded-md items-center justify-center h-20 p-2">
                        {{ $link->title }}
                    </a>
                    @endforeach

                </div>
            </div>

             
        </main>

        @stack('scripts')
       
    </body>
</html>
