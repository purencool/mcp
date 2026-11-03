<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class CryptoQuery extends Command
{
    protected $signature = 'mcp:crypto {coins : Comma-separated coin IDs} {--vs-currency=aud : Currency to compare against} {--json}';
    protected $description = 'Get crypto prices';

    public function handle(): int
    {
        $result = McpService::call('crypto', [
            'ids'   => $this->argument('coins'),
            'vs_currencies' => $this->option('vs-currency'),
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
