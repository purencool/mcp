<?php

namespace App\Services;

class ArbitraryHttp
{
    protected string $driver;

    public function __construct(string $driver = 'ArbitraryHttp')
    {
        $this->driver = $driver;
    }

    public function request(string $query): array
    {
        // Format: METHOD URL [JSON_BODY]
        $parts = preg_split("/\s+/", trim($query), 3);
        $method = strtoupper($parts[0] ?? "GET");
        $url = $parts[1] ?? "";
        $body = $parts[2] ?? null;

        if (!$url) return ["error" => "Usage: METHOD URL [JSON_BODY]"];

        $req = \Illuminate\Support\Facades\Http::timeout(30);
        if ($body) {
            $response = $req->withHeaders(["Content-Type" => "application/json"])
                ->send($method, $url, ["body" => $body]);
        } else {
            $response = $req->send($method, $url);
        }

        return [
            "method" => $method,
            "url" => $url,
            "status" => $response->status(),
            "headers" => $response->headers(),
            "body" => $response->json() ?? $response->body(),
        ];
    }

    public function run(string $query): array
    {
        return $this->request($query);
    }

}
