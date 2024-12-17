<div class="dropdown">
    <a class="text-white dropdown-toggle" href="#" role="button" id="userSettingsToggle" data-bs-toggle="dropdown">
        {{Auth::user()->name}}
    </a>
    <div class="dropdown-menu" aria-labelledby="userSettingsToggle">
        <a class="dropdown-item" href="#">Settings</a>
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>
