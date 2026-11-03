<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\SystemInfo;

class SystemInfoQuery extends Command
{
    protected $signature = 'mcp:system-info {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Disk, memory, CPU, network stats';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'system-info';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
