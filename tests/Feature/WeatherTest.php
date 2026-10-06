<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    public function test_weather_endpoint_returns_mocked_data(): void
    {
        Http::fake([
            'api.weatherapi.com/*' => Http::response([
                'location' => ['name' => 'Perth'],
                'current' => ['temp_c' => 25] // Set ke integer 25
            ], 200),
        ]);

        $response = $this->getJson('/api/weather');

        $response->assertStatus(200)
                 ->assertJsonPath('location.name', 'Perth')
                 ->assertJsonPath('current.temp_c', 25);
    }
}
