<?php

namespace App\Console\Commands\Mcp;

use App\Services\WebFetch;
use Illuminate\Console\Command;

class WebFetchQuery extends Command
{
    protected $signature = 'mcp:web-fetch {query : URL to fetch} {--json : Output as JSON} {--driver= : Driver name} {--save= : Save HTML to this path} {--save-json= : Save JSON output to this path}';
    protected $description = 'Fetch a URL, extract text + links, optionally save HTML and JSON';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'web-fetch';
        $savePath = $this->option('save');
        $saveJson = $this->option('save-json');
        $result = (new WebFetch($driver))->run($this->argument('query'), $savePath, $saveJson);

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
