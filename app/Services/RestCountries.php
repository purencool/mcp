<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RestCountries
{
    public function __construct(private string $driverName) {}

    public function search(string $query): array
    {
        $config = config("mcp.drivers.{$this->driverName}");

        $response = Http::withHeaders($this->buildHeaders($config))
            ->get($config['endpoint'] . $query);

        $data = $response->json();

        $results = is_array($data)
            ? collect($data)->map(fn ($c) => [
                'name'         => $c['name']['common'] ?? '',
                'capital'      => $c['capital'][0] ?? '',
                'population'   => $c['population'] ?? 0,
                'region'       => $c['region'] ?? '',
                'currency'     => array_keys($c['currencies'] ?? [])[0] ?? '',
                'languages'    => collect($c['languages'] ?? [])->keys()->values()->toArray(),
                'flag'         => $c['flags']['png'] ?? '',
            ])->values()->toArray()
            : [$data];

        return [
            'driver' => $this->driverName,
            'query'  => $query,
            'data'   => $results,
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
