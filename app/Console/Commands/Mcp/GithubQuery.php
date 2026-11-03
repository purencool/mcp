<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class GithubQuery extends Command
{
    protected $signature = 'mcp:github {query : Search query} {--json}';
    protected $description = 'Search GitHub repositories';

    public function handle(): int
    {
        $result = McpService::call('github', [
            'q'      => $this->argument('query'),
            'per_page' => 5,
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
