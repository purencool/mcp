<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenMeteo
{
    public function __construct(private string $driverName) {}

    public function search(string $query): array
    {
        $config = config("mcp.drivers.{$this->driverName}");

        // Parse lat/lon from query or use default
        $params = [
            'latitude'  => 0,
            'longitude' => 0,
            'current'   => 'temperature_2m,relative_humidity_2m,apparent_temperature,precipitation,weather_code,wind_speed_10m,wind_direction_10m',
            'daily'     => 'temperature_2m_max,temperature_2m_min,precipitation_sum,weather_code',
            'forecast_days' => 7,
        ];

        // Try to extract "lat,lon" from query
        if (preg_match('/(-?\d+\.?\d*)\s*,\s*(-?\d+\.?\d*)/', $query, $m)) {
            $params['latitude']  = (float) $m[1];
            $params['longitude'] = (float) $m[2];
        }

        $response = Http::withHeaders($this->buildHeaders($config))
            ->get($config['endpoint'], $params);

        return [
            'driver' => $this->driverName,
            'query'  => $query,
            'data'   => $response->json(),
        ];
    }

    private function buildHeaders(array $config): array
    {
        $headers = [];
        $headerString = $config['header_string'] ?? '';
        if (!empty($headerString)) {
            foreach (explode("\n", $headerString) as $line) {
                $line = trim($line);
                if (empty($line)) continue;
                $pos = strpos($line, ':');
                if ($pos !== false) {
                    $headers[trim(substr($line, 0, $pos))] = trim(substr($line, $pos + 1));
                } else {
                    $headers['User-Agent'] = $line;
                }
            }
        }
        return $headers;
    }
}
