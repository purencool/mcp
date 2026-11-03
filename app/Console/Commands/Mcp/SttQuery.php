<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Stt;

class SttQuery extends Command
{
    protected $signature = 'mcp:stt {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Speech-to-text';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'stt';
        $result = (new ($driver))->transcribe($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
