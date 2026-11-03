<?php

namespace App\Console\Commands\Mcp;

use App\Services\Search\Search;
use Illuminate\Console\Command;

class SportsQuery extends Command
{
    protected $signature = "mcp:sports {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}";
    protected $description = "Scores, fixtures, standings";

    public function handle(): int
    {
        $driver = $this->option("driver") ?? "sports";
        $result = new Search($driver)->search($this->argument("query"));

        if ($this->option("json")) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
