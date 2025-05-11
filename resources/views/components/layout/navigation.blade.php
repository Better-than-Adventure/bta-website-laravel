@php
    $galleries = \App\Models\Post::whereHas('postType', function ($query) {
        $query->where('post_template_enum', \App\Enums\EnumPostTemplates::Gallery);
    })->get();
@endphp

<div id="header-desktop">
    <div class="header d-flex justify-content-center" style="
                background-image: linear-gradient( rgba(41, 40, 42, 0.0) 50%,  rgba(10, 10, 10, 0.5)),
                url('/images/subzoomed.png');">
        <a href="/">
            <img id="logo-desktop" src="/images/logo-header.png" class="logo" />
        </a>
        <div class="tilt">
            <div id="status" class="pop">.net!</div>
        </div>
        @if(Auth::user())
        <div style="right: 0" class="position-absolute me-3">
            Logged in as <span><a href="{{ route('dashboard') }}" class="fw-bold">{{ Auth::user()->name }}</a></span>
        </div>
        @endif
    </div>
    <div id="nav-desktop" class="navbar-container">
        <nav class="navbar navbar-custom navbar-expand">
            <div class="container-fluid justify-content-center">
                <ul class="navbar-nav">
                    <x-navigation.list-item :route="route('index')" title="Home"/>
                    <x-navigation.list-item :route="route('posts.list', ['postType' => 'blog'])" title="Blog" request="blog"/>
                    <x-navigation.list-item :route="route('downloads')" title="Download"/>
                    <x-navigation.list-item :route="route('downloads')" title="Report a Bug"/>
                    <x-navigation.list-item :route="route('downloads')" title="Tutorials"/>
                    <x-navigation.list-item title="Galleries" :dropdown="true" :dropdown_items="$galleries" :include_infographics="true"/>
                    <x-navigation.list-item :route="route('downloads')" title="Wiki"/>
                </ul>
            </div>
        </nav>
    </div>
</div>
