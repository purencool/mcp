<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Exa
{
    public function __construct(private string $driverName) {}

    public function search(string $query): array
    {
        $config = config("mcp.drivers.{$this->driverName}");

        $response = Http::withHeaders($this->buildHeaders($config))
            ->post($config['endpoint'], [
                'query'  => $query,
                'numResults' => 5,
            ]);

        $data = $response->json();

        $results = collect($data['results'] ?? [])
            ->map(fn ($r) => [
                'title'   => $r['title'] ?? '',
                'snippet' => $r['text'] ?? $r['snippet'] ?? '',
                'url'     => $r['url'] ?? '',
            ])
            ->values()
            ->toArray();

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
        $key = $config['api_key'] ?? '';
        if (!empty($key)) {
            $headers['x-api-key'] = $key;
        }
        $headers['Content-Type'] = 'application/json';
        return $headers;
    }
}
