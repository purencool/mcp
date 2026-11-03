<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Tts;

class TtsQuery extends Command
{
    protected $signature = 'mcp:tts {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Text-to-speech audio';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'tts';
        $result = (new ($driver))->speak($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
