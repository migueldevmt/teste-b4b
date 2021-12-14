<?php

use App\Http\Controllers\Api\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("local-weather", [WeatherController::class, 'localWeather']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});