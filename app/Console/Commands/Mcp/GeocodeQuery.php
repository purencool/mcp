<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class GeocodeQuery extends Command
{
    protected $signature = 'mcp:geocode {query : Location to geocode} {--json}';
    protected $description = 'Geocode a location via OpenStreetMap';

    public function handle(): int
    {
         = config("mcp.drivers.geocode");
        if (empty()) { ->error('Driver not found: geocode'); return self::FAILURE; }
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
         = Http::withHeaders()->get(['endpoint'], ['q' => ->argument('query'), 'format' => 'json', 'limit' => 5]);
         = ['service' => 'geocode', 'data' => ->json()];;

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
