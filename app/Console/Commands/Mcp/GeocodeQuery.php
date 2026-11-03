<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class GeocodeQuery extends Command
{
    protected $signature = 'mcp:geocode {query : Location to geocode} {--json}';
    protected $description = 'Geocode a location via OpenStreetMap';

    public function handle(): int
    {
        $result = McpService::call('geocode', [
            'q'      => $this->argument('query'),
            'format' => 'json',
            'limit'  => 5,
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
