@props(['code'])
<div class="video-container">
    <iframe
        width="560"
        height="315"
        src="https://www.youtube.com/embed/{{$code}}?si=iojRvU8tyRq9qVki"
        title="YouTube video player"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen>
    </iframe>
</div>
