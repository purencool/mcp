<?php

namespace App\Services;

class Webhook
{
    protected string $driver;

    public function __construct(string $driver = 'Webhook')
    {
        $this->driver = $driver;
    }

    public function trigger(string $query): array
    {
        // Format: URL [JSON_PAYLOAD]
        $parts = preg_split("/\s+/", trim($query), 2);
        $url = $parts[0];
        $payload = $parts[1] ?? "{}";

        $response = \Illuminate\Support\Facades\Http::timeout(15)
            ->withHeaders(["Content-Type" => "application/json"])
            ->post($url, json_decode($payload, true) ?: []);

        return [
            "url" => $url,
            "status" => $response->status(),
            "body" => $response->body(),
        ];
    }

    public function run(string $query): array
    {
        return $this->trigger($query);
    }

}
