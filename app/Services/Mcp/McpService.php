<?php

namespace App\Services\Mcp;

use Illuminate\Support\Facades\Http;

class McpService
{
    public static function call(string $service, array $params = [], string $pathSuffix = ''): array
    {
        $config = config("mcp.{$service}");

        if (!$config) {
            throw new \RuntimeException("Unknown MCP service: {$service}");
        }

        $url = $config['endpoint'] . $pathSuffix;

        $headers = static::buildHeaders($config);

        $response = Http::withHeaders($headers)->get($url, $params);

        if ($response->failed()) {
            return [
                'service' => $service,
                'error'   => "Request failed with status {$response->status()}",
                'data'    => $response->json() ?: $response->body(),
            ];
        }

        return [
            'service' => $service,
            'data'    => $response->json(),
        ];
    }

    public static function post(string $service, array $body = []): array
    {
        $config = config("mcp.{$service}");

        if (!$config) {
            throw new \RuntimeException("Unknown MCP service: {$service}");
        }

        $headers = static::buildHeaders($config);
        $headers['Content-Type'] = 'application/json';

        $response = Http::withHeaders($headers)->post($config['endpoint'], $body);

        if ($response->failed()) {
            return [
                'service' => $service,
                'error'   => "Request failed with status {$response->status()}",
                'data'    => $response->json() ?: $response->body(),
            ];
        }

        return [
            'service' => $service,
            'data'    => $response->json(),
        ];
    }

    private static function buildHeaders(array $config): array
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
            $authHeaders = match ($config['auth_type'] ?? 'none') {
                'bearer' => ['Authorization' => "Bearer {$key}"],
                'header' => [$config['header_name'] ?? 'X-Api-Key' => $key],
                default  => [],
            };
            $headers = array_merge($headers, $authHeaders);
        }

        return $headers;
    }
}
