<?php

namespace App\Services;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LatestReleaseService
{
    public function getLatestRelease(): ?array
    {
        try {
            $client = $this->getLatestReleaseTag('client');
            $server = $this->getLatestReleaseTag('server');

            $iconPath = Str::replace('.', '_', $client);

            return [
                'version_name' => $client,
                'client_instance' => config('app.release_channel') . "/bta-client/release/$client/bta.$client.mmc.zip",
                'client_jar' => config('app.release_channel') . "/bta-client/release/$client/bta.$client.client.jar",
                'server_jar' => config('app.release_channel') . "/bta-server/release/$server/bta.$server.server.jar",
                'icon_image' => config('app.release_channel') . "/bta-client/release/$client/auto/$iconPath.png"
            ];
        } catch (HttpResponseException $e) {
            report($e->getMessage());
            return null;
        }
    }

    public function getLatestReleaseTag($channel): string
    {

        $response = HTTP::get(config('app.release_channel')."/bta-$channel/release/versions.json");

        if($response->successful()){
            $meta = $response->body();
            // Todo: Funky-ass string splitting. Please remove the trailing comma in the versions.json
            return Str::between($meta, '"default": "', '"');
        }

        throw new HttpResponseException(response()->json());
    }

}
