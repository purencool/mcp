<?php

namespace App\Services;

class DnsNetwork
{
    protected string $driver;

    public function __construct(string $driver = 'DnsNetwork')
    {
        $this->driver = $driver;
    }

    public function lookup(string $query): array
    {
        $parts = explode(" ", $query, 2);
        $tool = $parts[0];
        $target = $parts[1] ?? $query;

        $cmd = match($tool) {
            "dig" => "dig +short $target",
            "nslookup" => "nslookup $target",
            "ping" => "ping -c 4 $target",
            "traceroute" => "traceroute -m 15 $target",
            "whois" => "whois $target",
            default => "dig +short $target",
        };

        $output = [];
        $exitCode = 0;
        exec(escapeshellcmd($cmd) . " 2>&1", $output, $exitCode);
        return [
            "tool" => $tool,
            "target" => $target,
            "exit_code" => $exitCode,
            "output" => implode("\n", $output),
        ];
    }

    public function run(string $query): array
    {
        return $this->lookup($query);
    }

}
