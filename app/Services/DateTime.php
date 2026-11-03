<?php

namespace App\Services;

class DateTime
{
    protected string $driver;

    public function __construct(string $driver = 'DateTime')
    {
        $this->driver = $driver;
    }

    public function convert(string $query): array
    {
        // Format: "2024-01-15 10:30 Australia/Sydney" or "now Europe/London"
        $parts = preg_split("/\s+/", trim($query), 2);
        $datetime = $parts[0] === "now" ? "now" : $parts[0];
        $tz = $parts[1] ?? date_default_timezone_get();

        $dt = new \DateTime($datetime, new \DateTimeZone("UTC"));
        $dt->setTimezone(new \DateTimeZone($tz));

        return [
            "original" => $query,
            "converted" => $dt->format("Y-m-d H:i:s"),
            "timezone" => $tz,
            "timestamp" => $dt->getTimestamp(),
        ];
    }

    public function run(string $query): array
    {
        return $this->convert($query);
    }

}
