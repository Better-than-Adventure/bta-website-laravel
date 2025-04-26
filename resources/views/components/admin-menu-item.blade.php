@props([
    'route',
    'label'
])

<li class="nav-item">
    <a href="{{$route}}" class="nav-link @if(Route::currentRouteName() == $route) active @else  text-white @endif">
        {{ $label }}
    </a>
</li>
