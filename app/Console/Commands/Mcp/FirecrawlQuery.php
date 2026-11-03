<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Firecrawl;

class FirecrawlQuery extends Command
{
    protected $signature = 'mcp:firecrawl {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Deep web scraping + crawling';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'firecrawl';
        $result = (new ($driver))->scrape($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
