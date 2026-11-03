<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class SunriseQuery extends Command
{
    protected $signature = 'mcp:sunrise {lat : Latitude} {lng : Longitude} {--json}';
    protected $description = 'Get sunrise/sunset times';

    public function handle(): int
    {
        $result = McpService::call('sunrise', [
            'lat'  => $this->argument('lat'),
            'lng'  => $this->argument('lng'),
            'date' => date('Y-m-d'),
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
