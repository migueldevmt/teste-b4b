<?php

namespace App\Actions;

use App\DataTransferObject\WeatherDTO;
use Dnsimmons\OpenWeather\OpenWeather;

class GetClientWeather extends Action
{
    public function executar(string $remoteAddr): WeatherDTO | false
    {
        $currentCity = geoip()->getLocation($remoteAddr)->city;

        $weather = new OpenWeather();

        $currentWeather = false;
        $tries = 3;
        while (!$currentWeather && $tries-- > 0) {
            sleep(0.3);
            $currentWeather = $weather->getCurrentWeatherByCityName($currentCity);
        }

        return $currentWeather ? new WeatherDTO($currentWeather) : false;
    }
}