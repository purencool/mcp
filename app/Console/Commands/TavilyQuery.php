<?php

namespace App\Console\Commands;

use App\Services\Tavily;
use Illuminate\Console\Command;

class TavilyQuery extends Command
{
    protected $signature = 'mcp:tavily {query : The search query} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'AI-optimized web search via Tavily';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'tavily';
        $result = (new Tavily($driver))->search($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
