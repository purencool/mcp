<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class CryptoQuery extends Command
{
    protected $signature = 'mcp:crypto {coins : Comma-separated coin IDs} {--vs-currency=aud : Currency to compare against} {--json}';
    protected $description = 'Get crypto prices';

    public function handle(): int
    {
         = config("mcp.drivers.crypto");
        if (empty()) { ->error('Driver not found: crypto'); return self::FAILURE; }
         = [];
         = ['api_key'] ?? '';
        if (!empty()) {
             = match(['auth_type'] ?? 'none') {
                'bearer' => ['Authorization' => "Bearer {}"],
                'header' => [['header_name'] ?? 'X-Api-Key' => ],
                default  => [],
            };
        }
         = ['header_string'] ?? '';
        if (!empty()) {
            foreach (explode("
", ) as ) {
                 = trim();
                if (empty()) continue;
                 = strpos(, ':');
                if ( !== false) {
                    [trim(substr(, 0, ))] = trim(substr(,  + 1));
                }
            }
        }
         = Http::withHeaders()->get(['endpoint'], ['ids' => ->argument('coins'), 'vs_currencies' => ->option('vs-currency') ?: 'aud']);
         = ['service' => 'crypto', 'data' => ->json()];;

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
