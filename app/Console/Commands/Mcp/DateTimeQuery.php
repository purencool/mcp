<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\DateTime;

class DateTimeQuery extends Command
{
    protected $signature = 'mcp:datetime {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Timezone conversion, date math';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'datetime';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
