<?php

namespace App\Services;

class Git
{
    protected string $driver;

    public function __construct(string $driver = 'Git')
    {
        $this->driver = $driver;
    }

    public function run(string $query): array
    {
        $args = explode(" ", $query);
        $cmd = "git " . escapeshellarg(implode(" ", $args));
        $output = [];
        $exitCode = 0;
        exec($cmd . " 2>&1", $output, $exitCode);
        return [
            "command" => "git " . implode(" ", $args),
            "exit_code" => $exitCode,
            "output" => implode("\n", $output),
        ];
    }

}
