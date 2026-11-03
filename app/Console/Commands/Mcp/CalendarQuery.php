<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Calendar;

class CalendarQuery extends Command
{
    protected $signature = 'mcp:calendar {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Check/create calendar events';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'calendar';
        $result = (new ($driver))->events($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
