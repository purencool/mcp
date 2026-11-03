<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\ArbitraryHttp;

class ArbitraryHttpQuery extends Command
{
    protected $signature = 'mcp:http {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Make any HTTP request (API testing)';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'http';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
