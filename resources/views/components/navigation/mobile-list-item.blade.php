@props(['route' => null, 'title', 'dropdown' => false, 'dropdown_items' => null, 'include_infographics' => false, 'request' => null])
<li @class(['nav-item px-3 py-1', 'dropdown' => $include_infographics])>
    @if(!$dropdown)
    <a class="nav-link mobile @if(request()->url() == $route) active @endif" href="{{ $route }}">
        {{ $title }}
    </a>
    @else
        <a class="nav-link mobile dropdown-toggle" role="button" data-bs-toggle="collapse" href="#collapseDropdown">
            {{$title}}
        </a>

        <ul class="collapse navbar-nav ps-3" id="collapseDropdown">
            @foreach($dropdown_items as $item)
                <li><a class="nav-link mobile" href="{{route('posts.view', ['postType' => $item->postType, 'post' => $item])}}">{{$item->title}}</a></li>
            @endforeach
            @if($include_infographics)
                <li><a class="nav-link mobile" href="{{route('infographics')}}">Infographics</a></li>
            @endif
        </ul>
    @endif
</li>
<hr class="my-0" />
