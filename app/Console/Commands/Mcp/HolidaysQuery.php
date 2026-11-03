<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class HolidaysQuery extends Command
{
    protected $signature = 'mcp:holidays {country : Country code (e.g. AU)} {--year= : Year (defaults to current)} {--json}';
    protected $description = 'Get public holidays';

    public function handle(): int
    {
        $year = $this->option('year') ?: date('Y');

        $result = McpService::call('holidays', [], "{$year}/{$this->argument('country')}");

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
