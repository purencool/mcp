<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Memory;

class MemoryQuery extends Command
{
    protected $signature = 'mcp:memory {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Persistent agent memory / RAG';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'memory';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
