<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class TavilyQuery extends Command
{
    protected $signature = 'mcp:tavily {query : Search query} {--json}';
    protected $description = 'AI-optimized web search via Tavily';

    public function handle(): int
    {
        $result = McpService::post('tavily', [
            'query' => $this->argument('query'),
            'max_results' => 5,
            'search_depth' => 'basic',
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
