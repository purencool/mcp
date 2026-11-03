<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class CountryQuery extends Command
{
    protected $signature = 'mcp:countries {name : Country name} {--json}';
    protected $description = 'Get country data';

    public function handle(): int
    {
        $result = McpService::call('countries', [
            'fields' => 'name,capital,population,currencies,languages,region,subregion',
        ], urlencode($this->argument('name')));

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
