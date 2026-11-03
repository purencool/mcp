<?php

namespace App\Services\Search;

use App\Contracts\Searchable;
use Illuminate\Support\Facades\Http;

class Search implements Searchable
{
    public function __construct(private string $driverName) {}

    public function search(string $query): array
    {
        $config = config("mcp.drivers.{$this->driverName}"); // ← was "search.drivers"

        if (empty($config)) {
            return [
                "driver" => $this->driverName,
                "query" => $query,
                "error" => "Driver '{$this->driverName}' not found in config/mcp.php",
            ];
        }

        $paramName = $config["query_param"] ?? "q";
        $params = [$paramName => $query];

        foreach ($config["params"] ?? [] as $param) {
            [$key, $value] = array_pad(explode("=", $param, 2), 2, "");
            $params[$key] = $value;
        }

        $request = Http::withHeaders($this->buildHeaders($config));
        $response = $request->get($config["endpoint"], $params);
        $data = $response->json();

        return [
            "driver" => $this->driverName,
            "query" => $query,
            "data" => $data,
        ];
    }

    private function buildHeaders(array $config): array
    {
        $headers = [];

        // Custom header string (User-Agent, etc.)
        $headerString = $config["header_string"] ?? "";
        if (!empty($headerString)) {
            foreach (explode("\n", $headerString) as $line) {
                $line = trim($line);
                if (empty($line)) {
                    continue;
                }
                $pos = strpos($line, ":");
                if ($pos !== false) {
                    $headers[trim(substr($line, 0, $pos))] = trim(
                        substr($line, $pos + 1),
                    );
                } else {
                    $headers["User-Agent"] = $line;
                }
            }
        }

        // Auth
        $key = $config["api_key"] ?? "";
        if (!empty($key)) {
            $authHeaders = match ($config["auth_type"] ?? "none") {
                "bearer" => ["Authorization" => "Bearer {$key}"],
                "header" => [$config["header_name"] ?? "X-Api-Key" => $key],
                default => [],
            };
            $headers = array_merge($headers, $authHeaders);
        }

        return $headers;
    }
}
