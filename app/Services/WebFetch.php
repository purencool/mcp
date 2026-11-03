<?php

namespace App\Services;

class WebFetch
{
    protected string $driver;

    public function __construct(string $driver = 'WebFetch')
    {
        $this->driver = $driver;
    }

    public function fetch(string $url): array
    {
        $response = \Illuminate\Support\Facades\Http::timeout(30)->get($url);
        if (!$response->successful()) {
            return ["error" => "HTTP " . $response->status()];
        }
        $html = $response->body();
        // Strip tags for clean text
        $text = strip_tags($html);
        $text = preg_replace("/\s+/", " ", $text);
        return [
            "url" => $url,
            "status" => $response->status(),
            "text" => mb_substr($text, 0, 10000),
            "html_length" => strlen($html),
        ];
    }

    public function scrape(string $url): array
    {
        return $this->fetch($url);
    }

}
