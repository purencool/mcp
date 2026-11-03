<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class ExchangeQuery extends Command
{
    protected $signature = 'mcp:exchange {from : Source currency} {to : Target currency} {--json}';
    protected $description = 'Get exchange rates';

    public function handle(): int
    {
        $result = McpService::call('exchange', [
            'from' => $this->argument('from'),
            'to'   => $this->argument('to'),
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
