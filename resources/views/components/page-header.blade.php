@props(['title', 'image'])
<div id="page-header" class="mb-4">
    <div
        class="content page-header px-5 d-flex align-items-center"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.25) 65%, rgba(0, 0, 0, 0.7)), url('{{ url($image) }}'); background-size: cover; background-position: center; border-bottom: #5aa938 4px solid;"
    >
        <h1 class="title minecraft-regular">{{ $title }}</h1>
    </div>
</div>
