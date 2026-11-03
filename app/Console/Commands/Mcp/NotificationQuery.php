<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Notification;

class NotificationQuery extends Command
{
    protected $signature = 'mcp:notify {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Push/SMS/email alerts';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'notify';
        $result = (new ($driver))->send($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
