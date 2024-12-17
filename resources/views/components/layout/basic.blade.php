<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Better Than Adventure!') }}</title>

    <!-- Fonts -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/scss/bootstrap.scss', 'resources/js/app.js'])
</head>
<body class="h-100">
    <div class=" d-flex justify-content-center align-items-center h-100">
        <div class="card px-4 py-5" style="max-width: 400px;">
            <div class="card-body">
                <div class="d-flex justify-content-center mb-1">
                    <img src="/images/admin-logo.png" alt="bta! admin"/>
                </div>
            {{ $slot }}
            </div>
        </div>
    </div>

</body>
</html>
