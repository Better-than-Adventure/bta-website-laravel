<?php

namespace App\Services;

use App\Models\Infographic;

class RandomInfographicService
{

    public function getRandomInfographic() {
        $infographics = Infographic::all();
        if($infographics->isEmpty()) {
            return null;
        }

        $array = $infographics->pluck('url')->toArray();
        $key = array_rand($array);
        return $array[$key];
    }

}
