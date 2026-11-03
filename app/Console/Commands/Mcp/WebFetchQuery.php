<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\WebFetch;

class WebFetchQuery extends Command
{
    protected $signature = 'mcp:web-fetch {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Fetch a URL and extract clean text';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'web-fetch';
        $result = (new ($driver))->scrape($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
