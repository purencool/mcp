<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\JsonYaml;

class JsonYamlQuery extends Command
{
    protected $signature = 'mcp:json {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Parse, validate, convert JSON/YAML';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'json';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
