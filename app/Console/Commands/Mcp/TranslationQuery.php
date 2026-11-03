<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Translation;

class TranslationQuery extends Command
{
    protected $signature = 'mcp:translate {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Machine translate text';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'translate';
        $result = (new ($driver))->translate($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
