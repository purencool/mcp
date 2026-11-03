<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Stocks;

class StocksQuery extends Command
{
    protected $signature = 'mcp:stocks {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Stock prices (ASX, NASDAQ)';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'stocks';
        $result = (new ($driver))->quote($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
