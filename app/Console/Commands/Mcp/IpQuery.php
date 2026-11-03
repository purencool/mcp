<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class IpQuery extends Command
{
    protected $signature = 'mcp:ip {address : IP address} {--json}';
    protected $description = 'Get IP geolocation';

    public function handle(): int
    {
        $result = McpService::call('ip', [], $this->argument('address') . '/json');

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
