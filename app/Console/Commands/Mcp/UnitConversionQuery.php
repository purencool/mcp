<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\UnitConversion;

class UnitConversionQuery extends Command
{
    protected $signature = 'mcp:units {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Unit conversion (metric/imperial, temperature)';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'units';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
