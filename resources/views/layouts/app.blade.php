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
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="apple-touch-startup-image" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <meta name="apple-mobile-web-app-title" content="PPI Bandirma">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <style>
        .fade-in {
            opacity: 0;
            animation: fadeInAnimation 1s ease-in-out forwards;
        }

        @keyframes fadeInAnimation {
            from {
            opacity: 0;
            }
            to {
            opacity: 1;
            }
        }
        </style>
    </head>
    <body class="antialiased">
        
        <div class="min-h-screen bg-white">
            @include('partials.navigation-menu')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @include('partials.footer')
        </div>

        @stack('modals')

        @livewireScripts
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fadeIns = document.querySelectorAll('.fade-in');
            for (var i = 0; i < fadeIns.length; i++) {
            fadeIns[i].classList.add('fade-in-show');
            }
        });
        </script>
    </body>
</html>
