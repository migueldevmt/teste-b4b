<?php

namespace App\DataTransferObject;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class WeatherDTO extends DataTransferObject
{
    #[MapFrom('condition.desc')]
    public string $desc;

    #[MapFrom('wind.speed')]
    public string $windSpeed;

    #[MapFrom('wind.deg')]
    public string $windDegree;

    #[MapFrom('wind.direction')]
    public string $windDirection;

    #[MapFrom('forecast.temp')]
    public string $temperature;

    #[MapFrom('forecast.temp_min')]
    public string $temperatureMin;

    #[MapFrom('forecast.temp_max')]
    public string $temperatureMax;

    #[MapFrom('forecast.humidity')]
    public string $humidity;
}