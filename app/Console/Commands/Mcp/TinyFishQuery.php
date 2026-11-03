<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class TinyFishQuery extends Command
{
    protected $signature = 'mcp:tinyfish {query : Search query} {--json}';
    protected $description = 'Agent-native search via TinyFish';

    public function handle(): int
    {
        $result = McpService::post('tinyfish', [
            'query' => $this->argument('query'),
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
