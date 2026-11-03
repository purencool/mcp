<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class TriviaQuery extends Command
{
    protected $signature = 'mcp:trivia {--category=9 : Category ID} {--difficulty=medium : Difficulty} {--json}';
    protected $description = 'Get trivia questions';

    public function handle(): int
    {
         = config("mcp.drivers.trivia");
        if (empty()) { ->error('Driver not found: trivia'); return self::FAILURE; }
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
         = Http::withHeaders()->get(['endpoint'], ['category' => ->option('category') ?: '9', 'difficulty' => ->option('difficulty') ?: 'medium', 'type' => 'multiple', 'amount' => 1]);
         = ['service' => 'trivia', 'data' => ->json()];;

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
