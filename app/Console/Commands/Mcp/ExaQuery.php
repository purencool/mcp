<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class ExaQuery extends Command
{
    protected $signature = 'mcp:exa {query : Search query} {--json}';
    protected $description = 'Neural/semantic web search via Exa';

    public function handle(): int
    {
        $result = McpService::post('exa', [
            'query'  => $this->argument('query'),
            'numResults' => 5,
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
