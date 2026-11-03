<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WebFetch
{
    protected string $driver;

    public function __construct(string $driver = 'WebFetch')
    {
        $this->driver = $driver;
    }

    public function run(string $query, ?string $savePath = null, ?string $saveJson = null): array
    {
        $response = Http::timeout(30)->get($query);

        if (!$response->successful()) {
            return ["error" => "HTTP " . $response->status()];
        }

        $html = $response->body();
        $text = strip_tags($html);
        $text = preg_replace("/\s+/", " ", $text);

        $links = [];
        if (preg_match_all('/<a\s[^>]*href=["\']([^"\']+)["\'][^>]*>/i', $html, $matches)) {
            foreach ($matches[1] as $href) {
                if (str_starts_with($href, '/')) {
                    $parts = parse_url($query);
                    $href = ($parts['scheme'] ?? 'https') . '://' . ($parts['host'] ?? '') . $href;
                } elseif (!str_starts_with($href, 'http') && !str_starts_with($href, '#') && !str_starts_with($href, 'javascript:')) {
                    $basePath = rtrim($query, '/');
                    $dir = substr($basePath, 0, strrpos($basePath, '/') + 1);
                    $href = $dir . $href;
                }
                $links[] = $href;
            }
        }

        $result = [
            "url" => $query,
            "status" => $response->status(),
            "text" => mb_substr($text, 0, 10000),
            "html_length" => strlen($html),
            "links" => array_values(array_unique($links)),
            "link_count" => count(array_unique($links)),
        ];

        // Save HTML
        if ($savePath) {
            $dir = dirname($savePath);
            if (!is_dir($dir)) mkdir($dir, 0755, true);
            file_put_contents($savePath, $html);
            $result["saved_to"] = $savePath;
            $result["file_size"] = filesize($savePath);
        }

        // Save JSON (explicit path, or auto-derive from --save)
        $jsonPath = $saveJson;
        if (!$jsonPath && $savePath) {
            $jsonPath = preg_replace('/\.html?$/', '.json', $savePath);
        }
        if ($jsonPath) {
            $dir = dirname($jsonPath);
            if (!is_dir($dir)) mkdir($dir, 0755, true);
            file_put_contents($jsonPath, json_encode($result, JSON_PRETTY_PRINT));
            $result["saved_json"] = $jsonPath;
        }

        return $result;
    }
}
