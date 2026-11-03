<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Email;

class EmailQuery extends Command
{
    protected $signature = 'mcp:email {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Send email';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'email';
        $result = (new ($driver))->send($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
