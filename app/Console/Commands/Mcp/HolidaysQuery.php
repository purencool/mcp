<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class HolidaysQuery extends Command
{
    protected $signature = 'mcp:holidays {country : Country code} {--year= : Year} {--json : Output as JSON}';
    protected $description = 'Public holidays via date.nager.at';

    public function handle(): int
    {
        $config = config("mcp.drivers.holidays");
        if (empty($config)) { $this->error('Driver not found: holidays'); return self::FAILURE; }

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

        $year = $this->option('year') ?: date('Y');
        $url = $config['endpoint'] . $year . '/' . $this->argument('country');
        $response = Http::withHeaders($headers)->get($url);
        $result = ['service' => 'holidays', 'data' => $response->json()];

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
