<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\PdfParse;

class PdfParseQuery extends Command
{
    protected $signature = 'mcp:pdf {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Extract text from PDFs';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'pdf';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
