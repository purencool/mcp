<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class LibraryQuery extends Command
{
    protected $signature = 'mcp:library {query : Book search query} {--json}';
    protected $description = 'Search Open Library';

    public function handle(): int
    {
         = config("mcp.drivers.library");
        if (empty()) { ->error('Driver not found: library'); return self::FAILURE; }
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
         = Http::withHeaders()->get(['endpoint'], ['q' => ->argument('query')]);
         = ['service' => 'library', 'data' => ->json()];;

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
