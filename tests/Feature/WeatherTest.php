<?php

namespace Tests\Feature;

use App\Weather;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_weather_api(): void
    {
        $this->partialMock(Weather::class, function (MockInterface $mock) {
            $mock->shouldReceive('isSunnyTomorrow')->once()->andReturn(true);
        });

        $response = $this->get('/api/weather');
        
        $response = $this->setUp('/api/weather');
        $response->assertStatus();

        $response->assertJsonPath('weather', 'sunny');
    }
}
