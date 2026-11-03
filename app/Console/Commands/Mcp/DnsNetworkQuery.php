<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\DnsNetwork;

class DnsNetworkQuery extends Command
{
    protected $signature = 'mcp:dns {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'DNS lookup, ping, traceroute, WHOIS';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'dns';
        $result = (new ($driver))->run($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
