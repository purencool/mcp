<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class WikipediaQuery extends Command
{
    protected $signature = 'mcp:wikipedia {title : Article title} {--json}';
    protected $description = 'Get Wikipedia article summary';

    public function handle(): int
    {
        $result = McpService::call('wikipedia', [], str_replace(' ', '_', $this->argument('title')));

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
