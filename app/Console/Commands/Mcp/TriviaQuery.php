<?php

namespace App\Console\Commands\Mcp;

use App\Services\Mcp\McpService;
use Illuminate\Console\Command;

class TriviaQuery extends Command
{
    protected $signature = 'mcp:trivia {--category=9 : Category ID} {--difficulty=medium : Difficulty} {--json}';
    protected $description = 'Get trivia questions';

    public function handle(): int
    {
        $result = McpService::call('trivia', [
            'amount'     => 1,
            'category'   => $this->option('category'),
            'difficulty' => $this->option('difficulty'),
        ]);

        $this->line(json_encode($result, JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
