<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\PasswordHash;

class PasswordHashQuery extends Command
{
    protected $signature = 'mcp:password {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Generate, hash, encode/decode';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'password';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
