<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\SequentialThinking;

class SequentialThinkingQuery extends Command
{
    protected $signature = 'mcp:think {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Structured multi-step reasoning';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'think';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
