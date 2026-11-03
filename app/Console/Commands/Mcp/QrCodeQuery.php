<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\QrCode;

class QrCodeQuery extends Command
{
    protected $signature = 'mcp:qr {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Generate QR codes';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'qr';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
