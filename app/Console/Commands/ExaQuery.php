<?php

namespace App\Console\Commands;

use App\Services\Exa;
use Illuminate\Console\Command;

class ExaQuery extends Command
{
    protected $signature = 'mcp:exa {query : The search query} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Neural/semantic web search via Exa';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'exa';
        $result = (new Exa($driver))->search($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
