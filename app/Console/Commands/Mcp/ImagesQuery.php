<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class ImagesQuery extends Command
{
    protected $signature = 'mcp:images {query : Image search query} {--json}';
    protected $description = 'Search free stock images via Pexels';

    public function handle(): int
    {
        $result = McpService::call('images', [
            'query' => $this->argument('query'),
            'per_page' => 5,
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
