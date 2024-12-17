<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Better Than Adventure!') }}</title>

        <!-- Fonts -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/scss/bootstrap.scss', 'resources/js/app.js', 'resources/js/simpleMDE.js'])
    </head>
    <body>
        <main class="container-fluid">
            <div class="row">
                <div class="d-flex flex-column sidebar vh-100 p-3 text-white bg-dark" style="width: 280px;">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4">BTA Admin</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <x-admin-menu-item label="Dashboard" route="dashboard" />
                        <x-admin-menu-item label="Posts" route="admin.posts" />
                        <x-admin-menu-item label="Post Types" route="admin.postTypes" />
                    </ul>
                    <hr>
                    <x-admin-user-menu/>
                </div>
                <div class="col-md admin-container pt-3 px-4">
                    {{ $slot }}
                </div>
            </div>
        </main>
        @stack('scripts')
    </body>
</html>
