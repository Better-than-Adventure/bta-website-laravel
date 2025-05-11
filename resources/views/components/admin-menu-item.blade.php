@props([
    'route',
    'label'
])
<div class="admin-nav-item @if(request()->fullUrl() == $route)) active @endif">
    <a href="{{$route}}">
        {{ $label }}
    </a>
</div>
