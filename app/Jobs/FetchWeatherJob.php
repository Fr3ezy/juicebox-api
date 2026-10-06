<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FetchWeatherJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function handle(): void
    {
        $apiKey = env('WEATHER_API_KEY');
        $response = Http::get("https://api.weatherapi.com/v1/current.json", [
            'key' => $apiKey,
            'q' => 'Perth'
        ]);

        if ($response->successful()) {
            Cache::put('perth_weather', $response->json(), 900);
        }
    }
}
