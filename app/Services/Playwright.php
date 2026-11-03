<?php

namespace App\Services;

class Playwright
{
    protected string $driver;

    public function __construct(string $driver = 'Playwright')
    {
        $this->driver = $driver;
    }

    public function screenshot(string $url): array
    {
        try {
            $browser = \Playwright\Browser::launch(["headless" => true]);
            $page = $browser->newPage();
            $page->goto($url, ["waitUntil" => "networkidle"]);
            $path = storage_path("app/screenshot_" . md5($url) . ".png");
            $page->screenshot(["path" => $path]);
            $browser->close();
            return ["path" => $path, "url" => $url];
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function run(string $query): array
    {
        return $this->screenshot($query);
    }

}
