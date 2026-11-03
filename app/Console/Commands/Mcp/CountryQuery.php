<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class CountryQuery extends Command
{
    protected $signature = 'mcp:countries {name : Country name} {--json}';
    protected $description = 'Get country data';

    public function handle(): int
    {
         = config("mcp.drivers.countries");
        if (empty()) { ->error('Driver not found: countries'); return self::FAILURE; }
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
         = Http::withHeaders()->get(['endpoint'], ['name' => ->argument('name')]);
         = ['service' => 'countries', 'data' => ->json()];;

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
