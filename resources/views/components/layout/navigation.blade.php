<div id="header-desktop">
    <div class="header d-flex justify-content-center" style="
                background-image: linear-gradient( rgba(41, 40, 42, 0) 50%,  rgba(10, 10, 10, 0.5)),
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
                    <li class="nav-item">
                        <a class="nav-link @if(Route::is('index')) active @endif" href="{{ route('index') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('blog')) active @endif" href="{{ route('posts.list', ['postType' => 'blog']) }}">
                            Blog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Route::is('downloads')) active @endif" href="{{ route('downloads') }}">
                            Downloads
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('tutorials')) active @endif" href="{{ route('posts.list', ['postType' => 'tutorials']) }}">
                            Tutorials
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('photos')) active @endif" href="{{ route('posts.list', ['postType' => 'photos']) }}">
                            Photos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('videos')) active @endif" href="{{ route('posts.list', ['postType' => 'videos']) }}">
                            Videos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}" active="{{ request()->routeIs('index') }}">
                            Wiki
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
