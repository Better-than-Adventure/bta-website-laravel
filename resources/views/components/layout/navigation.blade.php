@php
    use Illuminate\Support\Carbon;

    $pages = \App\Models\Post::whereHas('postType', function ($query) {
        $query->where('slug', 'page')->where('published_at', '<=', Carbon::now())->where('top_nav', true);
    })->get();
    $galleries = \App\Models\Post::whereHas('postType', function ($query) {
        $query->where('post_template_enum', \App\Enums\EnumPostTemplates::Gallery);
    })->get();
@endphp

<div id="nav-mobile" class="sticky-top">
    <div class="navbar-container">
        <nav class="navbar navbar-custom navbar-expand">
            <div class="navbar-nav">
                <button
                    class="nav-link"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarToggleExternalContent"
                    aria-controls="navbarToggleExternalContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="logo-mobile-container">
                    <a href="/">
                        <img
                            id="logo-mobile"
                            src="{{asset('/images/badge-bta.png')}}"
                            class="logo"
                        />
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <div class="collapse mobile-menu" id="navbarToggleExternalContent">
        <ul class="navbar-nav">
            <x-navigation.mobile-list-item :route="route('index')" title="Home"/>
            <x-navigation.mobile-list-item :route="route('posts.list', ['postType' => 'blog'])" title="Blog"
                                    request="blog"/>
            <x-navigation.mobile-list-item :route="route('downloads')" title="Download"/>
            <x-navigation.mobile-list-item route="//{{config('app.bug_report_site_url')}}" title="Report a Bug"/>
            @foreach($pages as $page)
                <x-navigation.mobile-list-item :route="$page->url" :title="$page->title"/>
            @endforeach
            <x-navigation.mobile-list-item title="Galleries" :dropdown="true" :dropdown_items="$galleries"
                                    :include_infographics="true"/>
            <x-navigation.mobile-list-item route="//{{config('app.wiki_url')}}" title="Wiki"/>
        </ul>
    </div>
</div>

<div id="header-desktop">
    <div class="header d-flex justify-content-center" style="
                background-image: linear-gradient( rgba(41, 40, 42, 0.0) 50%,  rgba(10, 10, 10, 0.5)),
                url('/images/subzoomed.png');">
        <a href="/">
            <img id="logo-desktop" src="{{asset('/images/logo-header.png')}}" class="logo"/>
        </a>
        <div class="tilt">
            <div id="status" class="pop">.net!</div>
        </div>
        @if(Auth::user())
            <div style="right: 0" class="position-absolute me-3">
                Logged in as <span><a href="{{ route('dashboard') }}"
                                      class="fw-bold">{{ Auth::user()->name }}</a></span>
            </div>
        @endif
    </div>
    <div id="nav-desktop" class="navbar-container">
        <nav class="navbar navbar-custom navbar-expand">
            <div class="container-fluid justify-content-center">
                <ul class="navbar-nav">
                    <x-navigation.list-item :route="route('index')" title="Home"/>
                    <x-navigation.list-item :route="route('posts.list', ['postType' => 'blog'])" title="Blog"
                                            request="blog"/>
                    <x-navigation.list-item :route="route('downloads')" title="Download"/>
                    <x-navigation.list-item route="//{{config('app.bug_report_site_url')}}" title="Report a Bug"/>
                    @foreach($pages as $page)
                        <x-navigation.list-item :route="$page->url" :title="$page->title"/>
                    @endforeach
                    <x-navigation.list-item title="Galleries" :dropdown="true" :dropdown_items="$galleries"
                                            :include_infographics="true"/>
                    <x-navigation.list-item route="//{{config('app.wiki_url')}}" title="Wiki"/>
                </ul>
            </div>
        </nav>
    </div>
</div>
