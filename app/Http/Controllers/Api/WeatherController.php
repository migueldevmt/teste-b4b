<?php

namespace App\Http\Controllers\Api;

use App\Actions\GetClientWeather;
use App\Http\Controllers\Controller;
use App\Models\User;
use Dnsimmons\OpenWeather\OpenWeather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeatherController extends Controller
{
    public function localWeather(Request $request, GetClientWeather $getClientWeather)
    {
        $remoteAddr = $request->ip();
        if (Auth::check()) {
            User::where('id', Auth::id())->update(['last_ip' => $remoteAddr]);
        }

        $currentWeather = $getClientWeather->executar($remoteAddr);

        return [
            'data' => $currentWeather ?: 'Não foi possivel capturar as informações sobre o tempo, tente novamente'
        ];
    }
}