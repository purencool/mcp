<?php

namespace App\Services;

class Regex
{
    protected string $driver;

    public function __construct(string $driver = 'Regex')
    {
        $this->driver = $driver;
    }

    public function test(string $query): array
    {
        // Format: /pattern/flags subject
        if (!preg_match("/^(?:\/(.+?)\/([a-z]*))\s+(.*)$/s", trim($query), $m)) {
            return ["error" => "Format: /pattern/flags subject"];
        }
        $pattern = "/" . $m[1] . "/" . $m[2];
        $subject = $m[3];

        $matches = [];
        $count = preg_match_all($pattern, $subject, $matches, PREG_OFFSET_CAPTURE);
        return [
            "pattern" => $pattern,
            "subject" => $subject,
            "matches" => $count,
            "details" => array_map(fn($m) => [
                "value" => $m[0][0],
                "offset" => $m[0][1],
            ], array_slice($matches[0] ?? [], 0, 20)),
        ];
    }

    public function run(string $query): array
    {
        return $this->test($query);
    }

}
