<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Git;

class GitQuery extends Command
{
    protected $signature = 'mcp:git {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Git operations (clone, log, diff, status, commit)';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'git';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
