<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Regex;

class RegexQuery extends Command
{
    protected $signature = 'mcp:regex {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Test regex patterns';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'regex';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
