<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class IpQuery extends Command
{
    protected $signature = 'mcp:ip {address : IP address} {--json : Output as JSON}';
    protected $description = 'IP lookup via ipinfo.io';

    public function handle(): int
    {
        $config = config("mcp.drivers.ip");
        if (empty($config)) { $this->error('Driver not found: ip'); return self::FAILURE; }

        $headers = [];
        $key = $config['api_key'] ?? '';
        if (!empty($key)) {
            $headers = match($config['auth_type'] ?? 'none') {
                'bearer' => ['Authorization' => "Bearer {$key}"],
                'header' => [$config['header_name'] ?? 'X-Api-Key' => $key],
                default  => [],
            };
        }
        $hs = $config['header_string'] ?? '';
        if (!empty($hs)) {
            foreach (explode("\n", $hs) as $line) {
                $line = trim($line);
                if (empty($line)) continue;
                $pos = strpos($line, ':');
                if ($pos !== false) {
                    $headers[trim(substr($line, 0, $pos))] = trim(substr($line, $pos + 1));
                }
            }
        }

        $response = Http::withHeaders($headers)->get($config['endpoint'] . $this->argument('address'));
        $result = ['service' => 'ip', 'data' => $response->json()];

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
