<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Database;

class DatabaseQuery extends Command
{
    protected $signature = 'mcp:database {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Run SQL queries against the database';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'database';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
