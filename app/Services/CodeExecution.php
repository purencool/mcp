<?php

namespace App\Services;

class CodeExecution
{
    protected string $driver;

    public function __construct(string $driver = 'CodeExecution')
    {
        $this->driver = $driver;
    }

    public function execute(string $command): array
    {
        $output = [];
        $exitCode = 0;
        exec(escapeshellarg($command) . " 2>&1", $output, $exitCode);
        return [
            "exit_code" => $exitCode,
            "output" => implode("\n", $output),
        ];
    }

    public function run(string $query): array
    {
        return $this->execute($query);
    }

}
