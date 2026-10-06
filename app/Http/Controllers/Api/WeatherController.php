<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather()
    {
        return Cache::remember('perth_weather', 900, function () { // Cache 15 menit
            $apiKey = env('WEATHER_API_KEY');
            $response = Http::get("https://api.weatherapi.com/v1/current.json", [
                'key' => $apiKey,
                'q' => 'Perth'
            ]);

            if ($response->failed()) {
                return response()->json(['error' => 'Unable to fetch weather data'], 503);
            }

            return $response->json();
        });
    }
}
