<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Better Than Adventure!') }}</title>

        <!-- Fonts -->
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        @include('layouts.navigation')
        <div class="content">
            <div class="mt-4 px-3 px-lg-0">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
