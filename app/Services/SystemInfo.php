<?php

namespace App\Services;

class SystemInfo
{
    protected string $driver;

    public function __construct(string $driver = 'SystemInfo')
    {
        $this->driver = $driver;
    }

    public function stats(string $query = "all"): array
    {
        $results = [];

        if (in_array($query, ["all", "disk"])) {
            $output = []; exec("df -h / 2>&1", $output);
            $results["disk"] = implode("\n", $output);
        }
        if (in_array($query, ["all", "memory"])) {
            $output = []; exec("free -h 2>&1", $output);
            $results["memory"] = implode("\n", $output);
        }
        if (in_array($query, ["all", "cpu"])) {
            $output = []; exec("top -bn1 | head -5 2>&1", $output);
            $results["cpu"] = implode("\n", $output);
        }
        if (in_array($query, ["all", "network"])) {
            $output = []; exec("ip addr 2>&1 || ifconfig 2>&1", $output);
            $results["network"] = implode("\n", $output);
        }

        return $results ?: ["error" => "Unknown stat: $query"];
    }

    public function run(string $query): array
    {
        return $this->stats($query);
    }

}
