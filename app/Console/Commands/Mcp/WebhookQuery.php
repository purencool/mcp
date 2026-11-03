<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Webhook;

class WebhookQuery extends Command
{
    protected $signature = 'mcp:webhook {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Trigger a webhook URL';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'webhook';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
