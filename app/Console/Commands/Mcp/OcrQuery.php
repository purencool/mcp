<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Ocr;

class OcrQuery extends Command
{
    protected $signature = 'mcp:ocr {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Extract text from images';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'ocr';
        $result = (new ($driver))->recognize($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
