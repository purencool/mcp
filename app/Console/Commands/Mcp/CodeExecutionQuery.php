<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\CodeExecution;

class CodeExecutionQuery extends Command
{
    protected $signature = 'mcp:code-exec {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Run shell commands';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'code-exec';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
