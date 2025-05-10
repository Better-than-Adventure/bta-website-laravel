@props(['route' => null, 'title', 'dropdown' => false, 'dropdown_items' => null, 'include_infographics' => false, 'request' => null])
<li @class(['nav-item', 'dropdown' => $include_infographics])>

    @if(!$dropdown)
    <a class="nav-link @if(request()->is($request) || Route::is($route)) active @endif" href="{{ $route }}">
        {{$title}}
    </a>
    @else
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Images
        </a>

        <ul class="dropdown-menu">
            @foreach($dropdown_items as $item)
                <li><a class="dropdown-item nav-link" href="{{route('posts.view', ['postType' => $item->postType, 'post' => $item])}}">{{$item->title}}</a></li>
            @endforeach
            @if($include_infographics)
                <li><a class="dropdown-item nav-link" href="{{route('infographics')}}">Infographics</a></li>
            @endif
        </ul>
    @endif
</li>
