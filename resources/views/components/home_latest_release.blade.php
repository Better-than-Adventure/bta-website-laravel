@php
    $service = new \App\Services\LatestReleaseService;
    $releaseData = $service->getLatestRelease();
@endphp

<h2 class="mt-0 pb-1">Latest Release</h2>
@if(!$releaseData)
    <div class="align-items-center mb-4">
        Could not fetch release info! Please visit
        <span
        ><a href="https://github.com/Better-than-Adventure/bta-download-repo/releases/latest">our Github</a></span>
        to manually download the latest version.
    </div>
@else
<div class="d-flex align-items-center mb-4">
    <img src="{{ $releaseData['icon_image'] }}" class="block-icon" />
    <div class="w-100 d-grid gap-2">
        <div style="color: gray;" class="metadata">
            {{$releaseData['version_name']}}
        </div>
        <a
            class="btn btn-block btn-primary btn-download"
            href="{{route('downloads')}}"
            role="button"
        >
            Download Links
        </a>
    </div>
</div>
@endif
