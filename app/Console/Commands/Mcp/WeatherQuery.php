<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class WeatherQuery extends Command
{
    protected $signature = 'mcp:weather {lat : Latitude} {lng : Longitude} {--json}';
    protected $description = 'Get weather forecast';

    public function handle(): int
    {
         = config("mcp.drivers.weather");
        if (empty()) { ->error('Driver not found: weather'); return self::FAILURE; }
         = [];
         = ['api_key'] ?? '';
        if (!empty()) {
             = match(['auth_type'] ?? 'none') {
                'bearer' => ['Authorization' => "Bearer {}"],
                'header' => [['header_name'] ?? 'X-Api-Key' => ],
                default  => [],
            };
        }
         = ['header_string'] ?? '';
        if (!empty()) {
            foreach (explode("
", ) as ) {
                 = trim();
                if (empty()) continue;
                 = strpos(, ':');
                if ( !== false) {
                    [trim(substr(, 0, ))] = trim(substr(,  + 1));
                }
            }
        }
         = Http::withHeaders()->get(['endpoint'], ['lat' => ->argument('lat'), 'lon' => ->argument('lng')]);
         = ['service' => 'weather', 'data' => ->json()];;

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
