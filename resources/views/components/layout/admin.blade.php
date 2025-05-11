<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Better Than Adventure!') }}</title>

        <!-- Fonts -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/scss/admin.scss', 'resources/js/app.js', 'resources/js/simpleMDE.js'])
    </head>
    <body style="background-image: linear-gradient( rgba(41, 40, 42, 0.5) 0%, rgb(10, 10, 10, .85) 50%), url('/images/subzoomed.png');">
        <div class="header mb-3">
            <div class="container-fluid">
                @if(Auth::user())
                    <div style="right: 0; top: 0" class="position-absolute me-3 mt-2">
                        <span> {{ Auth::user()->name }} |</span>
                        <span>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign Out
                            </a>
                        </span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                @endif
                <img src="/images/admin-logo.png" alt="Better than Adventure! Workbench"/>
            </div>
        </div>
        <div class="container-fluid">
            <div class="d-flex">
                <div>
                    <x-admin-container title="Contents" width="250">
                        @can('posts.view')
                            <x-admin-menu-item label="Homepage" :route="route('admin.posts', ['type' => 'homepage'])" />
                            <x-admin-menu-item label="Pages" :route="route('admin.posts')" />
                            <x-admin-menu-item label="Articles" :route="route('admin.posts', ['type' => 'blog'])" />
                            <x-admin-menu-item label="Galleries" :route="route('admin.posts', ['type' => 'gallery'])" />
                        @endcan
                        @can('infographics.view')
                            <x-admin-menu-item label="Infographics" :route="route('admin.infographics')" />
                        @endcan
                    </x-admin-container>
                    @role('admin')
                        <x-admin-container title="Admin" width="250">
                            <x-admin-menu-item label="User Management" :route="route('admin.users')" />
                        </x-admin-container>
                    @endrole
                </div>
                <div class="m-3" style="width: 100%; height: 100%">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
