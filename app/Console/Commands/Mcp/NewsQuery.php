<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class NewsQuery extends Command
{
    protected $signature = 'mcp:news {query : Search query} {--json}';
    protected $description = 'Search Hacker News';

    public function handle(): int
    {
        $result = McpService::call('news', [
            'query' => $this->argument('query'),
            'hits'  => 5,
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
