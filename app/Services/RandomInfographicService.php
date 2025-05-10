<?php

namespace App\Services;

use App\Models\Infographic;

class RandomInfographicService
{

    public function getRandomInfographic() {
        $infographics = Infographic::all();
        $array = $infographics->pluck('url')->toArray();
        $key = array_rand($array);
        return $array[$key];
    }

}
