<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Maps;

class MapsQuery extends Command
{
    protected $signature = 'mcp:maps {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Routing, distance, travel time';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'maps';
        $result = (new ($driver))->route($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
