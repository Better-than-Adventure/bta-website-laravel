@php
    $service = new \App\Services\LatestReleaseService;
    $releaseData = $service->getLatestRelease();
@endphp

<x-layout.guest>
    <x-slot:heading>
        <x-page-header title="Downloads" image="images/header/about.png"/>
    </x-slot:heading>
    <div id="latest" class="mb-4">
        @if(!$releaseData)
            <div class="align-items-center">
                Could not fetch release info! Please visit
                <span
                ><a href="https://github.com/Better-than-Adventure/bta-download-repo/releases/latest">our Github</a></span>
                to manually download the latest version.
            </div>
        @else
        <div class="d-flex">
            <div class="pe-4">
                <img class="release-icon" src="{{ $releaseData['icon_image'] }}" />
            </div>
            <div class="w-100">
                <h5 class="mt-0 mb-0 latest">
                    Latest Stable Release
                </h5>
                <h1 class="mt-0 latest-title">
                    <span class="mb-3">{{$releaseData['version_name']}}</span>
                </h1>
                <hr class="mt-3 mb-3" />
                <div>
                    <div class="">
                        <h5 class="mt-0 mb-2">
                            <span class="latest">Recommended:</span> MultiMC/Prism Instance <span><a href="/installation-guide">(More info)</a></span>
                        </h5>
                        <button
                            class="btn btn-primary btn-main me-2 mb-3 btn-block"
                            onclick="location.href='{{$releaseData['client_instance']}}'"
                        >
                            MultiMC/Prism Instance
                        </button>
                        <h5 class="mt-1 mb-2">
                            Other methods:
                        </h5>
                        <button
                            class="btn btn-primary me-2 mb-2"
                            onclick="location.href='{{$releaseData['client_jar']}}'"
                        >
                            Client Jar
                        </button>                        <button
                            class="btn btn-primary me-2 mb-2"
                            onclick="location.href='{{$releaseData['server_jar']}}'"
                        >
                            Server Jar
                        </button>

                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div>
        Please visit our <span><a href="https://github.com/Better-than-Adventure/bta-download-repo/releases">GitHub repository</a></span> for an archive of historic releases.
    </div>
    <div class="mt-3">
        Alternatively, join our <span><a href="https://www.betterthanadventure.net/discord">Discord server</a></span> for instant updates on the latest versions and access to exclusive pre-releases.
    </div>
</x-layout.guest>
