<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Playwright;

class PlaywrightQuery extends Command
{
    protected $signature = 'mcp:playwright {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Browser automation (screenshots, forms)';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'playwright';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
