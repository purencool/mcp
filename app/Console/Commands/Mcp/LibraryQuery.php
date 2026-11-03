<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class LibraryQuery extends Command
{
    protected $signature = 'mcp:library {query : Book search query} {--json}';
    protected $description = 'Search Open Library';

    public function handle(): int
    {
        $result = McpService::call('library', [
            'q'     => $this->argument('query'),
            'limit' => 5,
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
