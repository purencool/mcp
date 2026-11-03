<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class SunriseQuery extends Command
{
    protected $signature = 'mcp:sunrise {lat : Latitude} {lng : Longitude} {--json}';
    protected $description = 'Get sunrise/sunset times';

    public function handle(): int
    {
         = config("mcp.drivers.sunrise");
        if (empty()) { ->error('Driver not found: sunrise'); return self::FAILURE; }
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
         = Http::withHeaders()->get(['endpoint'], ['lat' => ->argument('lat'), 'lng' => ->argument('lng')]);
         = ['service' => 'sunrise', 'data' => ->json()];;

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
