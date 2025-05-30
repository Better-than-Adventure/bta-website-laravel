@props(['title', 'image', 'thaboar' => false])
<div id="page-header" class="mb-4">
    <div
        class="content page-header px-5 d-flex align-items-center"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.25) 65%, rgba(0, 0, 0, 0.7)), url('{{ url($image) }}'); background-size: cover; background-position: center;"
    >
        <h1 class="title minecraft-regular">{{ $title }}</h1>
        @if($thaboar)
        <div class="tilt">
            <div id="status-daboar" class="pop">
                By&nbsp;<a target="_blank" href="https://twitter.com/thaboarr">@thaboarr</a>!
            </div>
        </div>
        @endif
    </div>
</div>
