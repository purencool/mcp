<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class WeatherQuery extends Command
{
    protected $signature = 'mcp:weather {lat : Latitude} {lng : Longitude} {--json}';
    protected $description = 'Get weather forecast';

    public function handle(): int
    {
        $result = McpService::call('weather', [
            'latitude'  => $this->argument('lat'),
            'longitude' => $this->argument('lng'),
            'current'   => 'temperature_2m,relative_humidity_2m,apparent_temperature,weather_code,wind_speed_10m',
            'daily'     => 'temperature_2m_max,temperature_2m_min,precipitation_sum,weather_code',
            'timezone'  => 'auto',
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
